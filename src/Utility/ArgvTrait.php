<?php declare(strict_types = 1);

namespace Jeroenvanderlaan\PhpUnitCliSetup\Utility;

use function array_unique;
use function is_array;
use function is_string;
use function ltrim;
use function sprintf;
use function str_starts_with;
use function strlen;
use function substr;

/**
 * Utility trait for extracting CLI input.
 * getopt is not usable in PHPUnit extension context.
 */
trait ArgvTrait
{
    /**
     * @return string[]
     */
    public function getLongOptionsByName(string $option): array
    {
        $argv = $GLOBALS['argv'];
        if (false === is_array($argv)) {
            return [];
        }
        $option = ltrim($option, '-');
        $option = sprintf('--%s', $option);
        $optionLength = strlen($option);
        $currentArgumentContainsOptionValue = false;
        $values = [];
        foreach ($argv as $argument) {
            if (false === is_string($argument)) {
                continue;
            }
            if (true === $currentArgumentContainsOptionValue) {
                $values[] = $argument;
                $currentArgumentContainsOptionValue = false;
            }
            if (false === str_starts_with($argument, $option)) {
                continue;
            }
            $value = substr($argument, $optionLength);
            if (false === $value) {
                continue;
            }
            if (false === str_starts_with($value, '=')) {
                $currentArgumentContainsOptionValue = true;
                continue;
            }
            $value = substr($value, 1);
            if (false === $value) {
                continue;
            }
            $values[] = $value;
        }
        return array_unique($values);
    }
}
