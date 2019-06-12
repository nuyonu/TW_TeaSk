<?php

define("RESULT_PER_PAGE", 25);

use duncan3dc\Sessions\SessionInstance;

class AdmintrainingsController extends Controller
{
    private $session;

    public function __construct()
    {
        parent::__construct();
        $this->session = new SessionInstance(Constants::NAME_APP);
    }

    public function show()
    {
        $this->model = new TrainingModel($this->database);

        if ($this->session->get(Constants::GRADE)['grade'] == 1)
            $this->showAdministrator();
        else
            $this->showModerator();
    }

    public function deleteTrainings()
    {
        if (isset($_GET['check_list_for_delete']))
        {
            $model = new TrainingModel($this->database);

            foreach ($_GET['check_list_for_delete'] as $key => $id)
                $model->deleteTrainingById($id);
        }

        Response::redirect("/adminEvents");
    }

    private function showModerator() {
        $username = $this->session->get("user");
        $number_of_pages = ceil($this->model->getCountTrainingsByUsername($username) / RESULT_PER_PAGE);
        if (!isset($_GET['page']))
            $page = 1;
        else
            $page = $_GET['page'];

        if (isset($_GET['title'])) {
            $title = $_GET['title'];
            $number_of_pages = ceil($this->model->getCountTrainingsByUsernameAndTitle($username, $title) / RESULT_PER_PAGE);
        }

        if (!is_numeric($page))
            $page = 1;
        if ($page < 1 || $page > $number_of_pages)
            $page = 1;

        $this_page_first_result = ($page - 1) * RESULT_PER_PAGE;

        if (isset($title)) {
            $title = "%" . $title . "%";
            $trainings = $this->model->getAllTrainingsByUsernameAndTitleOrderByDateASC($username, $title, $this_page_first_result, RESULT_PER_PAGE);
        } else {
            $trainings = $this->model->getTrainingsByUsernameOrderByDateASC($username, $this_page_first_result, RESULT_PER_PAGE);
        }
        $grade = 2;
        require_once(VIEW . 'admin-trainings.php');
    }

    private function showAdministrator() {
        if (!isset($_GET['page']))
            $page = 1;
        else
            $page = $_GET['page'];

        if (isset($_GET['title']))
            $title = $_GET['title'];
        else
            $title = "";
        $number_of_pages = ceil($this->model->getCountTrainingsByTitle($title) / RESULT_PER_PAGE);

        if (!is_numeric($page))
            $page = 1;
        if ($page < 1 || $page > $number_of_pages)
            $page = 1;

        $this_page_first_result = ($page - 1) * RESULT_PER_PAGE;

        $grade = 1;
        $trainings = $this->model->getAllTrainingsByTitle($title, $this_page_first_result, RESULT_PER_PAGE);
        require_once(VIEW . 'admin-trainings.php');
    }
}
