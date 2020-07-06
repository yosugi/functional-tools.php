<?php
declare(strict_types=1);

namespace FunctionalTools;

use FunctionalTools\Collections;

class Arrays
{
    /**
     * @param array<string>|string $key
     * @param array $argInputArray
     */
    public static function get($key, ?array $argInputArray = null) //: callable|mixed
    {
        $keys = $key;
        if (is_string($key)) {
            $keys = explode('.', $key);
        }

        $getFn = function ($inputArray) use ($keys) {
            return self::getRec($keys, $inputArray);
        };

        return $argInputArray === null ? $getFn : $getFn($argInputArray);
    }

    /**
     * @param array<string>|string $key
     * @param mixed $value
     * @param array<mixed> $argInputArray
     */
    public static function set($key, $value, ?array $argInputArray = null) //: callable|array
    {
        $keys = $key;
        if (is_string($key)) {
            $keys = explode('.', $key);
        }
        $setFn = function ($inputArray) use ($keys, $value) {
            return self::setRec($keys, $value, $inputArray);
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

    public static function sortBy(callable $fn, ?array $argInputs = null) //: callable|array
    {
        $sortFn = function ($inputs) use ($fn) {
            uasort($inputs, $fn);
            return $inputs;
        };

        return $argInputs === null ? $sortFn : $sortFn($argInputs);
    }

    public static function merge(array $firstArgInputs, ?array $secondArgInputs = null) //: callable|array
    {
        return Collections::merge($firstArgInputs, $secondArgInputs);
    }

    // aliases

    public static function filter(callable $predicate, ?array $argInputs = null) //: callable|array
    {
        return Collections::filter($predicate, $argInputs);
    }

    public static function map(callable $fn, ?array $argInputs = null) //: callable|array
    {
        return Collections::map($fn, $argInputs);
    }

    public static function reduce(callable $fn, $initial, ?array $argInputs = null) //: callable|mixed
    {
        return Collections::reduce($fn, $initial, $argInputs);
    }

    public static function head(?array $argInputs = null) //: callable|array
    {
        return Collections::head($argInputs);
    }

    public static function rest(?array $argInputs = null) //: callable|array
    {
        return Collections::rest($argInputs);
    }

    // private methods

    /**
     * @param array<string> $keys
     * @param array $inputArray
     */
    public static function getRec(array $keys, array $inputArray)
    {
        if (empty($keys)) {
            return null;
        }

        $key = self::head($keys);
        if (!array_key_exists($key, $inputArray)) {
            return null;
        }

        $value = $inputArray[$key];
        if (!is_array($value)) {
            return $value;
        }

        $restKeys = self::rest($keys);
        return self::getRec($restKeys, $value);
    }

    /**
     * @param array<string> $keys
     * @param mixed $value
     * @param array<mixed> $inputArray
     * @return array|mixed
     */
    public static function setRec(array $keys, $value, array $inputArray) // array|mixed
    {
        if (empty($keys)) {
            return $value;
        }

        $key = self::head($keys);
        $subArray = array_key_exists($key, $inputArray) ? $inputArray[$key] : [];
        if (!is_array($subArray)) {
            $subArray = [];
        }

        $restKeys = self::rest($keys);
        $subArray = self::setRec($restKeys, $value, $subArray);

        $outputArray = $inputArray;
        $outputArray[$key] = $subArray;

        return $outputArray;
    }
}
