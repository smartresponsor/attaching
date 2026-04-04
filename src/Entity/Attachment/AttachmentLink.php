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

    public function __construct(
        string $id,
        Attachment $attachment,
        string $ownerType,
        string $ownerId,
        ?string $context = null,
        ?string $slot = null,
        int $position = 0,
        bool $isPrimary = false,
    ) {
        $now = new \DateTimeImmutable();

        $this->id = $id;
        $this->attachment = $attachment;
        $this->ownerType = $ownerType;
        $this->ownerId = $ownerId;
        $this->context = $context;
        $this->slot = $slot;
        $this->position = $position;
        $this->isPrimary = $isPrimary;
        $this->createdAt = $now;
        $this->updatedAt = $now;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAttachment(): Attachment
    {
        return $this->attachment;
    }

    public function getOwnerType(): string
    {
        return $this->ownerType;
    }

    public function getOwnerId(): string
    {
        return $this->ownerId;
    }

    public function getContext(): ?string
    {
        return $this->context;
    }

    public function getSlot(): ?string
    {
        return $this->slot;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function isPrimary(): bool
    {
        return $this->isPrimary;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function clearPrimary(): void
    {
        $this->isPrimary = false;
        $this->updatedAt = new \DateTimeImmutable();
    }
}
