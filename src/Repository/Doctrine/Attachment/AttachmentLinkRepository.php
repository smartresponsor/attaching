<?php

declare(strict_types=1);

namespace App\Attaching\Repository\Doctrine\Attachment;

use App\Attaching\Entity\Persistence\Attachment\Attachment;
use App\Attaching\Entity\Persistence\Attachment\AttachmentLink;
use App\Attaching\Enum\Lifecycle\Attachment\AttachmentStatus;
use App\Attaching\RepositoryInterface\Persistence\Attachment\AttachmentLinkRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final readonly class AttachmentLinkRepository implements AttachmentLinkRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function save(AttachmentLink $attachmentLink): void
    {
        $this->entityManager->persist($attachmentLink);
        $this->entityManager->flush();
    }

    public function remove(AttachmentLink $attachmentLink): void
    {
        $this->entityManager->remove($attachmentLink);
        $this->entityManager->flush();
    }

    /**
     * @return list<AttachmentLink>
     */
    public function findByOwner(string $ownerType, string $ownerId, ?string $context = null, ?string $slot = null): array
    {
        $qb = $this->entityManager->createQueryBuilder()
            ->select('attachmentLink', 'attachment')
            ->from(AttachmentLink::class, 'attachmentLink')
            ->join('attachmentLink.attachment', 'attachment')
            ->where('attachmentLink.ownerType = :ownerType')
            ->andWhere('attachmentLink.ownerId = :ownerId')
            ->andWhere('attachment.status != :deletedStatus')
            ->setParameter('ownerType', $ownerType)
            ->setParameter('ownerId', $ownerId)
            ->setParameter('deletedStatus', AttachmentStatus::Deleted)
            ->orderBy('attachmentLink.position', 'ASC')
            ->addOrderBy('attachmentLink.objectAudit.objectCreatedAt', 'ASC');

        if (null !== $context) {
            $qb->andWhere('attachmentLink.context = :context')->setParameter('context', $context);
        }

        if (null !== $slot) {
            $qb->andWhere('attachmentLink.slot = :slot')->setParameter('slot', $slot);
        }

        /** @var list<AttachmentLink> $result */
        $result = $qb->getQuery()->getResult();

        return $result;
    }

    public function exists(int $attachmentId, string $ownerType, string $ownerId, ?string $context = null, ?string $slot = null): bool
    {
        return null !== $this->findOne($attachmentId, $ownerType, $ownerId, $context, $slot);
    }

    public function findOne(int $attachmentId, string $ownerType, string $ownerId, ?string $context = null, ?string $slot = null): ?AttachmentLink
    {
        $qb = $this->entityManager->createQueryBuilder()
            ->select('attachmentLink', 'attachment')
            ->from(AttachmentLink::class, 'attachmentLink')
            ->join('attachmentLink.attachment', 'attachment')
            ->where('attachment.id = :attachmentId')
            ->andWhere('attachmentLink.ownerType = :ownerType')
            ->andWhere('attachmentLink.ownerId = :ownerId')
            ->andWhere('attachment.status != :deletedStatus')
            ->setParameter('attachmentId', $attachmentId)
            ->setParameter('ownerType', $ownerType)
            ->setParameter('ownerId', $ownerId)
            ->setParameter('deletedStatus', AttachmentStatus::Deleted)
            ->setMaxResults(1);

        if (null !== $context) {
            $qb->andWhere('attachmentLink.context = :context')->setParameter('context', $context);
        }

        if (null !== $slot) {
            $qb->andWhere('attachmentLink.slot = :slot')->setParameter('slot', $slot);
        }

        /** @var ?AttachmentLink $result */
        $result = $qb->getQuery()->getOneOrNullResult();

        return $result;
    }

    public function findPrimaryForOwnerSlot(string $ownerType, string $ownerId, string $context, string $slot): ?AttachmentLink
    {
        $qb = $this->entityManager->createQueryBuilder()
            ->select('attachmentLink', 'attachment')
            ->from(AttachmentLink::class, 'attachmentLink')
            ->join('attachmentLink.attachment', 'attachment')
            ->where('attachmentLink.ownerType = :ownerType')
            ->andWhere('attachmentLink.ownerId = :ownerId')
            ->andWhere('attachmentLink.context = :context')
            ->andWhere('attachmentLink.slot = :slot')
            ->andWhere('attachmentLink.isPrimary = true')
            ->andWhere('attachment.status != :deletedStatus')
            ->setParameter('ownerType', $ownerType)
            ->setParameter('ownerId', $ownerId)
            ->setParameter('context', $context)
            ->setParameter('slot', $slot)
            ->setParameter('deletedStatus', AttachmentStatus::Deleted)
            ->orderBy('attachmentLink.position', 'ASC')
            ->addOrderBy('attachmentLink.objectAudit.objectCreatedAt', 'DESC')
            ->setMaxResults(1);

        /** @var ?AttachmentLink $result */
        $result = $qb->getQuery()->getOneOrNullResult();

        return $result;
    }

    /**
     * @param list<int> $attachmentIds
     *
     * @return list<AttachmentLink>
     */
    public function findByAttachmentIds(array $attachmentIds): array
    {
        $attachmentIds = array_values(array_unique(array_filter($attachmentIds, static fn (int $id): bool => $id > 0)));
        if ([] === $attachmentIds) {
            return [];
        }

        /** @var list<AttachmentLink> $result */
        $result = $this->entityManager->createQueryBuilder()
            ->select('attachmentLink', 'attachment')
            ->from(AttachmentLink::class, 'attachmentLink')
            ->join('attachmentLink.attachment', 'attachment')
            ->where('attachment.id IN (:attachmentIds)')
            ->setParameter('attachmentIds', $attachmentIds)
            ->orderBy('attachment.id', 'ASC')
            ->addOrderBy('attachmentLink.position', 'ASC')
            ->addOrderBy('attachmentLink.objectAudit.objectCreatedAt', 'ASC')
            ->getQuery()
            ->getResult();

        return $result;
    }

    /**
     * @return list<AttachmentLink>
     */
    public function findByAttachmentId(int $attachmentId): array
    {
        /** @var list<AttachmentLink> $result */
        $result = $this->entityManager->createQueryBuilder()
            ->select('attachmentLink', 'attachment')
            ->from(AttachmentLink::class, 'attachmentLink')
            ->join('attachmentLink.attachment', 'attachment')
            ->where('attachment.id = :attachmentId')
            ->setParameter('attachmentId', $attachmentId)
            ->orderBy('attachmentLink.position', 'ASC')
            ->addOrderBy('attachmentLink.objectAudit.objectCreatedAt', 'ASC')
            ->getQuery()
            ->getResult();

        return $result;
    }

    /**
     * @return list<AttachmentLink>
     */
    public function findByAttachment(Attachment $attachment): array
    {
        /** @var list<AttachmentLink> $result */
        $result = $this->entityManager->createQueryBuilder()
            ->select('attachmentLink')
            ->from(AttachmentLink::class, 'attachmentLink')
            ->where('attachmentLink.attachment = :attachment')
            ->setParameter('attachment', $attachment)
            ->orderBy('attachmentLink.objectAudit.objectCreatedAt', 'ASC')
            ->getQuery()
            ->getResult();

        return $result;
    }

    public function clearPrimaryForOwnerSlot(string $ownerType, string $ownerId, ?string $context = null, ?string $slot = null): void
    {
        foreach ($this->findByOwner($ownerType, $ownerId, $context, $slot) as $attachmentLink) {
            if ($attachmentLink->isPrimary()) {
                $attachmentLink->clearPrimary();
            }
        }

        $this->entityManager->flush();
    }
}
