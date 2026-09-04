<?php

declare(strict_types=1);

namespace App\Attaching\Migrations;

use Doctrine\DBAL\Platforms\PostgreSQLPlatform;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\Migrations\Exception\IrreversibleMigration;

final class Version20260819054000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adopt Objecting identity, title, audit, and state fields for existing Attaching records without removing legacy columns';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf(!$this->connection->getDatabasePlatform() instanceof PostgreSQLPlatform, 'Attaching production schema requires PostgreSQL.');
        $this->abortIf(!$schema->hasTable('attachment'), 'Attachment table is required before Objecting adoption.');
        $this->abortIf(!$schema->hasTable('attachment_link'), 'Attachment link table is required before Objecting adoption.');

        $attachment = $schema->getTable('attachment');
        foreach ([
            'object_uuid' => 'BYTEA DEFAULT NULL',
            'object_slug' => 'VARCHAR(190) DEFAULT NULL',
            'object_first_title' => 'VARCHAR(255) DEFAULT NULL',
            'object_middle_title' => 'TEXT DEFAULT NULL',
            'object_last_title' => 'TEXT DEFAULT NULL',
            'object_created_at' => 'TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL',
            'object_modified_at' => 'TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL',
            'object_created_by' => 'VARCHAR(190) DEFAULT NULL',
            'object_modified_by' => 'VARCHAR(190) DEFAULT NULL',
            'object_active' => 'BOOLEAN DEFAULT TRUE',
            'object_enabled' => 'BOOLEAN DEFAULT TRUE',
            'object_status' => 'VARCHAR(64) DEFAULT NULL',
        ] as $column => $definition) {
            if (!$attachment->hasColumn($column)) {
                $this->addSql(sprintf('ALTER TABLE attachment ADD %s %s', $column, $definition));
            }
        }

        $this->addSql("UPDATE attachment SET object_uuid = decode(md5('attachment:' || id::text), 'hex') WHERE object_uuid IS NULL");
        $this->addSql("UPDATE attachment SET object_slug = 'attachment-' || id::text WHERE object_slug IS NULL OR btrim(object_slug) = ''");
        $this->addSql('UPDATE attachment SET object_first_title = COALESCE(title, original_name) WHERE object_first_title IS NULL');
        $this->addSql('UPDATE attachment SET object_created_at = created_at WHERE object_created_at IS NULL');
        $this->addSql('UPDATE attachment SET object_modified_at = updated_at WHERE object_modified_at IS NULL');
        $this->addSql("UPDATE attachment SET object_active = CASE WHEN status = 'deleted' THEN FALSE ELSE TRUE END WHERE object_active IS NULL");
        $this->addSql('UPDATE attachment SET object_enabled = TRUE WHERE object_enabled IS NULL');
        $this->addSql('UPDATE attachment SET object_status = status WHERE object_status IS NULL');
        $this->addSql('ALTER TABLE attachment ALTER COLUMN object_uuid SET NOT NULL');
        $this->addSql('ALTER TABLE attachment ALTER COLUMN object_slug SET NOT NULL');
        $this->addSql('ALTER TABLE attachment ALTER COLUMN object_created_at SET NOT NULL');
        $this->addSql('ALTER TABLE attachment ALTER COLUMN object_active SET NOT NULL');
        $this->addSql('ALTER TABLE attachment ALTER COLUMN object_enabled SET NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX IF NOT EXISTS uniq_attachment_object_uuid ON attachment (object_uuid)');
        $this->addSql('CREATE UNIQUE INDEX IF NOT EXISTS uniq_attachment_object_slug ON attachment (object_slug)');

        $link = $schema->getTable('attachment_link');
        foreach ([
            'object_created_at' => 'TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL',
            'object_modified_at' => 'TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL',
            'object_created_by' => 'VARCHAR(190) DEFAULT NULL',
            'object_modified_by' => 'VARCHAR(190) DEFAULT NULL',
        ] as $column => $definition) {
            if (!$link->hasColumn($column)) {
                $this->addSql(sprintf('ALTER TABLE attachment_link ADD %s %s', $column, $definition));
            }
        }

        $this->addSql('UPDATE attachment_link SET object_created_at = created_at WHERE object_created_at IS NULL');
        $this->addSql('UPDATE attachment_link SET object_modified_at = updated_at WHERE object_modified_at IS NULL');
        $this->addSql('ALTER TABLE attachment_link ALTER COLUMN object_created_at SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        throw new IrreversibleMigration('Attaching Objecting adoption is durable production data and intentionally irreversible.');
    }
}
