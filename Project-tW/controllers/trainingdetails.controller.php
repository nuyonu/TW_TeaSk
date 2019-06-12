<?php

use duncan3dc\Sessions\SessionInstance;

include(ROOT . DS . 'models' . DS . 'training.model.php');

class TrainingdetailsController extends Controller
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

        if (!isset($_GET['id']))
        {
            require_once(VIEW . 'trainings.php');
            return;
        }

        $training = $this->model->getTrainingById($_GET['id']);

        require_once(VIEW . 'training-details.php');
    }
}