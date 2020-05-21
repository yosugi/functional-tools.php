<?php
declare(strict_types=1);

namespace FunctionalTools;

class Strings
{
    public static function split(string $delimiter, ?string $argInput = null) //: callable|string
    {
        $splitFn = function ($input) use ($delimiter) {
            return explode($delimiter, $input);
        };

        return $argInput === null ? $splitFn : $splitFn($argInput);
    }

    public static function join(string $glue, ?array $argInputs = null) //: callable|string
    {
        $joinFn = function ($inputs) use ($glue) {
            return implode($glue, $inputs);
        };

        return $argInputs === null ? $joinFn : $joinFn($argInputs);
    }

    public static function replace($search, $replace, ?string $argInput = null) //: callable|string
    {
        $replaceFn = function ($input) use ($search, $replace) {
            return str_replace($search, $replace, $input);
        };

        return $argInput === null ? $replaceFn : $replaceFn($argInput);
    }

    public static function pregReplace($pattern, $replacement, ?string $argInput = null) //: callable|string
    {
        $pregReplaceFn = function ($input) use ($pattern, $replacement) {
            return preg_replace($pattern, $replacement, $input);
        };

        return $argInput === null ? $pregReplaceFn : $pregReplaceFn($argInput);
    }

    public static function trim(?string $argInput = null) //: callable|string
    {
        $trimFn = function ($input) {
             return trim($input);
        };

        return $argInput === null ? $trimFn : $trimFn($argInput);
    }
}
