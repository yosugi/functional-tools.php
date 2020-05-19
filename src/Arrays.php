<?php
declare(strict_types=1);

namespace FunctionalTools;

class Arrays
{
    public static function get(string $key, ?array $argInputArray = null) //: callable|mixed
    {
        $getFn = function ($inputArray) use ($key) {
            if (array_key_exists($key, $inputArray)) {
                return $inputArray[$key];
            }

            return null;
        };

        if ($argInputArray === null) {
            return $getFn;
        }

        return $getFn($argInputArray);
    }

    public static function set(string $key, $value, ?array $argInputArray = null) //: callable|array
    {
        $setFn = function ($inputArray) use ($key, $value) {
            $inputArray[$key] = $value;

            return $inputArray;
        };

        if ($argInputArray === null) {
            return $setFn;
        }

        return $setFn($argInputArray);
    }

    public static function flatten(array $argInputs) //: array
    {
        $results = [];
        foreach ($argInputs as $value) {
            if (!is_array($value)) {
                $results[] = $value;
                continue;
            }

            $values = static::flatten($value);
            $results = array_merge($results, $values);
        }
        return $results;
    }

    public static function toPairs(array $argInputs) //: array
    {
        $resultPairs = [];
        foreach ($argInputs as $key => $value) {
            $resultPairs[] = [$key, $value];
        }
        return $resultPairs;
    }

    public static function fromPairs(array $argInputs) //: array
    {
        $resultMap  = [];
        foreach ($argInputs as $pairs) {
            list($key, $value) = $pairs;
            $resultMap[$key] = $value;
        }
        return $resultMap;
    }

    public static function keys(array $argInputs) //: array
    {
        return array_keys($argInputs);
    }

    public static function values(array $argInputs) //: array
    {
        return array_values($argInputs);
    }

    // aliases

    public static function filter(callable $predicate, ?array $argInputs = null) //: callable|array
    {
        return Collections::filter($predicate, $argInputs);
    }

    public static function map(callable $fn, ?array $argInputs = null) //: callable|array
    {
        return Collections::filter($predicate, $argInputs);
    }

    public static function reduce(callable $fn, $initial, ?array $argInputs = null) //: callable|mixed
    {
        return Collections::reduce($fn, $initial, $argInputs);
    }

    public static function head(array $argInputs) //: array
    {
        return Collections::head($argInputs);
    }

    public static function rest(array $argInputs) //: callable|array
    {
        return Collections::rest($argInputs);
    }

    public static function sortBy(callable $fn, ?array $argInputs = null) //: callable|array
    {
        return Collections::sortBy($fn, $argInputs);
    }
}
