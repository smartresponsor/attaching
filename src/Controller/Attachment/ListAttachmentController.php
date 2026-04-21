<?php

declare(strict_types=1);

namespace App\Attaching\Controller\Attachment;

use App\Attaching\Dto\Attachment\Input\ListAttachmentInput;
use App\Attaching\ServiceInterface\Attachment\AttachmentListServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/attachments', name: 'attachment_list', methods: ['GET'])]
final readonly class ListAttachmentController
{
    public function __construct(private AttachmentListServiceInterface $attachmentListService)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $view = $this->attachmentListService->list(new ListAttachmentInput(
            ownerType: (string) $request->query->get('ownerType', ''),
            ownerId: (string) $request->query->get('ownerId', ''),
            context: $request->query->get('context') ? (string) $request->query->get('context') : null,
            slot: $request->query->get('slot') ? (string) $request->query->get('slot') : null,
        ));

        return new JsonResponse([
            'ownerType' => $view->ownerType,
            'ownerId' => $view->ownerId,
            'count' => count($view->items),
            'items' => array_map(static fn ($item): array => [
                'id' => $item->id,
                'type' => $item->type->value,
                'mimeType' => $item->mimeType,
                'downloadUrl' => $item->downloadUrl,
            ], $view->items),
        ]);
    }
}
