<?php

declare(strict_types=1);

namespace App\Attaching\Tests\Unit\EventSubscriber;

use App\Attaching\EventSubscriber\AttachmentHttpExceptionSubscriber;
use App\Attaching\Exception\Attachment\AttachmentNotFoundException;
use App\Attaching\Exception\Attachment\AttachmentValidationException;
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

        $response = $event->getResponse();
        self::assertNotNull($response);
        self::assertSame(400, $response->getStatusCode());
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

        $response = $event->getResponse();
        self::assertNotNull($response);
        self::assertSame(404, $response->getStatusCode());
    }
}
