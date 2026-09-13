<?php

declare(strict_types=1);

namespace App\Attaching\Service\Transfer\Attachment;

use App\Attaching\Exception\Lookup\Attachment\AttachmentNotFoundException;
use App\Attaching\RepositoryInterface\Persistence\Attachment\AttachmentRepositoryInterface;
use App\Attaching\Service\Validation\Attachment\AttachmentValidationService;
use App\Attaching\ServiceInterface\Storage\Attachment\AttachmentStorageInterface;
use App\Attaching\ServiceInterface\Transfer\Attachment\AttachmentDownloadServiceInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;

final readonly class AttachmentDownloadService implements AttachmentDownloadServiceInterface
{
    public function __construct(
        private AttachmentRepositoryInterface $attachmentRepository,
        private AttachmentStorageInterface $attachmentStorage,
        private AttachmentValidationService $attachmentValidationService,
    ) {
    }

    /**
     * @return BinaryFileResponse|StreamedResponse
     */
    public function download(int $attachmentId): BinaryFileResponse|StreamedResponse
    {
        $this->attachmentValidationService->validateAttachmentIdentifier($attachmentId);
        $attachment = $this->attachmentRepository->findActive($attachmentId);

        if (null === $attachment) {
            throw AttachmentNotFoundException::forAttachmentId($attachmentId);
        }

        $absolutePath = $this->attachmentStorage->resolveAbsolutePath($attachment->getStoragePath());

        if (is_file($absolutePath)) {
            $response = new BinaryFileResponse($absolutePath);
            $response->headers->set('Content-Type', $attachment->getMimeType());
            $response->setContentDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                $attachment->getOriginalName(),
            );

            return $response;
        }

        $stream = $this->attachmentStorage->readStream($attachment->getStoragePath());

        $response = new StreamedResponse(static function () use ($stream): void {
            fpassthru($stream);
            fclose($stream);
        });
        $response->headers->set('Content-Type', $attachment->getMimeType());
        $response->headers->set(
            'Content-Disposition',
            HeaderUtils::makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $attachment->getOriginalName()),
        );

        return $response;
    }
}
