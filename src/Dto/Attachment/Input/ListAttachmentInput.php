<?php

declare(strict_types=1);

namespace App\Dto\Attachment\Input;

final readonly class ListAttachmentInput
{
    public function __construct(
        public string $ownerType,
        public string $ownerId,
        public ?string $context = null,
        public ?string $slot = null,
    ) {
    }
}
