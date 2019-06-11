<?php

class Log
{
    public static function logg($data): void
    {
        echo '<script>';
        echo 'console.log(' . json_encode($data) . ')';
        echo '</script>';
    }

    public static function debug_ajax($value)
    {
        ob_start();
        var_dump($value);
        return ob_get_clean();

    }
}