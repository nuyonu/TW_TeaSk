<?php
define("RESULT_PER_PAGE", 25);

use duncan3dc\Sessions\SessionInstance;

class AdmineventsController extends Controller
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
        if ($this->session->get(Constants::GRADE)['grade'] == 1)
            $this->showAdministrator($model);
        else
            $this->showModerator($model);
    }

    public function deleteEvents()
    {
        $model = new EventsModel($this->database);
        if ($this->session->get("grade")['grade'] == 1)
            if (isset($_GET['check_list_for_delete'])) {
                $eventsForRemove = $_GET['check_list_for_delete'];
                foreach ($eventsForRemove as $key => $id)
                    $model->deleteEventById($id);
            }
        Response::redirect("/adminEvents");
    }

    private function showModerator($model)
    {
        $username = $this->session->get("user");
        $number_of_pages = ceil($model->getCountEventsByUsername($username) / RESULT_PER_PAGE);
        if (!isset($_GET['page']))
            $page = 1;
        else
            $page = $_GET['page'];

        if (isset($_GET['title'])) {
            $title = $_GET['title'];
            $number_of_pages = ceil($model->getCountEventsByUsernameAndTitle($username, $title) / RESULT_PER_PAGE);
        }

        if (!is_numeric($page))
            $page = 1;
        if ($page < 1 || $page > $number_of_pages)
            $page = 1;

        $this_page_first_result = ($page - 1) * RESULT_PER_PAGE;

        if (isset($title)) {
            $title = "%" . $title . "%";
            $events = $model->getAllEventsByUsernameAndTitleOrderByDateASC($username, $title, $this_page_first_result, RESULT_PER_PAGE);
        } else {
            $events = $model->getAllEventsByUsernameOrderByDateASC($username, $this_page_first_result, RESULT_PER_PAGE);
        }
        $grade = 2;
        require_once(VIEW . 'admin-events.php');
    }

    private function showAdministrator($model)
    {
        if (!isset($_GET['page']))
            $page = 1;
        else
            $page = $_GET['page'];

        if (isset($_GET['title']))
            $title = $_GET['title'];
        else
            $title = "";
        $number_of_pages = ceil($model->getCountEventsByTitle($title) / RESULT_PER_PAGE);

        if (!is_numeric($page))
            $page = 1;
        if ($page < 1 || $page > $number_of_pages)
            $page = 1;

        $this_page_first_result = ($page - 1) * RESULT_PER_PAGE;

        $grade = 1;
        $events = $model->getAllEventsByTitle($title, $this_page_first_result, RESULT_PER_PAGE);
        require_once(VIEW . 'admin-events.php');
    }
}