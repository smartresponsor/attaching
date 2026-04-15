<?php

declare(strict_types=1);

namespace App\Repository\Attachment;

use App\Entity\Attachment\Attachment;
use App\Enum\Attachment\AttachmentStatus;
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

    public function remove(Attachment $attachment): void
    {
        $this->entityManager->remove($attachment);
        $this->entityManager->flush();
    }

    /**
     * @throws \Throwable when Doctrine cannot resolve or execute the entity lookup
     */
    public function find(string $attachmentId): ?Attachment
    {
        return $this->entityManager->find(Attachment::class, $attachmentId);
    }

    /**
     * @throws \Throwable when Doctrine cannot resolve or execute the entity lookup
     */
    public function findActive(string $attachmentId): ?Attachment
    {
        $attachment = $this->find($attachmentId);

        if (null === $attachment || AttachmentStatus::Deleted === $attachment->getStatus()) {
            return null;
        }

        return $attachment;
    }

    /**
     * @return list<Attachment>
     */
    public function findDeletedWithoutLinks(): array
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb
            ->select('attachment')
            ->from(Attachment::class, 'attachment')
            ->leftJoin('App\\Entity\\Attachment\\AttachmentLink', 'attachmentLink', 'WITH', 'attachmentLink.attachment = attachment')
            ->where('attachment.status = :status')
            ->andWhere('attachmentLink.id IS NULL')
            ->setParameter('status', AttachmentStatus::Deleted)
            ->orderBy('attachment.deletedAt', 'ASC');

        /** @var list<Attachment> $result */
        $result = $qb->getQuery()->getResult();

        return $result;
    }
}
