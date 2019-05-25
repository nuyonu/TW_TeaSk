<?php

use duncan3dc\Sessions\SessionInstance;

class SettingsController extends Controller
{
    private $session;

    public function __construct()
    {
        parent::__construct();
        $this->session = new SessionInstance("my-app");
    }

    public function show()
    {
        $user = $this->session->get("user");
        if ($user != NULL) {
            Parameters::setData("show", "hidden");
            $db = new UserModel($this->database);
            $result = $db->getUserDb($user);
            Parameters::setData("userData", $result);
        } else {
            Parameters::setData("show", "show");
        }
        require_once(VIEW . 'setting.php');
    }

    public function personal()
    {
        $personal_data = $_POST['personal'];
        $personal = new Personal($personal_data['name'], $personal_data['first'], $personal_data['emailSetting'],
            $personal_data['username']);
        if ($personal->valid()) {
            $db = new UserModel($this->database);
            $db->updatePerson($personal);
        }
        Response::redirect("/settings");
    }

    public function contact()
    {
        $personal_data = $_POST['contact'];
        $personal = new ContactSettings($personal_data['old'], $personal_data['newC'], $personal_data['new'],
            $this->session->get("user"));
        if ($personal->valid()) {
            $db = new UserModel($this->database);
            $db->updateContact($personal);
        }
        Response::redirect("/settings");
    }

    public function github()
    {
        require_once VIEW . 'github.php';
    }

    public function login1()
    {
        $personal_data = $_POST['data'];
        $github = new Github();
        $token = $github->auth($personal_data['user'], $personal_data['password']);
        if (strcmp($token, "BAD_REQUEST") == 0) {
            echo "first";
            Response::redirect("/settings/github");
        } else {
            echo "second";
            $user = $this->session->get("user");
            $userDB = new UserModel($this->database);
            $userDB->addToken($user, $token);
        }
        $github_database = new GithubModel($this->database);

        $github_database->save($github->getInfoRepos(),$this->session->get("user"));
//        Response::redirect('/settings');
    }


}