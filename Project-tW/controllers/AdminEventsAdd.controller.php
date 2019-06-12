<?php

use duncan3dc\Sessions\SessionInstance;

class AdmineventsaddController extends Controller
{
    private $session;

    public function __construct()
    {
        parent::__construct();
        $this->session = new SessionInstance(Constants::NAME_APP);
    }

    public function show()
    {
        require_once(VIEW . 'admin-events-add.php');
    }

    public function addEvent()
    {
        $eventParams = $_POST['eventParams'];
        $username = $this->session->get("user");
        $event = new EventsDAO($eventParams['title'], $eventParams['organizer'], $eventParams['type'], $eventParams['location'],
            $username, $eventParams['price']/*, $eventParams['seats']*/, $eventParams['difficulty'], $eventParams['begin-date'],
            $eventParams['end-date'], $eventParams['begin-time'], $eventParams['end-time'], $eventParams['description'],
            $eventParams['tags']);

        if ($event->validateAllInternAttributes() && $this->isTitleUnique($event->getTitle())) {
            $model = new EventsModel($this->database);
            $model->saveEvent($event);
            header("Location: /adminEvents");
        }
        else {
            header("Location: /adminEventsAdd?error=true");
        }
    }

    public function titleIsUnique()
    {
        $title = $_POST["title"];
        if ($this->isTitleUnique($title)) {
            echo json_encode(array(Constants::SUCCESS_RESULT => Constants::SUCCESS));
        } else {
            echo json_encode(array(Constants::SUCCESS_RESULT => Constants::FAIL));
        }

    }

    private function isTitleUnique($title)
    {
        $model = new EventsModel($this->database);
        if ($model->getEventByTitle($title) == false) {
            return true;
        } else {
            return false;
        }
    }

    private function identificationCodeIsUnique() {

    }
}