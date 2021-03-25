<?php declare(strict_types = 1);

namespace Jeroenvanderlaan\PhpUnitCliSetup\Extension;

use Jeroenvanderlaan\PhpUnitCliSetup\Utility\ArgvTrait;
use Jeroenvanderlaan\PhpUnitCliSetup\Utility\CliTrait;
use PHPUnit\Runner\BeforeFirstTestHook;
use function array_intersect;

class CliSetupExtension implements BeforeFirstTestHook
{
    use ArgvTrait;

    use CliTrait;

    private string $command;

    private array $testSuites;

    public function __construct(string $command, array $testSuites = [])
    {
        $this->command = $command;
        $this->testSuites = $testSuites;
    }

    public function executeBeforeFirstTest(): void
    {
        if (true === empty($this->testSuites)) {
            $this->executeCommand($this->command);
        }
        $givenTestSuites = $this->getLongOptionsByName('testsuites');
        $matchingTestSuites = array_intersect($this->testSuites, $givenTestSuites);
        if (false === empty($matchingTestSuites)) {
            $this->executeCommand($this->command);
        }
    }

}
