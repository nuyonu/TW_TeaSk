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
        header('Location: ' . $uri, TRUE, 303);
        die();
    }

    public static function redirect_with_fail(string $uri, string $message)
    {
        echo "<script type=\"text/javascript\">window.alert('" . $message . "');
                window.location.href = '/home';</script>";
        exit;

    }

    public static function redirectGithub()
    {
        header('Location: http://localhost/github', TRUE, 303);
        die();
    }

    public static function redirectLinkedln()
    {
        header('Location: http://localhost/linkedln', TRUE, 303);
        die();
    }
}