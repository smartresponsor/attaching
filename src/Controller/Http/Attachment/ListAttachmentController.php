<?php

declare(strict_types=1);

namespace App\Attaching\Controller\Http\Attachment;

use App\Attaching\Dto\Input\Attachment\ListAttachmentInput;
use App\Attaching\ServiceInterface\Query\Attachment\AttachmentListServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/attachment', name: 'attachment_list', methods: ['GET'])]
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
            'context' => $view->context,
            'slot' => $view->slot,
            'items' => array_map(static fn ($item): array => [
                'id' => $item->id,
                'type' => $item->type->value,
                'mediaKind' => $item->mediaKind?->value,
                'documentKind' => $item->documentKind?->value,
                'originalName' => $item->originalName,
                'mimeType' => $item->mimeType,
                'extension' => $item->extension,
                'size' => $item->size,
                'checksum' => $item->checksum,
                'visibility' => $item->visibility->value,
                'title' => $item->title,
                'description' => $item->description,
                'altText' => $item->altText,
                'width' => $item->width,
                'height' => $item->height,
                'durationMs' => $item->durationMs,
                'pageCount' => $item->pageCount,
                'downloadUrl' => $item->downloadUrl,
                'context' => $item->context,
                'slot' => $item->slot,
                'isPrimary' => $item->isPrimary,
                'position' => $item->position,
                'createdAt' => $item->createdAt->format(DATE_ATOM),
            ], $view->items),
        ]);
    }
}
