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

        if ($argInputs === null) {
            return $flattenFn;
        }

        return $flattenFn($argInputs);
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

        if ($argInputs === null) {
            return $toPairsFn;
        }

        return $toPairsFn($argInputs);
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

        if ($argInputs === null) {
            return $fromPairsFn;
        }

        return $fromPairsFn($argInputs);
    }

    public static function keys(?array $argInputs = null) //: callable|array
    {
        $keysFn = function ($inputs) {
            return array_keys($inputs);
        };

        if ($argInputs === null) {
            return $keysFn;
        }

        return $keysFn($argInputs);
    }

    public static function values(?array $argInputs = null) //: callable|array
    {
        $valuesFn = function ($inputs) {
            return array_values($inputs);
        };

        if ($argInputs === null) {
            return $valuesFn;
        }

        return $valuesFn($argInputs);
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
