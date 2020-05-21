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

        $actual = Arrays::get('d', $map);
        $this->assertNull($actual);
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
        $actual = Arrays::set('a', 20, $map);
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
        $nestedArray = [
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

        $actual = Arrays::flatten($nestedArray);
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

        $flattenFn = Arrays::flatten();
        $actual = $flattenFn($nestedArray);
    }

    public function testToPairs()
    {
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

        $toPairsFn = Arrays::toPairs();
        $actual = $toPairsFn($map);
        $this->assertSame($expect, $actual);
    }

    public function testFromPairs()
    {
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

        $fromPairsFn = Arrays::fromPairs();
        $actual = $fromPairsFn($pairs);
        $this->assertSame($expect, $actual);
    }

    public function testKeys()
    {
        $map = [
            'a' => 2,
            'b' => 1,
            'c' => 3,
        ];
        $actual = Arrays::keys($map);
        $this->assertSame(['a', 'b', 'c'], $actual);

        $keysFn = Arrays::keys();
        $actual = $keysFn($map);
        $this->assertSame(['a', 'b', 'c'], $actual);
    }

    public function testValues()
    {
        $map = [
            'a' => 2,
            'b' => 1,
            'c' => 3,
        ];
        $actual = Arrays::values($map);
        $this->assertSame([2, 1, 3], $actual);

        $valuesFn = Arrays::values();
        $actual = $valuesFn($map);
        $this->assertSame([2, 1, 3], $actual);
    }
}
