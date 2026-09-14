<?php

declare(strict_types=1);

namespace App\Attaching\DTO\Output\Attachment;

final readonly class AttachmentListViewDTO
{
    /**
     * @param list<AttachmentViewDTO> $items
     */
    public function __construct(
        public string $ownerType,
        public string $ownerId,
        public ?string $context,
        public ?string $slot,
        public array $items,
    ) {
    }
}
