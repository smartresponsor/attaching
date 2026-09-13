<?php

declare(strict_types=1);

namespace App\Attaching\RepositoryInterface\Persistence\Attachment;

use App\Attaching\Entity\Persistence\Attachment\Attachment;

interface AttachmentRepositoryInterface
{
    public function save(Attachment $attachment): void;

    public function remove(Attachment $attachment): void;

    public function find(int $attachmentId): ?Attachment;

    public function findActive(int $attachmentId): ?Attachment;

    /**
     * @param list<int> $attachmentIds
     *
     * @return list<Attachment>
     */
    public function findByIds(array $attachmentIds): array;

    /** @return list<Attachment> */
    public function findDeletedWithoutLinks(): array;
}
