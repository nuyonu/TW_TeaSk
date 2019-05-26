<?php

class Response
{
    public static function returnView(string $view, string $uri)
    {
        echo "<script>window.location.replace('" . $uri . "')</script>";
        include VIEW . $view;
    }


    public static function redirect(string $uri)
    {
        header('Location: '.$uri, TRUE, 303);
        die();
    }
}