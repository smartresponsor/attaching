<?php

declare(strict_types=1);

namespace App\Service\Attachment;

use App\Contract\Attachment\AttachmentChecksumGeneratorInterface;
use App\Contract\Attachment\AttachmentMimeTypeGuesserInterface;
use App\Contract\Attachment\AttachmentPathGeneratorInterface;
use App\Contract\Attachment\AttachmentStorageInterface;
use App\Dto\Attachment\Input\UploadAttachmentInput;
use App\Dto\Attachment\Output\AttachmentView;
use App\Entity\Attachment\Attachment;
use App\Entity\Attachment\AttachmentLink;
use App\Enum\Attachment\AttachmentStorageKind;
use App\Enum\Attachment\AttachmentVisibility;
use App\Exception\Attachment\AttachmentStorageException;
use App\Repository\Attachment\AttachmentLinkRepository;
use App\Repository\Attachment\AttachmentRepository;
use App\ServiceInterface\Attachment\AttachmentUploadServiceInterface;

final readonly class AttachmentUploadService implements AttachmentUploadServiceInterface
{
    public function __construct(
        private AttachmentValidationService $attachmentValidationService,
        private AttachmentChecksumGeneratorInterface $attachmentChecksumGenerator,
        private AttachmentMimeTypeGuesserInterface $attachmentMimeTypeGuesser,
        private AttachmentPathGeneratorInterface $attachmentPathGenerator,
        private AttachmentStorageInterface $attachmentStorage,
        private AttachmentRepository $attachmentRepository,
        private AttachmentLinkRepository $attachmentLinkRepository,
        private AttachmentViewFactory $attachmentViewFactory,
    ) {
    }

    public function upload(UploadAttachmentInput $input): AttachmentView
    {
        $this->attachmentValidationService->validateUploadedFile($input->uploadedFile);
        $this->attachmentValidationService->validateOwnerReference($input->ownerType, $input->ownerId);

        $mimeType = $input->uploadedFile->getMimeType() ?? 'application/octet-stream';
        $classification = $this->attachmentMimeTypeGuesser->classify($mimeType);
        $attachmentId = $this->generateIdentifier();
        $extension = $input->uploadedFile->guessExtension() ?? $input->uploadedFile->getClientOriginalExtension() ?: null;
        $checksum = $this->attachmentChecksumGenerator->generate($input->uploadedFile->getPathname());
        $storagePath = $this->attachmentPathGenerator->generate(
            $classification['type'],
            $attachmentId,
            $checksum,
            $extension,
        );

        try {
            $this->attachmentStorage->store($input->uploadedFile->getPathname(), $storagePath);
        } catch (\Throwable $throwable) {
            throw new AttachmentStorageException(sprintf('Unable to store attachment file for "%s".', $input->uploadedFile->getClientOriginalName()), 0, $throwable);
        }

        $attachment = new Attachment(
            id: $attachmentId,
            type: $classification['type'],
            storageKind: AttachmentStorageKind::Local,
            visibility: $input->visibility ?? AttachmentVisibility::Private,
            originalName: $input->uploadedFile->getClientOriginalName(),
            storedName: basename($storagePath),
            mimeType: $mimeType,
            size: (int) (($input->uploadedFile->getSize() ?: 0)),
            checksum: $checksum,
            storagePath: $storagePath,
            extension: $extension,
            mediaKind: $classification['mediaKind'],
            documentKind: $classification['documentKind'],
            title: $input->title,
            description: $input->description,
            altText: $input->altText,
        );
        $this->attachmentRepository->save($attachment);

        $attachmentLink = new AttachmentLink(
            id: $this->generateIdentifier(),
            attachment: $attachment,
            ownerType: $input->ownerType,
            ownerId: $input->ownerId,
            context: $input->context,
            slot: $input->slot,
            isPrimary: $input->isPrimary,
        );

        if ($input->isPrimary) {
            $this->attachmentLinkRepository->clearPrimaryForOwnerSlot($input->ownerType, $input->ownerId, $input->context, $input->slot);
        }

        $this->attachmentLinkRepository->save($attachmentLink);

        return $this->attachmentViewFactory->create($attachment, sprintf('/attachments/%s/download', $attachment->getId()));
    }

    private function generateIdentifier(): string
    {
        $hex = bin2hex(random_bytes(16));

        return sprintf(
            '%s-%s-%s-%s-%s',
            substr($hex, 0, 8),
            substr($hex, 8, 4),
            substr($hex, 12, 4),
            substr($hex, 16, 4),
            substr($hex, 20, 12),
        );
    }
}
