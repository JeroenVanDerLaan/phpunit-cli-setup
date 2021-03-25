<?php declare(strict_types = 1);

namespace Jeroenvanderlaan\PhpUnitCliSetup\Unit\Utility;

use Jeroenvanderlaan\PhpUnitCliSetup\Utility\ArgvTrait;
use PHPUnit\Framework\TestCase;

class ArgvTraitTest extends TestCase
{
    public function testGetLongOptionsByName(): void
    {
        $GLOBALS['argv'] = [
            '--foo=bar',
            '--foo',
            'baz'
        ];
        $service = new class {
            use ArgvTrait;
        };
        $expected = ['bar', 'baz'];
        $actual = $service->getLongOptionsByName('foo');
        $this->assertEquals($expected, $actual);
    }

    public function testGetLongOptionsByNameWithNonArrayArgv(): void
    {
        $GLOBALS['argv'] = 'foo';
        $service = new class {
            use ArgvTrait;
        };
        $expected = [];
        $actual = $service->getLongOptionsByName('foo');
        $this->assertEquals($expected, $actual);
    }

    public function testGetLongOptionsByNameWithNonStringArgvElement(): void
    {
        $GLOBALS['argv'] = [
            '--foo=bar',
            123,
            '--foo',
            'baz'
        ];
        $service = new class {
            use ArgvTrait;
        };
        $expected = ['bar', 'baz'];
        $actual = $service->getLongOptionsByName('foo');
        $this->assertEquals($expected, $actual);
    }
}
