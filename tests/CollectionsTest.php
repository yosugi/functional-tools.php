<?php
declare(strict_types=1);

namespace FunctionalTools\Tests;

use ArrayObject;
use PHPUnit\Framework\TestCase;
use FunctionalTools\Collections;

class CollectionsTest extends TestCase
{
    public function testFilter()
    {
        $numbers = new ArrayObject(range(1, 5));
        $selectEvenFn = Collections::filter(fn ($val) => $val % 2 == 0);
        $actual = $selectEvenFn($numbers);
        $this->assertSame([1 => 2, 3 => 4], $actual);

        $actual = Collections::filter(fn ($val) => $val % 2 == 0, $numbers);
        $this->assertSame([1 => 2, 3 => 4], $actual);
    }

    public function testMap()
    {
        $numbers = new ArrayObject(range(1, 5));
        $incrementFn = Collections::map(fn ($val) => $val + 1);
        $actual = $incrementFn($numbers);
        $this->assertSame([2, 3, 4, 5, 6], $actual);

        $actual = Collections::map(fn ($val) => $val + 1, $numbers);
        $this->assertSame([2, 3, 4, 5, 6], $actual);
    }

    public function testReduce()
    {
        $numbers = new ArrayObject(range(1, 5));
        $sumFn = Collections::reduce(fn ($acc, $val) => $acc + $val, 0);
        $actual = $sumFn($numbers);
        $this->assertSame(15, $actual);

        $actual = Collections::reduce(fn ($acc, $val) => $acc + $val, 0, $numbers);
        $this->assertSame(15, $actual);
    }

    public function testHead()
    {
        // empty case
        $actual = Collections::head([]);
        $this->assertSame(null, $actual);

        // usual case
        $numbers = new ArrayObject([1, 2, 3]);
        $actual = Collections::head($numbers);
        $this->assertSame(1, $actual);
        $this->assertEquals(new ArrayObject([1, 2, 3]), $numbers);

        $headFn = Collections::head();
        $actual = $headFn($numbers);
        $this->assertSame(1, $actual);
    }

    public function testRest()
    {
        // empty case
        $actual = Collections::rest([]);
        $this->assertSame([], $actual);

        // usual case
        $numbers = new ArrayObject([1, 2, 3]);
        $actual = Collections::rest($numbers);
        $this->assertSame([2, 3], $actual);
        $this->assertEquals(new ArrayObject([1, 2, 3]), $numbers);

        $restFn = Collections::rest();
        $actual = $restFn($numbers);
        $this->assertSame([2, 3], $actual);
    }

    public function testSortBy()
    {
        // sortBy
        $map = new ArrayObject([
            2,
            1,
            3,
        ]);
        $actual = Collections::sortBy(fn ($a, $b) => $a <=> $b, $map);
        $expect = [
            1,
            2,
            3,
        ];
        $this->assertSame($expect, $actual);

        $sortFn = Collections::sortBy(fn ($a, $b) => $a <=> $b);
        $actual = $sortFn($map);
        $this->assertSame($expect, $actual);

        $expect = new ArrayObject([
            2,
            1,
            3,
        ]);
        $this->assertEquals($expect, $map);
    }

    public function testMerge()
    {
        $firstMap = new ArrayObject([
            'a' => 1,
            'b' => 2,
            'c' => 3,
        ]);
        $secondMap = new ArrayObject([
            'c' => 4,
            'd' => 5,
            'e' => 6,
        ]);
        $actual = Collections::merge($firstMap, $secondMap);
        $expect = [
            'a' => 1,
            'b' => 2,
            'c' => 4,
            'd' => 5,
            'e' => 6,
        ];
        $this->assertSame($expect, $actual);
    }
}
