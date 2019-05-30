<?php

class Log
{
    public static function logg($data): void
    {
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }
}