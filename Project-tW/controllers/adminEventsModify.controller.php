<?php

use duncan3dc\Sessions\SessionInstance;

class AdmineventsmodifyController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->session = new SessionInstance(Constants::NAME_APP);
    }

    public function show() {
        if(!isset($_GET['eventId']))
            header("Location: /adminEvents");
        else {
            $model = new EventsModel($this->database);
            $event = $model->getEventById($_GET['eventId']);
            if($event == null)
                header("Location: /adminEvents");
            require_once (VIEW . "admin-event-modify.php");
        }
    }

    public function modifyEvent() {
        $eventParams = $_POST['params'];
        $event = new EventsDAO($eventParams['title'], $eventParams['organizer'], $eventParams['type'], $eventParams['location'],
            $eventParams['price'], $eventParams['seats'], $eventParams['difficulty'], $eventParams['begin-date'], $eventParams['end-date'],
            $eventParams['begin-time'], $eventParams['end-time'], $eventParams['description']);

        $model = new EventsModel($this->database);
        $model->saveEvent($event);

        echo "<script>window.location.replace('/adminEvents')</script>";
    }
}