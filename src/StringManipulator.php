<?php

class StringManipulator
{
    public function concatenate($str1, $str2)
    {
        if(!is_string($str1) || !is_string($str2)) {
            throw new InvalidArgumentException('Invalid argument');
        }
        return $str1 . $str2;
    }

    public function capitalize($str)
    {
        if(!is_string($str)) {
            throw new InvalidArgumentException('Invalid argument');
        }
        return ucfirst(strtolower($str));
    }

    public function reverse($str)
    {
        if(!is_string($str)) {
            throw new InvalidArgumentException('Invalid argument');
        }
        return strrev($str);
    }

    public function length($str)
    {
        if(!is_string($str)) {
            throw new InvalidArgumentException('Invalid argument');
        }
        return strlen($str);
    }

    public function contains($haystack, $needle)
    {
        if(!is_string($haystack) || !is_string($needle)) {
            throw new InvalidArgumentException('Invalid argument');
        }
        if($haystack == '' || $needle == ''){
            throw new InvalidArgumentException('Empty string');
        }
        return strpos($haystack, $needle) !== false;
    }
}
