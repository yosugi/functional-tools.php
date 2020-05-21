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

        return $argInputs === null ? $filterFn : $filterFn($argInputs);
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

        return $argInputs === null ? $mapFn : $mapFn($argInputs);
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

        return $argInputs === null ? $reduceFn : $reduceFn($argInputs);
    }

    public static function head(?iterable $argInputs = null) //: callable|array
    {
        $headFn = function ($inputs) {
            foreach ($inputs as $value) {
                return $value;
            }
        };

        return $argInputs === null ? $headFn : $headFn($argInputs);
    }

    public static function rest(?iterable $argInputs = null) //: callable|array
    {
        $restFn = function ($inputs) {
            $results = [];
            foreach ($inputs as $value) {
                $results[] = $value;
            }
            return array_slice($results, 1);
        };

        return $argInputs === null ? $restFn : $restFn($argInputs);
    }

    public static function sortBy(callable $fn, ?iterable $argInputs = null) //: callable|array
    {
        $sortFn = function ($inputs) use ($fn) {
            uasort($inputs, $fn);
            return $inputs;
        };

        return $argInputs === null ? $sortFn : $sortFn($argInputs);
    }
}
