<?php

declare(strict_types=1);

namespace App\Controller\Attachment;

use App\Dto\Attachment\Input\AttachAttachmentInput;
use App\ServiceInterface\Attachment\AttachmentAttachServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/attachments/attach', name: 'attachment_attach', methods: ['POST'])]
final readonly class AttachAttachmentController
{
    public function __construct(private AttachmentAttachServiceInterface $attachmentAttachService)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $view = $this->attachmentAttachService->attach(new AttachAttachmentInput(
            attachmentId: (string) $request->request->get('attachmentId', ''),
            ownerType: (string) $request->request->get('ownerType', ''),
            ownerId: (string) $request->request->get('ownerId', ''),
            context: $request->request->get('context') ? (string) $request->request->get('context') : null,
            slot: $request->request->get('slot') ? (string) $request->request->get('slot') : null,
            position: (int) $request->request->get('position', 0),
            isPrimary: filter_var($request->request->get('isPrimary', false), FILTER_VALIDATE_BOOL),
        ));

        return new JsonResponse([
            'id' => $view->id,
            'attachmentId' => $view->attachmentId,
            'ownerType' => $view->ownerType,
            'ownerId' => $view->ownerId,
        ], Response::HTTP_CREATED);
    }
}
