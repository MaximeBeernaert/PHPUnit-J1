<?php

class StringManipulator
{
    public function concatenate($str1, $str2)
    {
        return $str1 . $str2;
    }

    public function capitalize($str)
    {
        return ucfirst(strtolower($str));
    }

    public function reverse($str)
    {
        return strrev($str);
    }

    public function length($str)
    {
        return strlen($str);
    }

    public function contains($haystack, $needle)
    {
        if($haystack == '' || $needle == ''){
            throw new InvalidArgumentException('Empty string');
        }
        return strpos($haystack, $needle) !== false;
    }
}
