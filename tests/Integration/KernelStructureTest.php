<?php

declare(strict_types=1);

namespace App\Attaching\Tests\Integration;

use PHPUnit\Framework\TestCase;

final class KernelStructureTest extends TestCase
{
    public function testStandaloneHostBundleSurfaceAndEmbeddedTestApplicationExist(): void
    {
        self::assertFileDoesNotExist(__DIR__.'/../../src/Kernel.php');

        self::assertFileExists(__DIR__.'/../../app/Kernel.php');
        self::assertFileExists(__DIR__.'/../../bin/console');
        self::assertFileExists(__DIR__.'/../../config/bundles.php');
        self::assertFileExists(__DIR__.'/../../config/services.yaml');
        self::assertFileExists(__DIR__.'/../../config/routes/attachment.yaml');
        self::assertFileExists(__DIR__.'/../../config/packages/framework.yaml');
        self::assertFileExists(__DIR__.'/../../config/packages/doctrine.yaml');
        self::assertFileExists(__DIR__.'/../../config/packages/security.yaml');
        self::assertFileExists(__DIR__.'/../../config/component/services.yaml');
        self::assertFileExists(__DIR__.'/../../config/component/routes.yaml');
        self::assertFileExists(__DIR__.'/../../tests/Application/Kernel.php');
        self::assertFileExists(__DIR__.'/../../tests/Application/config/bundles.php');
        self::assertFileExists(__DIR__.'/../../tests/Application/config/services.yaml');
        self::assertFileExists(__DIR__.'/../../tests/Application/config/routes/attributes.yaml');
        self::assertFileExists(__DIR__.'/../../tests/Application/config/packages/framework.yaml');
        self::assertFileExists(__DIR__.'/../../tests/Application/config/packages/doctrine.yaml');
        self::assertFileExists(__DIR__.'/../../phpunit.xml.dist');
    }
}
