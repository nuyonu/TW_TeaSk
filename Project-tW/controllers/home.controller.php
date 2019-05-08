<?php

class HomeController extends Controller
{
    public function show()
    {
        require_once(ROOT . DS . 'views' . DS . 'index.php');
    }
}