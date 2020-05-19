<?php
declare(strict_types=1);

namespace Tests\FunctionalTools;

use PHPUnit\Framework\TestCase;
use FunctionalTools\Arrays;

class ArraysTest extends TestCase
{
    public function testGet()
    {
        $map = [
            'a' => 2,
            'b' => 1,
            'c' => 3,
        ];
        $getFn = Arrays::get('b');
        $actual = $getFn($map);
        $this->assertSame(1, $actual);
    }

    public function testSetNew()
    {
        $map = [
            'a' => 2,
            'b' => 1,
            'c' => 3,
        ];
        $setFn = Arrays::set('d', 10);
        $actual = $setFn($map);
        $expect = [
            'a' => 2,
            'b' => 1,
            'c' => 3,
            'd' => 10,
        ];
        $this->assertSame($expect, $actual);

        $expect = [
            'a' => 2,
            'b' => 1,
            'c' => 3,
        ];
        $this->assertSame($expect, $map);
    }

    public function testSetOverwrite()
    {
        $map = [
            'a' => 2,
            'b' => 1,
            'c' => 3,
        ];
        $setFn = Arrays::set('a', 20);
        $actual = $setFn($map);
        $expect = [
            'a' => 20,
            'b' => 1,
            'c' => 3,
        ];
        $this->assertSame($expect, $actual);

        $expect = [
            'a' => 2,
            'b' => 1,
            'c' => 3,
        ];
        $this->assertSame($expect, $map);
    }

    public function testFlatten()
    {
        // flatten
        $nestedList = [
            '1',
            '2',
            [
                '2.1',
                '2.2',
                '2.3',
            [
                '2.3.1',
                '2.3.2',
                '2.3.3',
            ],
            ],
            '3',
        ];

        $actual = Arrays::flatten($nestedList);
        $expect = [
            '1',
            '2',
            '2.1',
            '2.2',
            '2.3',
            '2.3.1',
            '2.3.2',
            '2.3.3',
            '3',
        ];
        $this->assertSame($expect, $actual);
    }

    public function testKeys()
    {
        // keys
        $map = [
            'a' => 2,
            'b' => 1,
            'c' => 3,
        ];
        $actual = Arrays::keys($map);
        $this->assertSame(['a', 'b', 'c'], $actual);
    }

    public function testValues()
    {
        // values
        $map = [
            'a' => 2,
            'b' => 1,
            'c' => 3,
        ];
        $actual = Arrays::values($map);
        $this->assertSame([2, 1, 3], $actual);
    }

    public function testToPairs()
    {
        // toPairs
        $map = [
            'a' => 2,
            'b' => 1,
            'c' => 3,
        ];
        $actual = Arrays::toPairs($map);
        $expect = [
            ['a', 2],
            ['b', 1],
            ['c', 3],
        ];
        $this->assertSame($expect, $actual);
    }

    public function testFromPairs()
    {
        // fromPairs
        $pairs = [
            ['a', 2],
            ['b', 1],
            ['c', 3],
        ];
        $actual = Arrays::fromPairs($pairs);
        $expect = [
            'a' => 2,
            'b' => 1,
            'c' => 3,
        ];
        $this->assertSame($expect, $actual);
    }
}
