<?php
declare(strict_types=1);

namespace FunctionalTools;

class Collections
{
    public static function filter(callable $predicate, ?iterable $argInputs = null) //: callable|array
    {
        $filterFn = function ($inputs) use ($predicate) {
            $results = [];
            foreach ($inputs as $key => $value) {
                if ($predicate($value, $key, $inputs)) {
                    $results[$key] = $value;
                }
            }
            return $results;
        };

        if ($argInputs === null) {
            return $filterFn;
        }

        return $filterFn($argInputs);
    }

    public static function map(callable $fn, ?iterable $argInputs = null) //: callable|array
    {
        $mapFn = function ($inputs) use ($fn) {
            $results = [];
            foreach ($inputs as $key => $value) {
                $results[$key] = $fn($value, $key, $inputs);
            }

            return $results;
        };

        if ($argInputs === null) {
            return $mapFn;
        }

        return $mapFn($argInputs);
    }

    public static function reduce(callable $fn, $initial, ?iterable $argInputs = null) //: callable|mixed
    {
        $reduceFn = function ($inputs) use ($fn, $initial) {
            $acc = $initial;
            foreach ($inputs as $key => $value) {
                $acc = $fn($acc, $value, $key, $inputs);
            };
            return $acc;
        };

        if ($argInputs === null) {
            return $reduceFn;
        }

        return $reduceFn($argInputs);
    }

    public static function head(iterable $argInputs) //: array
    {
        foreach ($argInputs as $value) {
            return $value;
        }
    }

    public static function rest(iterable $argInputs) //: array
    {
        $results = [];
        foreach ($argInputs as $value) {
            $results[] = $value;
        }
        return array_slice($results, 1);
    }

    public static function sortBy(callable $fn, ?iterable $argInputs = null) //: callable|array
    {
        $sortFn = function ($inputs) use ($fn) {
            uasort($inputs, $fn);
            return $inputs;
        };

        if ($argInputs === null) {
            return $sortFn;
        }

        return $sortFn($argInputs);
    }
}
