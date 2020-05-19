<?php
declare(strict_types=1);

namespace Tests\FunctionalTools;

use PHPUnit\Framework\TestCase;
use FunctionalTools\Functions;

class FunctionsTest extends TestCase
{
    public function testCompose()
    {
        $add3 = fn ($a) => $a + 3;
        $mul2 = fn ($a) => $a * 2;
        $mul2Add3 = Functions::compose(
            $add3,
            $mul2,
        );
        $actual = $mul2Add3(2);
        $this->assertSame(7, $actual);

        $mul2 = fn ($a) => $a * 2;
        $mul2Add3For2 = Functions::compose(
            $add3,
            $mul2,
            fn () => 2,
        );
        $actual = $mul2Add3For2();
        $this->assertSame(7, $actual);
    }

    public function testPipe()
    {
        $add3 = fn ($a) => $a + 3;
        $mul2 = fn ($a) => $a * 2;
        $add3mul2For2 = Functions::pipe(
            fn () => 2,
            $add3,
            $mul2,
        );
        $actual = $add3mul2For2();
        $this->assertSame(10, $actual);
    }

    public function testPartial()
    {
        $add = fn ($a, $b) => $a + $b;
        $add3 = Functions::partial($add, 3);
        $actual = $add3(1);
        $this->assertSame(4, $actual);
    }

    public function testCurry()
    {
        $sum3 = function ($a1, $a2, $a3) {
            return $a1 + $a2 + $a3;
        };
        $curriedSum3 = Functions::curry($sum3);
        $actual = $curriedSum3(1)(2)(3);
        $this->assertSame(6, $actual);
    }
}
