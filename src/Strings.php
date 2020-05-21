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

    public static function replace($search, $replace, ?string $argInput = null) //: callable|string
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
}
