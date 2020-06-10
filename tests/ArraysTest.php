<?php
declare(strict_types=1);

namespace FunctionalTools\Tests;

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

    public function testFilter()
    {
        $numbers = range(1, 5);
        $selectEvenFn = Arrays::filter(fn ($val) => $val % 2 == 0);
        $actual = $selectEvenFn($numbers);
        $this->assertSame([1 => 2, 3 => 4], $actual);

        $actual = Arrays::filter(fn ($val) => $val % 2 == 0, $numbers);
        $this->assertSame([1 => 2, 3 => 4], $actual);
    }

    public function testMap()
    {
        $numbers = range(1, 5);
        $incrementFn = Arrays::map(fn ($val) => $val + 1);
        $actual = $incrementFn($numbers);
        $this->assertSame([2, 3, 4, 5, 6], $actual);

        $actual = Arrays::map(fn ($val) => $val + 1, $numbers);
        $this->assertSame([2, 3, 4, 5, 6], $actual);
    }

    public function testReduce()
    {
        $numbers = range(1, 5);
        $sumFn = Arrays::reduce(fn ($acc, $val) => $acc + $val, 0);
        $actual = $sumFn($numbers);
        $this->assertSame(15, $actual);

        $actual = Arrays::reduce(fn ($acc, $val) => $acc + $val, 0, $numbers);
        $this->assertSame(15, $actual);
    }

    public function testHead()
    {
        $numbers = [1, 2, 3];
        $actual = Arrays::head($numbers);
        $this->assertSame(1, $actual);
        $this->assertSame([1, 2, 3], $numbers);

        $headFn = Arrays::head();
        $actual = $headFn($numbers);
        $this->assertSame(1, $actual);
    }

    public function testRest()
    {
        $numbers = [1, 2, 3];
        $actual = Arrays::rest($numbers);
        $this->assertSame([2, 3], $actual);
        $this->assertSame([1, 2, 3], $numbers);

        $restFn = Arrays::rest();
        $actual = $restFn($numbers);
        $this->assertSame([2, 3], $actual);
    }

    public function testSortBy()
    {
        // sortBy
        $map = [
            'a' => 2,
            'b' => 1,
            'c' => 3,
        ];
        $actual = Arrays::sortBy(fn ($a, $b) => $a <=> $b, $map);
        $expect = [
            'b' => 1,
            'a' => 2,
            'c' => 3,
        ];
        $this->assertSame($expect, $actual);

        $sortFn = Arrays::sortBy(fn ($a, $b) => $a <=> $b);
        $actual = $sortFn($map);
        $this->assertSame($expect, $actual);

        $expect = [
            'a' => 2,
            'b' => 1,
            'c' => 3,
        ];
        $this->assertSame($expect, $map);
    }
}
