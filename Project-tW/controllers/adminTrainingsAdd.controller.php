<?php

use duncan3dc\Sessions\SessionInstance;

class AdmintrainingsaddController extends Controller
{
    private $session;

    public function __construct()
    {
        parent::__construct();
        $this->session = new SessionInstance(Constants::NAME_APP);
    }

    public function show()
    {
        require_once(VIEW . 'admin-trainings-add.php');
    }

    public function addTraining()
    {
        $trainingParams = $_POST['trainingParams'];

        $username = $this->session->get("user");

        $training = new Training();
        $training->setUsername($username);
        $training->setTitle($trainingParams['title']);
        $training->setOrganizer($trainingParams['organizer']);
        $training->setDomain($trainingParams['domain']);
        $training->setSpecifications($trainingParams['specifications']);
        $training->setLocation($trainingParams['location']);
        $training->setPrice((int)$trainingParams['price']);
        $training->setStars(0);
        $training->setDifficulty((int)$trainingParams['difficulty']);
        $training->setDatetime($trainingParams['begin-date'] . ' ' . $trainingParams['begin-time']);
        $training->setDescription($trainingParams['description']);

        if ($training->validate())
        {
            $model = new TrainingModel($this->database);
            $model->save($training);

            header("Location: /adminTrainings");
        }
        else
        {
            header("Location: /adminTrainings?error=true");
        }
    }
}