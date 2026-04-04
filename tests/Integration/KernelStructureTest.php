<?php

declare(strict_types=1);

namespace App\Tests\Integration;

use PHPUnit\Framework\TestCase;

final class KernelStructureTest extends TestCase
{
    public function testKernelAndPrimaryConfigurationFilesExist(): void
    {
        self::assertFileExists(__DIR__.'/../../src/Kernel.php');
        self::assertFileExists(__DIR__.'/../../config/bundles.php');
        self::assertFileExists(__DIR__.'/../../config/services.yaml');
        self::assertFileExists(__DIR__.'/../../config/routes/attributes.yaml');
        self::assertFileExists(__DIR__.'/../../config/packages/framework.yaml');
        self::assertFileExists(__DIR__.'/../../config/packages/doctrine.yaml');
        self::assertFileExists(__DIR__.'/../../phpunit.xml.dist');
    }
}
