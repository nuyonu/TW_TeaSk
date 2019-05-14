<?php

include(ROOT . DS . 'models' . DS . 'training.model.php');

class TrainingsfilterController extends Controller
{
    public function show()
    {
        $this->model = new TrainingModel($this->database);

        $trainings = $this->model->getTrainingsByFilter($_GET);

        require_once(VIEW . 'trainings.php');
    }

    public function dies()
    {
        $this->die('404 Not Found');
    }
}