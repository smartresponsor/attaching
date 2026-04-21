<?php

declare(strict_types=1);

namespace App\Attaching\Dto\Attachment\Output;

final readonly class AttachmentListView
{
    /**
     * @param list<AttachmentView> $items
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
