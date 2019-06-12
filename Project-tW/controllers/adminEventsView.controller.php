<?php

use duncan3dc\Sessions\SessionInstance;

class AdmineventsviewController extends Controller
{

    private $session;

    public function __construct()
    {
        parent::__construct();
        $this->session = new SessionInstance(Constants::NAME_APP);
    }

    public function show()
    {
        if (!isset($_GET['eventId'])) {
            echo "<script>window.location.replace('/adminEvents')</script>";
        } else {
            $model = new EventsModel($this->database);
            $event = $model->getEventById($_GET['eventId']);
            //Lipseste eventId -> redirectionam inapoi
            if ($event == null)
                Response::redirect("adminEvents");
            if ($this->session->get("grade")['grade'] == 2)
                if ($model->getUsernameFromEvent($_GET['eventId']) != $this->session->get("user"))
                    Response::redirect("adminEvents");
            require_once(VIEW . 'admin-event-view.php');
        }
    }
}