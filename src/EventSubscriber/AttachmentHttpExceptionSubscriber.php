<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Exception\Attachment\AttachmentException;
use App\Exception\Attachment\AttachmentNotFoundException;
use App\Exception\Attachment\AttachmentValidationException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class AttachmentHttpExceptionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $request = $event->getRequest();

        if (!str_starts_with($request->getPathInfo(), '/attachments')) {
            return;
        }

        $throwable = $event->getThrowable();

        if (!$throwable instanceof AttachmentException) {
            return;
        }

        $statusCode = match (true) {
            $throwable instanceof AttachmentValidationException => JsonResponse::HTTP_BAD_REQUEST,
            $throwable instanceof AttachmentNotFoundException => JsonResponse::HTTP_NOT_FOUND,
            default => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
        };

        $event->setResponse(new JsonResponse([
            'error' => [
                'type' => $throwable::class,
                'message' => $throwable->getMessage(),
            ],
        ], $statusCode));
    }
}
