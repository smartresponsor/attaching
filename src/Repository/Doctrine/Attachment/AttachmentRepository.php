<?php

declare(strict_types=1);

namespace App\Attaching\Repository\Doctrine\Attachment;

use App\Attaching\Entity\Persistence\Attachment\Attachment;
use App\Attaching\Entity\Persistence\Attachment\AttachmentLink;
use App\Attaching\Enum\Lifecycle\Attachment\AttachmentStatus;
use App\Attaching\RepositoryInterface\Persistence\Attachment\AttachmentRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final readonly class AttachmentRepository implements AttachmentRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
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
    public function find(int $attachmentId): ?Attachment
    {
        return $this->entityManager->find(Attachment::class, $attachmentId);
    }

    /**
     * @throws \Throwable when Doctrine cannot resolve or execute the entity lookup
     */
    public function findActive(int $attachmentId): ?Attachment
    {
        $attachment = $this->find($attachmentId);

        if (null === $attachment || AttachmentStatus::Deleted === $attachment->getStatus()) {
            return null;
        }

        return $attachment;
    }

    /**
     * @param list<int> $attachmentIds
     *
     * @return list<Attachment>
     */
    public function findByIds(array $attachmentIds): array
    {
        $attachmentIds = array_values(array_unique(array_filter($attachmentIds, static fn (int $id): bool => $id > 0)));
        if ([] === $attachmentIds) {
            return [];
        }

        /** @var list<Attachment> $result */
        $result = $this->entityManager->createQueryBuilder()
            ->select('attachment')
            ->from(Attachment::class, 'attachment')
            ->where('attachment.id IN (:attachmentIds)')
            ->setParameter('attachmentIds', $attachmentIds)
            ->orderBy('attachment.id', 'ASC')
            ->getQuery()
            ->getResult();

        return $result;
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
            ->leftJoin(AttachmentLink::class, 'attachmentLink', 'WITH', 'attachmentLink.attachment = attachment')
            ->where('attachment.status = :status')
            ->andWhere('attachmentLink.id IS NULL')
            ->setParameter('status', AttachmentStatus::Deleted)
            ->orderBy('attachment.deletedAt', 'ASC');

        /** @var list<Attachment> $result */
        $result = $qb->getQuery()->getResult();

        return $result;
    }
}
