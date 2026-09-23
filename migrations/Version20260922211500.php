<?php

declare(strict_types=1);

namespace App\Attaching\Migrations;

use Doctrine\DBAL\Platforms\PostgreSQLPlatform;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\Table;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\Migrations\Exception\IrreversibleMigration;

final class Version20260922211500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Restore canonical lower_snake_case Attaching physical names and deterministic index/constraint names.';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf(!$this->connection->getDatabasePlatform() instanceof PostgreSQLPlatform, 'Attaching production schema requires PostgreSQL.');
        $this->abortIf(!$schema->hasTable('attachment'), 'Attachment table is required.');
        $this->abortIf(!$schema->hasTable('attachment_link'), 'Attachment link table is required.');

        $attachment = $schema->getTable('attachment');
        $link = $schema->getTable('attachment_link');

        foreach ([
            'mediaKind' => 'media_kind',
            'documentKind' => 'document_kind',
            'storageKind' => 'storage_kind',
            'originalName' => 'original_name',
            'storedName' => 'stored_name',
            'mimeType' => 'mime_type',
            'storagePath' => 'storage_path',
            'altText' => 'alt_text',
            'durationMs' => 'duration_ms',
            'pageCount' => 'page_count',
            'deletedAt' => 'deleted_at',
        ] as $legacy => $canonical) {
            $this->renameColumn($attachment, 'attachment', $legacy, $canonical);
        }

        foreach ([
            'ownerType' => 'owner_type',
            'ownerId' => 'owner_id',
            'isPrimary' => 'is_primary',
        ] as $legacy => $canonical) {
            $this->renameColumn($link, 'attachment_link', $legacy, $canonical);
        }

        $this->renameIndex($attachment, 'UNIQ_795FD9BBD17F50A6', 'uniq_attachment_uuid');
        $this->renameIndex($attachment, 'UNIQ_795FD9BB989D9B62', 'uniq_attachment_slug');
        $this->renameIndex($link, 'idx_cedf8dce464e68b', 'idx_attachment_link_attachment');

        if ($link->hasForeignKey('fk_cedf8dce464e68b') && !$link->hasForeignKey('fk_attachment_link_attachment')) {
            $this->addSql('ALTER TABLE attachment_link RENAME CONSTRAINT fk_cedf8dce464e68b TO fk_attachment_link_attachment');
        }
    }

    public function down(Schema $schema): void
    {
        throw new IrreversibleMigration('Canonical database naming convergence is intentionally irreversible.');
    }

    private function renameColumn(Table $table, string $tableName, string $legacy, string $canonical): void
    {
        $this->abortIf(
            $table->hasColumn($legacy) && $table->hasColumn($canonical),
            sprintf('%s contains both legacy column %s and canonical column %s.', $tableName, $legacy, $canonical),
        );

        if (!$table->hasColumn($legacy)) {
            return;
        }

        $this->addSql(sprintf(
            'ALTER TABLE %s RENAME COLUMN "%s" TO %s',
            $tableName,
            $legacy,
            $canonical,
        ));
    }

    private function renameIndex(Table $table, string $legacy, string $canonical): void
    {
        if (!$table->hasIndex($legacy) || $table->hasIndex($canonical)) {
            return;
        }

        $this->addSql(sprintf('ALTER INDEX "%s" RENAME TO %s', $legacy, $canonical));
    }
