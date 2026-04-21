<?php

declare(strict_types=1);

namespace App\Attaching\Service\Attachment;

use App\Attaching\Contract\Attachment\AttachmentChecksumGeneratorInterface;
use App\Attaching\Contract\Attachment\AttachmentMimeTypeGuesserInterface;
use App\Attaching\Contract\Attachment\AttachmentPathGeneratorInterface;
use App\Attaching\Contract\Attachment\AttachmentStorageInterface;
use App\Attaching\Dto\Attachment\Input\UploadAttachmentInput;
use App\Attaching\Dto\Attachment\Output\AttachmentView;
use App\Attaching\Entity\Attachment\Attachment;
use App\Attaching\Entity\Attachment\AttachmentLink;
use App\Attaching\Enum\Attachment\AttachmentStorageKind;
use App\Attaching\Enum\Attachment\AttachmentVisibility;
use App\Attaching\Exception\Attachment\AttachmentStorageException;
use App\Attaching\Repository\Attachment\AttachmentLinkRepository;
use App\Attaching\Repository\Attachment\AttachmentRepository;
use App\Attaching\ServiceInterface\Attachment\AttachmentUploadServiceInterface;
use Random\RandomException;

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

    /**
     * @throws RandomException when a secure attachment identifier cannot be generated
     */
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
            size: (int) ($input->uploadedFile->getSize() ?: 0),
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

    /**
     * @throws RandomException when secure random bytes cannot be generated
     */
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
