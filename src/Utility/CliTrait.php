<?php declare(strict_types = 1);

namespace Jeroenvanderlaan\PhpUnitCliSetup\Utility;

use RuntimeException;
use function passthru;
use function sprintf;

trait CliTrait
{
    public function executeCommand(string $command): void
    {
        $exitCode = 0;
        passthru($command, $exitCode);
        if (0 !== $exitCode) {
            $message = sprintf('CLI command returned non-zero exit code %d', $exitCode);
            throw new RuntimeException($message);
        }
    }
}
