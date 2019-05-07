<?php

class SettingsController extends Controller
{
    public function show()
    {
        require_once(ROOT . DS . 'views' . DS . 'setting.php');
    }

}