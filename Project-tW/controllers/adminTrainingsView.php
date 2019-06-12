<?php
class AdmintrainingsviewController extends Controller {
    public function show () {
        if (!isset($_GET['trainingId'])) {
            echo "<script>window.location.replace('/adminTrainings')</script>";
        } else {
            $model = new TrainingModel($this->database);
            $training = $model->getTrainingById($_GET['trainingId']);
            require_once(VIEW . 'admin-trainings-view.php');
        }
    }
}