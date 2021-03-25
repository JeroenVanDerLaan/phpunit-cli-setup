<?php declare(strict_types = 1);

namespace Jeroenvanderlaan\PhpUnitCliSetup\Functional\Extension;

use Jeroenvanderlaan\PhpUnitCliSetup\Extension\CliSetupExtension;
use PHPUnit\Framework\TestCase;
use function ob_get_clean;
use function ob_start;

class CliSetupExtensionTest extends TestCase
{
    public function testCommandIsExecutedWhenNoTestSuitesAreGiven(): void
    {
        $command = 'echo -n "Hello World"';
        $cliSetupExtension = new CliSetupExtension($command);
        ob_start();
        $cliSetupExtension->executeBeforeFirstTest();
        $output = ob_get_clean();
        $this->assertEquals('Hello World', $output);
    }

    public function testCommandIsNotExecutedWhenNoMatchingTestSuitesAreGiven(): void
    {
        $GLOBALS['argv'] = [
            '--foo=bar',
        ];
        $command = 'echo -n "Hello World"';
        $testSuites = ['baz'];
        $cliSetupExtension = new CliSetupExtension($command, $testSuites);
        ob_start();
        $cliSetupExtension->executeBeforeFirstTest();
        $output = ob_get_clean();
        $this->assertEquals('', $output);
    }
}
