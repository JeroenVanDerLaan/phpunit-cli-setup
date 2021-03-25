<?php declare(strict_types = 1);

namespace Jeroenvanderlaan\PhpUnitCliSetup\Unit\Utility;

use Jeroenvanderlaan\PhpUnitCliSetup\Utility\CliTrait;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class CliTraitTest extends TestCase
{
    public function testExecuteCommandReturningNonZeroExitCode(): void
    {
        $service = new class {
            use CliTrait;
        };
        $this->expectException(RuntimeException::class);
        $service->executeCommand('foo');
    }
}
