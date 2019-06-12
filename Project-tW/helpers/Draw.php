<?php

class Draw
{
    public static function lang($lang = array())
    {
        $lang=array("c++" => 22, "Python" => 21, "Java" => 33);
        foreach ($lang as $key => $proc) {
            echo '{x:"' . $key . '", value:' . $proc . '},';
        }
    }

}