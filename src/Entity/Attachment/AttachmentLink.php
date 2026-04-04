<?php

declare(strict_types=1);

namespace App\Entity\Attachment;

use Doctrine\ORM\Mapping as ORM;

/**
 * Persistence model for owner-to-attachment linking.
 *
 * The link keeps the component decoupled from neighbor entity classes by using
 * ownerType and ownerId instead of direct ORM relations to external components.
 */
#[ORM\Entity]
#[ORM\Table(name: 'attachment_link')]
class AttachmentLink
{
    #[ORM\Id]
    #[ORM\Column(type: 'guid', unique: true)]
    private string $id;

    #[ORM\ManyToOne(targetEntity: Attachment::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Attachment $attachment;

    #[ORM\Column(length: 191)]
    private string $ownerType;

    #[ORM\Column(length: 191)]
    private string $ownerId;

    #[ORM\Column(length: 191, nullable: true)]
    private ?string $context = null;

    #[ORM\Column(length: 191, nullable: true)]
    private ?string $slot = null;

    #[ORM\Column]
    private int $position = 0;

    #[ORM\Column]
    private bool $isPrimary = false;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column]
    private \DateTimeImmutable $updatedAt;
}
