<?php

declare(strict_types=1);

namespace App\Attaching\Controller\Http\Attachment;

use App\Attaching\ServiceInterface\Linking\Attachment\AttachmentDeleteServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/attachment/{attachmentId}', name: 'attachment_delete', requirements: ['attachmentId' => '\d+'], methods: ['DELETE'])]
final readonly class DeleteAttachmentController
{
    public function __construct(private AttachmentDeleteServiceInterface $attachmentDeleteService)
    {
    }

    public function __invoke(int $attachmentId): JsonResponse
    {
        $this->attachmentDeleteService->delete($attachmentId);

        return new JsonResponse(status: Response::HTTP_NO_CONTENT);
    }
}
