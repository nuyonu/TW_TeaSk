<?php

include(ROOT . DS . 'models' . DS . 'training.model.php');

class TrainingsfilterController extends Controller
{
    public function show()
    {
        $this->model = new TrainingModel($this->database);

        $trainings = $this->model->getTrainingsByFilter($_GET);

        $total = 2;
        $cheap_trainings = $this->model->getCheapTrainings($trainings, $total);
        $favorable_trainings = $this->model->getFavorableTrainings($trainings, $total);
        $close_trainings = $this->model->getCloseTrainings($trainings, $total);
        $recent_trainings = $this->model->getRecentTrainings($trainings, $total);

        require_once(VIEW . 'trainings.php');
    }

    public function dies()
    {
        $this->die('404 Not Found');
    }
}