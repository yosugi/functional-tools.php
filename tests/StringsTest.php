<?php
declare(strict_types=1);

namespace FunctionalTools\Tests;

use PHPUnit\Framework\TestCase;
use FunctionalTools\Strings;

class StringsTest extends TestCase
{
    public function testSplit()
    {
        $splitFn = Strings::split('.');
        $actual = $splitFn('a.b.c');
        $this->assertSame(['a', 'b', 'c'], $actual);

        $actual = Strings::split('.', 'a.b.c');
        $this->assertSame(['a', 'b', 'c'], $actual);
    }

    public function testJoin()
    {
        $joinFn = Strings::join('.');
        $actual = $joinFn(['a', 'b', 'c']);
        $this->assertSame('a.b.c', $actual);

        $actual = Strings::join('.', ['a', 'b', 'c']);
        $this->assertSame('a.b.c', $actual);
    }

    public function testReplace()
    {
        $replaceFn = Strings::replace('.', '-');
        $actual = $replaceFn('a.b.c');
        $this->assertSame('a-b-c', $actual);

        $actual = Strings::replace('.', '-', 'a.b.c');
        $this->assertSame('a-b-c', $actual);
    }

    public function testPregReplace()
    {
        $replaceFn = Strings::pregReplace('/[1-9]/', 'N');
        $actual = $replaceFn('1.2.3');
        $this->assertSame('N.N.N', $actual);

        $actual = Strings::pregReplace('/[1-9]/', 'N', '1.2.3');
        $this->assertSame('N.N.N', $actual);
    }

    public function testTrim()
    {
        $trimFn = Strings::trim();
        $actual = $trimFn(" a\tb\nc\r");
        $this->assertSame("a\tb\nc", $actual);

        $actual = Strings::trim(" a\tb\nc\r");
        $this->assertSame("a\tb\nc", $actual);
    }

    public function testStartsWith()
    {
        $actual = Strings::startsWith('start', '');
        $this->assertFalse($actual);

        $actual = Strings::startsWith('', 'start string');
        $this->assertFalse($actual);

        $startsWithFn = Strings::startsWith('start');
        $actual = $startsWithFn('start string');
        $this->assertTrue($actual);

        $actual = Strings::startsWith('start', ' start string');
        $this->assertFalse($actual);
    }

    public function testEndsWith()
    {
        $actual = Strings::endsWith('end', '');
        $this->assertFalse($actual);

        $actual = Strings::endsWith('', 'string end');
        $this->assertFalse($actual);

        $endsWithFn = Strings::endsWith('end');
        $actual = $endsWithFn('string end');
        $this->assertTrue($actual);

        $actual = Strings::endsWith('end', 'string end ');
        $this->assertFalse($actual);
    }
}
