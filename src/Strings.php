<?php
declare(strict_types=1);

namespace FunctionalTools;

class Strings
{
    public static function split(string $delimiter, ?string $string = null) //: callable|string
    {
        $splitFn = function ($string) use ($delimiter) {
            return explode($delimiter, $string);
        };

        if ($string === null) {
            return $splitFn;
        }

        return $splitFn($string);
    }

    public static function join(string $glue, ?array $pieces = null) //: callable|string
    {
        $joinFn = function ($pieces) use ($glue) {
            return implode($glue, $pieces);
        };

        if ($pieces === null) {
            return $joinFn;
        }

        return $joinFn($pieces);
    }

    public static function replace($search, $replace, ?string $subject = null) //: callable|string
    {
        $replaceFn = function ($subject) use ($search, $replace) {
            return str_replace($search, $replace, $subject);
        };

        if ($subject === null) {
            return $replaceFn;
        }

        return $replaceFn($subject);
    }

    public static function pregReplace($pattern, $replacement, ?string $subject = null) //: callable|string
    {
        $replaceFn = function ($subject) use ($pattern, $replacement) {
            return preg_replace($pattern, $replacement, $subject);
        };

        if ($subject === null) {
            return $replaceFn;
        }

        return $replaceFn($subject);
    }

    public static function trim(?string $string = null) //: callable|string
    {
        $trimFn = function ($string) {
             return trim($string);
        };

        if ($string === null) {
            return $trimFn;
        }

        return $trimFn($string);
    }
}
