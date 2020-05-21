<?php
declare(strict_types=1);

namespace FunctionalTools;

use FunctionalTools\Collections;

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

        return $argInputArray === null ? $getFn : $getFn($argInputArray);
    }

    public static function set(string $key, $value, ?array $argInputArray = null) //: callable|array
    {
        $setFn = function ($inputArray) use ($key, $value) {
            $inputArray[$key] = $value;

            return $inputArray;
        };

        return $argInputArray === null ? $setFn : $setFn($argInputArray);
    }

    public static function flatten(?array $argInputs = null) //: callable|array
    {
        $flattenFn = function ($inputs) {
            $results = [];
            foreach ($inputs as $value) {
                if (!is_array($value)) {
                    $results[] = $value;
                    continue;
                }

                // $values = static::flatten($value);
                $values = self::flatten($value);
                $results = array_merge($results, $values);
            }
            return $results;
        };

        return $argInputs === null ? $flattenFn : $flattenFn($argInputs);
    }

    public static function toPairs(?array $argInputs = null) //: callable|array
    {
        $toPairsFn = function ($inputs) {
            $resultPairs = [];
            foreach ($inputs as $key => $value) {
                $resultPairs[] = [$key, $value];
            }
            return $resultPairs;
        };

        return $argInputs === null ? $toPairsFn : $toPairsFn($argInputs);
    }

    public static function fromPairs(?array $argInputs = null) //: callable|array
    {
        $fromPairsFn = function ($inputs) {
            $resultMap  = [];
            foreach ($inputs as $pairs) {
                list($key, $value) = $pairs;
                $resultMap[$key] = $value;
            }
            return $resultMap;
        };

        return $argInputs === null ? $fromPairsFn : $fromPairsFn($argInputs);
    }

    public static function keys(?array $argInputs = null) //: callable|array
    {
        $keysFn = fn ($inputs) => array_keys($inputs);

        return $argInputs === null ? $keysFn : $keysFn($argInputs);
    }

    public static function values(?array $argInputs = null) //: callable|array
    {
        $valuesFn = fn ($inputs) => array_values($inputs);

        return $argInputs === null ? $valuesFn : $valuesFn($argInputs);
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

    public static function head(array $argInputs) //: callable|array
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
