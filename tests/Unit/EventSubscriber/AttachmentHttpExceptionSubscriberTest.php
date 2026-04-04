<?php

declare(strict_types=1);

namespace App\Tests\Unit\EventSubscriber;

use App\EventSubscriber\AttachmentHttpExceptionSubscriber;
use App\Exception\Attachment\AttachmentNotFoundException;
use App\Exception\Attachment\AttachmentValidationException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

final class AttachmentHttpExceptionSubscriberTest extends TestCase
{
    public function testValidationExceptionProducesBadRequestJsonResponse(): void
    {
        $subscriber = new AttachmentHttpExceptionSubscriber();
        $event = new ExceptionEvent(
            $this->createMock(HttpKernelInterface::class),
            Request::create('/attachments', 'GET'),
            HttpKernelInterface::MAIN_REQUEST,
            new AttachmentValidationException('Bad attachment request.'),
        );

        $subscriber->onKernelException($event);

        self::assertNotNull($event->getResponse());
        self::assertSame(400, $event->getResponse()?->getStatusCode());
    }

    public function testNotFoundExceptionProducesNotFoundJsonResponse(): void
    {
        $subscriber = new AttachmentHttpExceptionSubscriber();
        $event = new ExceptionEvent(
            $this->createMock(HttpKernelInterface::class),
            Request::create('/attachments/missing/download', 'GET'),
            HttpKernelInterface::MAIN_REQUEST,
            AttachmentNotFoundException::forAttachmentId('missing-id'),
        );

        $subscriber->onKernelException($event);

        self::assertNotNull($event->getResponse());
        self::assertSame(404, $event->getResponse()?->getStatusCode());
    }
}
