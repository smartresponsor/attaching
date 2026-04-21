<?php

declare(strict_types=1);

namespace App\Attaching\Controller\Attachment;

use App\Attaching\ServiceInterface\Attachment\AttachmentDownloadServiceInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/attachments/{attachmentId}/download', name: 'attachment_download', methods: ['GET'])]
final readonly class DownloadAttachmentController
{
    public function __construct(private AttachmentDownloadServiceInterface $attachmentDownloadService)
    {
    }

    public function __invoke(string $attachmentId): BinaryFileResponse|StreamedResponse
    {
        return $this->attachmentDownloadService->download($attachmentId);
    }
}
