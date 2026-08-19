<?php

declare(strict_types=1);

namespace App\Attaching\Migrations;

use Doctrine\DBAL\Platforms\PostgreSQLPlatform;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\Migrations\Exception\IrreversibleMigration;

final class Version20260819170000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Keep legacy Attaching audit columns insert-compatible while Objecting audit fields are canonical';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf(!$this->connection->getDatabasePlatform() instanceof PostgreSQLPlatform, 'Attaching production schema requires PostgreSQL.');

        foreach (['attachment', 'attachment_link'] as $tableName) {
            $this->abortIf(!$schema->hasTable($tableName), sprintf('%s table is required.', $tableName));
            $table = $schema->getTable($tableName);

            if ($table->hasColumn('created_at')) {
                $this->addSql(sprintf('ALTER TABLE %s ALTER COLUMN created_at SET DEFAULT CURRENT_TIMESTAMP', $tableName));
            }
            if ($table->hasColumn('updated_at')) {
                $this->addSql(sprintf('ALTER TABLE %s ALTER COLUMN updated_at SET DEFAULT CURRENT_TIMESTAMP', $tableName));
            }
        }
    }

    public function down(Schema $schema): void
    {
        throw new IrreversibleMigration('Legacy Attaching audit compatibility defaults are intentionally durable.');
    }
}
