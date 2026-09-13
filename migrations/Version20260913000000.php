<?php

declare(strict_types=1);

namespace App\Attaching\Migrations;

use Doctrine\DBAL\Platforms\PostgreSQLPlatform;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\Table;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\Migrations\Exception\IrreversibleMigration;

final class Version20260913000000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Converge legacy Attaching physical columns to current Doctrine metadata.';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf(!$this->connection->getDatabasePlatform() instanceof PostgreSQLPlatform, 'Attaching production schema requires PostgreSQL.');
        $this->abortIf(!$schema->hasTable('attachment'), 'Attachment table is required.');
        $this->abortIf(!$schema->hasTable('attachment_link'), 'Attachment link table is required.');

        $attachment = $schema->getTable('attachment');
        $link = $schema->getTable('attachment_link');

        foreach ([
            'media_kind' => 'mediaKind',
            'document_kind' => 'documentKind',
            'storage_kind' => 'storageKind',
            'original_name' => 'originalName',
            'stored_name' => 'storedName',
            'mime_type' => 'mimeType',
            'storage_path' => 'storagePath',
            'alt_text' => 'altText',
            'duration_ms' => 'durationMs',
            'page_count' => 'pageCount',
            'deleted_at' => 'deletedAt',
        ] as $legacy => $canonical) {
            $this->renameColumnIfNeeded($attachment, 'attachment', $legacy, $canonical);
        }

        foreach ([
            'owner_type' => 'ownerType',
            'owner_id' => 'ownerId',
            'is_primary' => 'isPrimary',
        ] as $legacy => $canonical) {
            $this->renameColumnIfNeeded($link, 'attachment_link', $legacy, $canonical);
        }

        foreach ([
            'object_uuid' => 'uuid',
            'object_slug' => 'slug',
            'object_first_title' => 'first_title',
            'object_middle_title' => 'middle_title',
            'object_last_title' => 'last_title',
            'object_created_at' => 'created_at',
            'object_modified_at' => 'modified_at',
            'object_created_by' => 'created_by',
            'object_modified_by' => 'modified_by',
            'object_active' => 'active',
            'object_enabled' => 'enabled',
            'object_status' => 'status',
        ] as $legacy => $canonical) {
            $this->mergeLegacyColumn($attachment, 'attachment', $legacy, $canonical);
        }

        foreach ([
            'object_created_at' => 'created_at',
            'object_modified_at' => 'modified_at',
            'object_created_by' => 'created_by',
            'object_modified_by' => 'modified_by',
        ] as $legacy => $canonical) {
            $this->mergeLegacyColumn($link, 'attachment_link', $legacy, $canonical);
        }

        $this->convergeUpdatedAt($attachment, 'attachment');
        $this->convergeUpdatedAt($link, 'attachment_link');

        $this->addSql('ALTER TABLE attachment ALTER COLUMN created_at DROP DEFAULT');
        $this->addSql('ALTER TABLE attachment ALTER COLUMN status DROP NOT NULL');
        $this->addSql('ALTER TABLE attachment_link ALTER COLUMN created_at DROP DEFAULT');

        $this->addSql('DROP INDEX IF EXISTS uniq_attachment_object_uuid');
        $this->addSql('DROP INDEX IF EXISTS uniq_attachment_object_slug');
        $this->addSql('CREATE UNIQUE INDEX IF NOT EXISTS "UNIQ_795FD9BBD17F50A6" ON attachment (uuid)');
        $this->addSql('CREATE UNIQUE INDEX IF NOT EXISTS "UNIQ_795FD9BB989D9B62" ON attachment (slug)');
        $this->addSql('CREATE INDEX IF NOT EXISTS "IDX_CEDF8DCE464E68B" ON attachment_link (attachment_id)');

        if ($link->hasForeignKey('fk_attachment_link_attachment')) {
            $this->addSql('ALTER TABLE attachment_link RENAME CONSTRAINT fk_attachment_link_attachment TO "FK_CEDF8DCE464E68B"');
        }
    }

    public function down(Schema $schema): void
    {
        throw new IrreversibleMigration('Canonical physical column convergence is intentionally irreversible.');
    }

    private function renameColumnIfNeeded(Table $table, string $tableName, string $legacy, string $canonical): void
    {
        if (!$table->hasColumn($legacy) || $table->hasColumn($canonical)) {
            return;
        }

        $this->addSql(sprintf('ALTER TABLE %s RENAME COLUMN %s TO "%s"', $tableName, $legacy, $canonical));
    }

    private function mergeLegacyColumn(Table $table, string $tableName, string $legacy, string $canonical): void
    {
        if (!$table->hasColumn($legacy)) {
            return;
        }

        if (!$table->hasColumn($canonical)) {
            $this->addSql(sprintf('ALTER TABLE %s RENAME COLUMN %s TO "%s"', $tableName, $legacy, $canonical));

            return;
        }

        $this->addSql(sprintf(
            'UPDATE %s SET "%s" = COALESCE("%s", "%s") WHERE "%s" IS NOT NULL',
            $tableName,
            $canonical,
            $legacy,
            $canonical,
            $legacy,
        ));
        $this->addSql(sprintf('ALTER TABLE %s DROP COLUMN "%s"', $tableName, $legacy));
    }

    private function convergeUpdatedAt(Table $table, string $tableName): void
    {
        if (!$table->hasColumn('updated_at')) {
            return;
        }

        if ($table->hasColumn('object_modified_at')) {
            $this->addSql(sprintf('ALTER TABLE %s DROP COLUMN updated_at', $tableName));

            return;
        }

        if (!$table->hasColumn('modified_at')) {
            $this->addSql(sprintf('ALTER TABLE %s RENAME COLUMN updated_at TO modified_at', $tableName));

            return;
        }

        $this->addSql(sprintf('UPDATE %s SET modified_at = COALESCE(updated_at, modified_at) WHERE updated_at IS NOT NULL', $tableName));
        $this->addSql(sprintf('ALTER TABLE %s DROP COLUMN updated_at', $tableName));
    }
}

