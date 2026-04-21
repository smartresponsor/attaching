<?php

declare(strict_types=1);

namespace App\Attaching\Service\Attachment;

use App\Attaching\Contract\Attachment\AttachmentStorageInterface;
use App\Attaching\Exception\Attachment\AttachmentNotFoundException;
use App\Attaching\Repository\Attachment\AttachmentRepository;
use App\Attaching\ServiceInterface\Attachment\AttachmentDownloadServiceInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;

final readonly class AttachmentDownloadService implements AttachmentDownloadServiceInterface
{
    public function __construct(
        private AttachmentRepository $attachmentRepository,
        private AttachmentStorageInterface $attachmentStorage,
        private AttachmentValidationService $attachmentValidationService,
    ) {
    }

    /**
     * @param string $attachmentId
     *
     * @return BinaryFileResponse|StreamedResponse
     *
     * @throws \Throwable
     */
    public function download(string $attachmentId): BinaryFileResponse|StreamedResponse
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
