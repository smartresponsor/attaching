<?php

declare(strict_types=1);

namespace App\Attaching\EventSubscriber;

use App\Attaching\Exception\Attachment\AttachmentException;
use App\Attaching\Exception\Attachment\AttachmentNotFoundException;
use App\Attaching\Exception\Attachment\AttachmentValidationException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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
            $throwable instanceof AttachmentValidationException => Response::HTTP_BAD_REQUEST,
            $throwable instanceof AttachmentNotFoundException => Response::HTTP_NOT_FOUND,
            default => Response::HTTP_UNPROCESSABLE_ENTITY,
        };

        $event->setResponse(new JsonResponse([
            'error' => [
                'type' => $throwable::class,
                'message' => $throwable->getMessage(),
            ],
        ], $statusCode));
    }
}
