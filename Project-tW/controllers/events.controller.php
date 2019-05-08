<?php

class EventsController extends Controller
{
    public function show()
    {
        require_once(ROOT . DS . 'views' . DS . 'events.php');
    }

}