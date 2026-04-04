<?php

declare(strict_types=1);

namespace App\Repository\Attachment;

use App\Entity\Attachment\Attachment;
use Doctrine\ORM\EntityManagerInterface;

final readonly class AttachmentRepository
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function save(Attachment $attachment): void
    {
        $this->entityManager->persist($attachment);
        $this->entityManager->flush();
    }

    public function find(string $attachmentId): ?Attachment
    {
        return $this->entityManager->find(Attachment::class, $attachmentId);
    }
}
