<?php
declare(strict_types=1);

namespace Tests\FunctionalTools;

use PHPUnit\Framework\TestCase;
use FunctionalTools\Strings;

class StringsTest extends TestCase
{
    public function testSplit()
    {
        $splitFn = Strings::split('.');
        $actual = $splitFn('a.b.c');
        $this->assertSame(['a', 'b', 'c'], $actual);
    }

    public function testJoin()
    {
        $joinFn = Strings::join('.');
        $actual = $joinFn(['a', 'b', 'c']);
        $this->assertSame('a.b.c', $actual);
    }

    public function testReplace()
    {
        $replaceFn = Strings::replace('.', '-');
        $actual = $replaceFn('a.b.c');
        $this->assertSame('a-b-c', $actual);
    }

    public function testPregReplace()
    {
        $replaceFn = Strings::pregReplace('/[1-9]/', 'N');
        $actual = $replaceFn('1.2.3');
        $this->assertSame('N.N.N', $actual);
    }

    public function testTrim()
    {
        $actual = Strings::trim(" a\tb\nc\r");
        $this->assertSame("a\tb\nc", $actual);
    }
}
