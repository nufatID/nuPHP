<?php

class StringHelper
{

    /**
     * Converts a string to lowercase.
     *
     * @param string $string
     * @return string
     */
    public static function toLowerCase($string)
    {
        return strtolower($string);
    }

    /**
     * Converts a string to uppercase.
     *
     * @param string $string
     * @return string
     */
    public static function toUpperCase($string)
    {
        return strtoupper($string);
    }

    /**
     * Capitalizes the first character of a string.
     *
     * @param string $string
     * @return string
     */
    public static function capitalizeFirst($string)
    {
        return ucfirst($string);
    }

    /**
     * Reverses a string.
     *
     * @param string $string
     * @return string
     */
    public static function reverseString($string)
    {
        return strrev($string);
    }

    /**
     * Checks if a string contains a specific substring.
     *
     * @param string $haystack
     * @param string $needle
     * @return bool
     */
    public static function contains($haystack, $needle)
    {
        return strpos($haystack, $needle) !== false;
    }

    /**
     * Replaces all occurrences of the search string with the replacement string.
     *
     * @param string $search
     * @param string $replace
     * @param string $subject
     * @return string
     */
    public static function replace($search, $replace, $subject)
    {
        return str_replace($search, $replace, $subject);
    }

    /**
     * Trims whitespace from the beginning and end of a string.
     *
     * @param string $string
     * @return string
     */
    public static function trim($string)
    {
        return trim($string);
    }

    /**
     * Splits a string by a delimiter.
     *
     * @param string $delimiter
     * @param string $string
     * @return array
     */
    public static function split($delimiter, $string)
    {
        return explode($delimiter, $string);
    }

    /**
     * Joins an array of strings with a delimiter.
     *
     * @param string $glue
     * @param array $pieces
     * @return string
     */
    public static function join($glue, $pieces)
    {
        return implode($glue, $pieces);
    }

    /**
     * Checks if a string starts with a given substring.
     *
     * @param string $string
     * @param string $startString
     * @return bool
     */
    public static function startsWith($string, $startString)
    {
        return strpos($string, $startString) === 0;
    }

    /**
     * Checks if a string ends with a given substring.
     *
     * @param string $string
     * @param string $endString
     * @return bool
     */
    public static function endsWith($string, $endString)
    {
        $length = strlen($endString);
        if ($length == 0) {
            return true;
        }
        return (substr($string, -$length) === $endString);
    }

    /**
     * Generates a random string of specified length.
     *
     * @param int $length
     * @return string
     */
    public static function randomString($length = 10)
    {
        return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', $length)), 0, $length);
    }
}
