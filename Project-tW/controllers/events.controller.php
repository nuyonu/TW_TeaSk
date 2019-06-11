<?php

use duncan3dc\Sessions\SessionInstance;

class EventsController extends Controller
{
    private $session;

    public function __construct()
    {
        parent::__construct();
        $this->session = new SessionInstance(Constants::NAME_APP);
    }

    public function show()
    {
        $model = new EventsModel($this->database);
        $events = $model->getAllEvents();
        require_once(VIEW . 'events.php');
    }

}