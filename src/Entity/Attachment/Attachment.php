<?php

declare(strict_types=1);

namespace App\Entity\Attachment;

use App\Enum\Attachment\AttachmentDocumentKind;
use App\Enum\Attachment\AttachmentMediaKind;
use App\Enum\Attachment\AttachmentStatus;
use App\Enum\Attachment\AttachmentStorageKind;
use App\Enum\Attachment\AttachmentType;
use App\Enum\Attachment\AttachmentVisibility;
use Doctrine\ORM\Mapping as ORM;

/**
 * Persistence model for a stored attachment.
 *
 * This entity is intentionally kept inside the persistence boundary.
 * Controllers and external component interactions must use DTO objects instead.
 */
#[ORM\Entity]
#[ORM\Table(name: 'attachment')]
class Attachment
{
    #[ORM\Id]
    #[ORM\Column(type: 'guid', unique: true)]
    private string $id;

    #[ORM\Column(enumType: AttachmentType::class)]
    private AttachmentType $type;

    #[ORM\Column(enumType: AttachmentMediaKind::class, nullable: true)]
    private ?AttachmentMediaKind $mediaKind = null;

    #[ORM\Column(enumType: AttachmentDocumentKind::class, nullable: true)]
    private ?AttachmentDocumentKind $documentKind = null;

    #[ORM\Column(enumType: AttachmentStorageKind::class)]
    private AttachmentStorageKind $storageKind;

    #[ORM\Column(enumType: AttachmentVisibility::class)]
    private AttachmentVisibility $visibility;

    #[ORM\Column(enumType: AttachmentStatus::class)]
    private AttachmentStatus $status;

    #[ORM\Column(length: 255)]
    private string $originalName;

    #[ORM\Column(length: 255)]
    private string $storedName;

    #[ORM\Column(length: 32, nullable: true)]
    private ?string $extension = null;

    #[ORM\Column(length: 191)]
    private string $mimeType;

    #[ORM\Column]
    private int $size;

    #[ORM\Column(length: 128)]
    private string $checksum;

    #[ORM\Column(length: 1024)]
    private string $storagePath;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $altText = null;

    #[ORM\Column(nullable: true)]
    private ?int $width = null;

    #[ORM\Column(nullable: true)]
    private ?int $height = null;

    #[ORM\Column(nullable: true)]
    private ?int $durationMs = null;

    #[ORM\Column(nullable: true)]
    private ?int $pageCount = null;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column]
    private \DateTimeImmutable $updatedAt;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $deletedAt = null;

    public function __construct(
        string $id,
        AttachmentType $type,
        AttachmentStorageKind $storageKind,
        AttachmentVisibility $visibility,
        string $originalName,
        string $storedName,
        string $mimeType,
        int $size,
        string $checksum,
        string $storagePath,
        ?string $extension = null,
        ?AttachmentMediaKind $mediaKind = null,
        ?AttachmentDocumentKind $documentKind = null,
        ?string $title = null,
        ?string $description = null,
        ?string $altText = null,
        ?int $width = null,
        ?int $height = null,
        ?int $durationMs = null,
        ?int $pageCount = null,
    ) {
        $now = new \DateTimeImmutable();

        $this->id = $id;
        $this->type = $type;
        $this->mediaKind = $mediaKind;
        $this->documentKind = $documentKind;
        $this->storageKind = $storageKind;
        $this->visibility = $visibility;
        $this->status = AttachmentStatus::Active;
        $this->originalName = $originalName;
        $this->storedName = $storedName;
        $this->extension = $extension;
        $this->mimeType = $mimeType;
        $this->size = $size;
        $this->checksum = $checksum;
        $this->storagePath = $storagePath;
        $this->title = $title;
        $this->description = $description;
        $this->altText = $altText;
        $this->width = $width;
        $this->height = $height;
        $this->durationMs = $durationMs;
        $this->pageCount = $pageCount;
        $this->createdAt = $now;
        $this->updatedAt = $now;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): AttachmentType
    {
        return $this->type;
    }

    public function getMediaKind(): ?AttachmentMediaKind
    {
        return $this->mediaKind;
    }

    public function getDocumentKind(): ?AttachmentDocumentKind
    {
        return $this->documentKind;
    }

    public function getStorageKind(): AttachmentStorageKind
    {
        return $this->storageKind;
    }

    public function getVisibility(): AttachmentVisibility
    {
        return $this->visibility;
    }

    public function getStatus(): AttachmentStatus
    {
        return $this->status;
    }

    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    public function getStoredName(): string
    {
        return $this->storedName;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getChecksum(): string
    {
        return $this->checksum;
    }

    public function getStoragePath(): string
    {
        return $this->storagePath;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getAltText(): ?string
    {
        return $this->altText;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function getDurationMs(): ?int
    {
        return $this->durationMs;
    }

    public function getPageCount(): ?int
    {
        return $this->pageCount;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function markDeleted(): void
    {
        $now = new \DateTimeImmutable();
        $this->status = AttachmentStatus::Deleted;
        $this->deletedAt = $now;
        $this->updatedAt = $now;
    }
}
