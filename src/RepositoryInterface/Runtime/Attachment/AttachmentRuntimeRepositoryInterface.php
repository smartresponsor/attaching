<?php

declare(strict_types=1);

namespace App\Attaching\RepositoryInterface\Runtime\Attachment;

use Doctrine\Common\DataFixtures\FixtureInterface;

interface AttachmentRuntimeRepositoryInterface
{
    /**
     * Rebuilds the Attaching schema from current Doctrine metadata.
     *
     * @return bool false when no Attaching metadata is available
     */
    public function rebuildSchema(): bool;

    /**
     * Executes runtime fixtures without purging the freshly rebuilt schema.
     *
     * @param list<FixtureInterface> $fixtures
     */
    public function executeFixtures(array $fixtures): void;
}
