<?php

class  Parameters
{
    private static $data = array();

    public static function setData(string $key, $value)
    {
        self::$data[$key] = $value;
    }

    public static function getData(string $key)
    {
        return self::$data[$key];
    }
}