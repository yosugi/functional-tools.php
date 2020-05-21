<?php
declare(strict_types=1);

namespace Tests\FunctionalTools;

use PHPUnit\Framework\TestCase;
use FunctionalTools\Collections;

class CollectionsTest extends TestCase
{
    public function testFilter()
    {
        $numbers = range(1, 5);
        $selectEvenFn = Collections::filter(fn ($val) => $val % 2 == 0);
        $actual = $selectEvenFn($numbers);
        $this->assertSame([1 => 2, 3 => 4], $actual);

        $actual = Collections::filter(fn ($val) => $val % 2 == 0, $numbers);
        $this->assertSame([1 => 2, 3 => 4], $actual);
    }

    public function testMap()
    {
        $numbers = range(1, 5);
        $incrementFn = Collections::map(fn ($val) => $val + 1);
        $actual = $incrementFn($numbers);
        assert($actual === [2, 3, 4, 5, 6]);
        $this->assertSame([2, 3, 4, 5, 6], $actual);

        $actual = Collections::map(fn ($val) => $val + 1, $numbers);
        $this->assertSame([2, 3, 4, 5, 6], $actual);
    }

    public function testReduce()
    {
        $numbers = range(1, 5);
        $sumFn = Collections::reduce(fn ($acc, $val) => $acc + $val, 0);
        $actual = $sumFn($numbers);
        $this->assertSame(15, $actual);

        $actual = Collections::reduce(fn ($acc, $val) => $acc + $val, 0, $numbers);
        $this->assertSame(15, $actual);
    }

    public function testHead()
    {
        $numbers = [1, 2, 3];
        $actual = Collections::head($numbers);
        $this->assertSame(1, $actual);
        $this->assertSame([1, 2, 3], $numbers);

        $headFn = Collections::head();
        $actual = $headFn($numbers);
        $this->assertSame(1, $actual);
    }

    public function testRest()
    {
        $numbers = [1, 2, 3];
        $actual = Collections::rest($numbers);
        $this->assertSame([2, 3], $actual);
        $this->assertSame([1, 2, 3], $numbers);

        $restFn = Collections::rest();
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
        $actual = Collections::sortBy(fn ($a, $b) => $a <=> $b, $map);
        $expect = [
            'b' => 1,
            'a' => 2,
            'c' => 3,
        ];
        $this->assertSame($expect, $actual);

        $sortFn = Collections::sortBy(fn ($a, $b) => $a <=> $b);
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
