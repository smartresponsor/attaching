<?php

declare(strict_types=1);

namespace App\Attaching\Repository\Marketplace\Attachment;

use App\Attaching\Entity\Attachment\AttachmentEntity as Attachment;
use App\Attaching\Entity\Attachment\AttachmentLinkEntity as AttachmentLink;
use App\Attaching\RepositoryInterface\Marketplace\Attachment\AttachmentMarketplaceRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final readonly class AttachmentMarketplaceRepository implements AttachmentMarketplaceRepositoryInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function findRootCategoryOwnerIds(): array
    {
        return $this->stringColumn(<<<'SQL'
SELECT category.id::text
FROM category
JOIN catalog ON catalog.id = category.catalog_id
WHERE catalog.object_code = 'retailing'
  AND category.parent_id IS NULL
  AND category.slug IN ('product', 'service', 'project', 'task', 'order')
  AND category.published = TRUE
ORDER BY category.id
SQL);
    }

    public function findPublishedRetailOwnerIds(): array
    {
        return $this->stringColumn("SELECT id::text FROM retail WHERE kind IN ('service', 'task') AND object_status = 'published' ORDER BY id");
    }

    public function findProfessionalVendorOwnerIds(): array
    {
        return $this->stringColumn(<<<'SQL'
SELECT vendor.id::text
FROM vendor
JOIN access ON access.id = vendor.owner_user_id
WHERE vendor.object_status = 'active'
  AND access.roles::text LIKE '%ROLE_PRO%'
ORDER BY vendor.id
SQL);
    }

    public function findCustomerOwnerIds(): array
    {
        return $this->stringColumn(<<<'SQL'
SELECT id::text
FROM access
WHERE email LIKE '%.customer@smartresponsor.local'
  AND roles::text NOT LIKE '%ROLE_PRO%'
ORDER BY id
SQL);
    }

    public function findLink(string $ownerType, string $ownerId, string $context, string $slot): ?AttachmentLink
    {
        $result = $this->entityManager->getRepository(AttachmentLink::class)->findOneBy([
            'ownerType' => $ownerType,
            'ownerId' => $ownerId,
            'context' => $context,
            'slot' => $slot,
        ]);

        return $result instanceof AttachmentLink ? $result : null;
    }

    public function findAttachmentByStoragePath(string $storagePath): ?Attachment
    {
        $result = $this->entityManager->getRepository(Attachment::class)->findOneBy(['storagePath' => $storagePath]);

        return $result instanceof Attachment ? $result : null;
    }

    public function persist(object $entity): void
    {
        $this->entityManager->persist($entity);
    }

    public function flush(): void
    {
        $this->entityManager->flush();
    }

    /** @return list<string> */
    private function stringColumn(string $sql): array
    {
        $values = $this->entityManager->getConnection()->fetchFirstColumn($sql);
        $strings = [];

        foreach ($values as $value) {
            if (!is_string($value) && !is_int($value) && !is_float($value)) {
                throw new \UnexpectedValueException('Marketplace owner identifier query returned a non-scalar value.');
            }

            $strings[] = (string) $value;
        }

        return $strings;
    }
}
