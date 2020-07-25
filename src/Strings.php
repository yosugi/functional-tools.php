<?php
declare(strict_types=1);

namespace FunctionalTools;

class Strings
{
    public static function split(string $delimiter, ?string $argInput = null) //: callable|string
    {
        $splitFn = fn ($input) =>  explode($delimiter, $input);

        return $argInput === null ? $splitFn : $splitFn($argInput);
    }

    public static function join(string $glue, ?array $argInputs = null) //: callable|string
    {
        $joinFn = fn ($inputs) => implode($glue, $inputs);

        return $argInputs === null ? $joinFn : $joinFn($argInputs);
    }

    public static function replace(string $search, string $replace, ?string $argInput = null) //: callable|string
    {
        $replaceFn = fn ($input) => str_replace($search, $replace, $input);

        return $argInput === null ? $replaceFn : $replaceFn($argInput);
    }

    public static function pregReplace($pattern, $replacement, ?string $argInput = null) //: callable|string
    {
        $pregReplaceFn = fn ($input) =>  preg_replace($pattern, $replacement, $input);

        return $argInput === null ? $pregReplaceFn : $pregReplaceFn($argInput);
    }

    public static function trim(?string $argInput = null) //: callable|string
    {
        $trimFn = fn ($input) => trim($input);

        return $argInput === null ? $trimFn : $trimFn($argInput);
    }

    public static function isEmpty(?string $argInput = null) //: callable|string
    {
        $isEmptyFn = fn ($input) => strlen($input) === 0;

        return $argInput === null ? $isEmptyFn : $isEmptyFn($argInput);
    }

    public static function startsWith(string $search, ?string $argInput = null) //: callable|boolean
    {
        $startsWithFn = function ($input) use ($search) {
            if ($search === '') {
                return false;
            }

            return strpos($input, $search) === 0;
        };

        return $argInput === null ? $startsWithFn : $startsWithFn($argInput);
    }

    public static function endsWith(string $search, ?string $argInput = null) //: callable|boolean
    {
        $endsWithFn = function ($input) use ($search) {
            if ($search === '') {
                return false;
            }

            $position = strrpos($input, $search);
            $expectPosition = strlen($input) - strlen($search);

            return ($position === $expectPosition);
        };

        return $argInput === null ? $endsWithFn : $endsWithFn($argInput);
    }
}
