<?php

declare(strict_types=1);

namespace App\Attaching\Tests\Integration\Command\Maintenance\Attachment;

use App\Attaching\Command\Maintenance\Attachment\AttachmentMigrateIdentifiersCommand;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Platforms\PostgreSQLPlatform;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

final class AttachmentMigrateIdentifiersCommandTest extends TestCase
{
    public function testAlreadyMigratedSchemaDoesNotBeginTransaction(): void
    {
        $connection = $this->createMock(Connection::class);
        $connection->method('getDatabasePlatform')->willReturn(new PostgreSQLPlatform());
        $connection->expects(self::exactly(2))->method('fetchOne')->willReturn('integer');
        $connection->expects(self::never())->method('beginTransaction');
        $connection->expects(self::never())->method('executeStatement');

        $tester = new CommandTester(new AttachmentMigrateIdentifiersCommand($connection));

        self::assertSame(Command::SUCCESS, $tester->execute([]));
        self::assertStringContainsString('already use integer columns', $tester->getDisplay());
    }

    public function testMigrationPreservesTransactionalSqlSequence(): void
    {
        $connection = $this->createMock(Connection::class);
        $connection->method('getDatabasePlatform')->willReturn(new PostgreSQLPlatform());
        $connection->method('fetchOne')->willReturn('uuid');
        $events = [];
        $connection->method('beginTransaction')->willReturnCallback(static function () use (&$events): void {
            $events[] = 'BEGIN';
        });
        $connection->method('executeStatement')->willReturnCallback(static function (string $sql) use (&$events): int {
            $events[] = trim($sql);

            return 0;
        });
        $connection->method('commit')->willReturnCallback(static function () use (&$events): void {
            $events[] = 'COMMIT';
        });
        $connection->expects(self::never())->method('rollBack');

        $tester = new CommandTester(new AttachmentMigrateIdentifiersCommand($connection));

        self::assertSame(Command::SUCCESS, $tester->execute([]));
        self::assertSame('BEGIN', $events[0]);
        self::assertSame('COMMIT', $events[array_key_last($events)]);

        $positions = [];
        foreach (array_slice($events, 1, -1) as $index => $sql) {
            if (str_starts_with($sql, 'CREATE TEMP TABLE attachment_id_map')) {
                $positions['map'] = $index;
            } elseif (str_starts_with($sql, 'ALTER TABLE attachment RENAME TO')) {
                $positions['rename'] = $index;
            } elseif (str_starts_with($sql, 'INSERT INTO attachment (')) {
                $positions['attachment'] = $index;
            } elseif (str_starts_with($sql, 'INSERT INTO attachment_link (')) {
                $positions['link'] = $index;
            } elseif (str_starts_with($sql, 'SELECT setval(')) {
                $positions['reseed'] ??= $index;
            } elseif (str_starts_with($sql, 'DROP TABLE attachment_legacy')) {
                $positions['drop'] = $index;
            }
        }

        self::assertSame(['map', 'rename', 'attachment', 'link', 'reseed', 'drop'], array_keys($positions));
        $ordered = array_values($positions);
        $sorted = $ordered;
        sort($sorted);
        self::assertSame($sorted, $ordered, 'SQL migration phases must execute in their declared order.');
        self::assertCount(6, array_unique($ordered));
    }
}
