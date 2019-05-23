<?php

class EventsController extends Controller
{
    public function show()
    {
        $model = new EventsModel($this->database);
        $events = $model->getAllEvents();
        require_once(VIEW . 'events.php');
    }

}