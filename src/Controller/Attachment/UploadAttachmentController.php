<?php

declare(strict_types=1);

namespace App\Controller\Attachment;

use App\Dto\Attachment\Input\UploadAttachmentInput;
use App\Exception\Attachment\AttachmentValidationException;
use App\ServiceInterface\Attachment\AttachmentUploadServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/attachments/upload', name: 'attachment_upload', methods: ['POST'])]
final readonly class UploadAttachmentController
{
    public function __construct(private AttachmentUploadServiceInterface $attachmentUploadService)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $uploadedFile = $request->files->get('file');

        if (null === $uploadedFile) {
            throw new AttachmentValidationException('Attachment upload requires a file field.');
        }

        $view = $this->attachmentUploadService->upload(new UploadAttachmentInput(
            uploadedFile: $uploadedFile,
            ownerType: (string) $request->request->get('ownerType', ''),
            ownerId: (string) $request->request->get('ownerId', ''),
            context: $request->request->get('context') ? (string) $request->request->get('context') : null,
            slot: $request->request->get('slot') ? (string) $request->request->get('slot') : null,
            isPrimary: filter_var($request->request->get('isPrimary', false), FILTER_VALIDATE_BOOL),
            title: $request->request->get('title') ? (string) $request->request->get('title') : null,
            description: $request->request->get('description') ? (string) $request->request->get('description') : null,
            altText: $request->request->get('altText') ? (string) $request->request->get('altText') : null,
        ));

        return new JsonResponse([
            'id' => $view->id,
            'type' => $view->type->value,
            'mimeType' => $view->mimeType,
            'downloadUrl' => $view->downloadUrl,
        ], Response::HTTP_CREATED);
    }
}
