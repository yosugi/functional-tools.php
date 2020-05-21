<?php
declare(strict_types=1);

namespace FunctionalTools;

use ReflectionFunction;

class Functions
{
    public static function compose(callable ...$fns): callable
    {
        $reversedFns = array_reverse($fns);
        return static::pipe(...$reversedFns);
    }

    public static function pipe(callable ...$fns): callable
    {
        return function ($initial = null) use ($fns) {
            $acc = $initial;
            foreach ($fns as $fn) {
                $acc = $fn($acc);
            }
            return $acc;
        };
    }

    public static function partial(callable $fn, ...$args): callable
    {
        return function (...$newArgs) use ($fn, $args) {
            $mergedArgs = array_merge($args, $newArgs);
            return $fn(...$mergedArgs);
        };
    }

    public static function curry(callable $fn, ...$args): callable
    {
        $refFn = new ReflectionFunction($fn);
        $fnArgNum = $refFn->getNumberOfParameters();

        return function (...$newArgs) use ($fn, $args, $fnArgNum) {
            $mergedArgs = array_merge($args, $newArgs);
            if (count($mergedArgs) >= $fnArgNum) {
                return $fn(...$mergedArgs);
            }
            return self::curry($fn, ...$mergedArgs);
        };
    }

    public static function tap(...$argInputs) //: mixed
    {
        $tapFn = function (...$inputs) {
            var_dump(...$inputs);
            return $inputs;
        };

        if (count($argInputs) == 0) {
            return $tapFn;
        }
        return $tapFn(...$argInputs);
    }
}
