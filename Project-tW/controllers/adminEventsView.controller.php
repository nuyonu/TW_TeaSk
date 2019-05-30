<?php
class AdmineventsviewController extends Controller {
    public function show () {
        if (!isset($_GET['eventId'])) {
            echo "<script>window.location.replace('/adminEvents')</script>";
        } else {
            $model = new EventsModel($this->database);
            $event = $model->getEventById($_GET['eventId']);
            require_once (VIEW . 'admin-event-view.php');
        }
    }
}