<?php
class AdmineventsmodifyController extends Controller {
    public function show() {
        if(!isset($_GET['eventId']))
            echo "<script>window.location.replace('/adminEvents')</script>";
        else {
            $model = new EventsModel($this->database);
            $event = $model->getEventById($_GET['eventId']);
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