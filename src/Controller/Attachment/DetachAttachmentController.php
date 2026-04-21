<?php

declare(strict_types=1);

namespace App\Attaching\Controller\Attachment;

use App\Attaching\Dto\Attachment\Input\DetachAttachmentInput;
use App\Attaching\ServiceInterface\Attachment\AttachmentDetachServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/attachments/detach', name: 'attachment_detach', methods: ['POST'])]
final readonly class DetachAttachmentController
{
    public function __construct(private AttachmentDetachServiceInterface $attachmentDetachService)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $this->attachmentDetachService->detach(new DetachAttachmentInput(
            attachmentId: (string) $request->request->get('attachmentId', ''),
            ownerType: (string) $request->request->get('ownerType', ''),
            ownerId: (string) $request->request->get('ownerId', ''),
            context: $request->request->get('context') ? (string) $request->request->get('context') : null,
            slot: $request->request->get('slot') ? (string) $request->request->get('slot') : null,
        ));

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
