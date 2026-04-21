<?php

declare(strict_types=1);

namespace App\Attaching\Repository\Attachment;

use App\Attaching\Entity\Attachment\Attachment;
use App\Attaching\Entity\Attachment\AttachmentLink;
use App\Attaching\Enum\Attachment\AttachmentStatus;
use Doctrine\ORM\EntityManagerInterface;

final readonly class AttachmentLinkRepository
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
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
            ->addOrderBy('attachmentLink.createdAt', 'ASC');

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

    public function findOne(string $attachmentId, string $ownerType, string $ownerId, ?string $context = null, ?string $slot = null): ?AttachmentLink
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
            ->orderBy('attachmentLink.createdAt', 'ASC')
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
