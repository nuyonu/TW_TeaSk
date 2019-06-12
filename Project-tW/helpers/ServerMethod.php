<?php

class Method
{
    public static function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public static function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    public static function isDelete()
    {
        return $_SERVER['REQUEST_METHOD'] == 'DELETE';
    }
}