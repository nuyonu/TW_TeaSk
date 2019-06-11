<?php

class FileManager
{

    public static function verifyFileExist(string $username)
    {
        if (file_exists(UPLOADS . $username . '.jpg')) {
            return TRUE;
        }
        if (file_exists(UPLOADS . $username . '.png')) {
            return TRUE;
        }
        return file_exists(UPLOADS . $username . '.gif');

    }

    public static function getImageUser(string $username): string
    {

        $file = 'default.jpg';
        if (file_exists(UPLOADS . $username . '.jpg')) {
            $file = $username . '.jpg';
        } elseif (file_exists(UPLOADS . $username . '.png')) {
            $file = $username . '.png';
        } elseif (file_exists(UPLOADS . $username . '.gif')) {
            $file = $username . '.gif';
        }
        return $file;
    }

}