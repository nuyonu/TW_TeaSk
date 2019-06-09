<?php

use duncan3dc\Sessions\SessionInstance;

class AdmineventsController extends Controller
{
    public function show()
    {
        $model = new EventsModel($this->database);
        $events = $model->getAllEvents();
        echo $this->session->get(Constants::USER);
        foreach ($events as $event)
        require_once(VIEW . 'admin-events.php');
    }

    public function addEvent()
    {
        $eventParams = $_POST['eventParams'];
        $event = new EventsDAO($eventParams['title'], $eventParams['organizer'], $eventParams['type'], $eventParams['location'],
            $eventParams['price'], $eventParams['seats'], $eventParams['difficulty'], $eventParams['begin-date'], $eventParams['end-date'],
            $eventParams['begin-time'], $eventParams['end-time'], $eventParams['description'], $eventParams['tags']);

        $model = new EventsModel($this->database);
        $model->saveEvent($event);

        echo "<script>window.location.replace('/adminEvents')</script>";
    }

    public function deleteEvents()
    {
        if (isset($_GET['check_list_for_delete'])) {
            $eventsForRemove = $_GET['check_list_for_delete'];
            $model = new EventsModel($this->database);
            foreach ($eventsForRemove as $key => $id)
                $model->deleteEventById($id);
        }

        echo "<script>window.location.replace('/adminEvents')</script>";
    }
    public function __construct()
    {
        parent::__construct();
        $this->session = new SessionInstance(Constants::NAME_APP);
    }

    private
        $session;

}
