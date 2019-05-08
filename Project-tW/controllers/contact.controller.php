<?php

class ContactController extends Controller
{
    public function show()
    {
        require_once(ROOT . DS . 'views' . DS . 'contact.php');
    }
}