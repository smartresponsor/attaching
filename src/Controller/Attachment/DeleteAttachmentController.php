<?php

declare(strict_types=1);

namespace App\Controller\Attachment;

use App\ServiceInterface\Attachment\AttachmentDeleteServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/attachments/{attachmentId}', name: 'attachment_delete', methods: ['DELETE'])]
final readonly class DeleteAttachmentController
{
    public function __construct(private AttachmentDeleteServiceInterface $attachmentDeleteService)
    {
    }

    public function __invoke(string $attachmentId): JsonResponse
    {
        $this->attachmentDeleteService->delete($attachmentId);

        return new JsonResponse(status: Response::HTTP_NO_CONTENT);
    }
}
