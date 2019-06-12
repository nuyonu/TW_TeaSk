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
        $model = new TrainingModel($this->database);

        $username = $this->session->get("user");

        $number_of_pages = ceil($model->getCountTrainingsByUsername($username) / RESULT_PER_PAGE);

        $page = (!isset($_GET['page']) || !is_numeric($_GET['page'])) ? 1 : $_GET['page'];
        $page = min(max($page, 1), $number_of_pages);

        $this_page_first_result = ($page - 1) * RESULT_PER_PAGE;

        $trainings = $model->getTrainingsByUsernameOrderByDateASC($username,
            RESULT_PER_PAGE,
            $this_page_first_result
        );

        require_once(VIEW . 'admin-trainings.php');
    }

    public function deleteTrainings()
    {
        if (isset($_GET['check_list_for_delete']))
        {
            $model = new TrainingModel($this->database);

            foreach ($_GET['check_list_for_delete'] as $key => $id)
                $model->deleteTrainingById($id);
        }

        echo "<script>window.location.replace('/adminTrainings')</script>";
    }
}
