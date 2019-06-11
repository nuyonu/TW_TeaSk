<?php
include(ROOT . DS . 'models' . DS . 'DAO' . DS . 'Register.DAO.php');
include(ROOT . DS . 'models' . DS . 'user.model.php');

use AsyncTask\Collection;
use duncan3dc\Sessions\SessionInstance;

class HomeController extends Controller
{


    public function show()
    {
        $user = $this->session->get(Constants::USER);
        if ($user != NULL) {
            Parameters::setData("show", Constants::HIDDEN);
        } else {
            Parameters::setData("show", Constants::EMPTY);
        }

        require_once(Constants::VIEW_INDEX);
    }

    public function disconnect()
    {
        $this->session->set(Constants::USER, Constants::EMPTY);
        Response::redirect(Constants::HOME);
    }

    public function login()
    {
        if (ValidatorPost::validateLogin()) {
            $user = new UserDAO($_POST[Constants::DATA][Constants::USER], $_POST[Constants::DATA][Constants::PSW]);
            if ($user->valid()) {
                $database = new UserModel($this->database);
                if ($database->getUser($user)) {
                    $this->session->set(Constants::USER, $_POST[Constants::DATA][Constants::USER]);
                    $this->session->set(Constants::GRADE, $database->getUserGrade($user->getUsername()));
                    $token = $database->getTokenGithub($this->session->get(Constants::USER));
                    if ($token != NULL) {
                        $sett = new Collection();
                        $sett->set("token", $token);
                        $sett->set("db", $this->database);
                        $sett->set("user", $this->session->get(Constants::USER));
                        $task = new GithubUpdate();
                        $task->setTitle('TestTask')
                                ->execute($sett);
                    }
                    echo 'sS';
//                    Response::redirect(Constants::HOME);
                } else {
                    Response::redirect(Constants::HOME);
                }
            } else {
                Response::redirect_with_fail(Constants::HOME,
                    "Date trimise sunt invalide. Apasati ok pentru a fii trimis pe acasa.");
            }
        } else {
            Response::redirect_with_fail(Constants::HOME,
                "Datele trimise sunt fie goale,fie invalide. Apasati ok pentru a fii trimis pe acasa.");
        }
    }


    public function register()
    {
        if (isset($_POST['reg']) && $this->validateReg()) {
            $reg = $_POST['reg'];
            $register = new Register();
            $register->setUsername($reg['username']);
            $register->setPassword($reg['password']);
            $register->setEmail($reg['email']);
            $register->setName($reg['name']);
            $register->setConfirm($reg['confirm']);
            $register->setLastName($reg['lastname']);

            $UserRepository = new UserModel($this->database);
            if ($register->validate() && !$UserRepository->existUsername($register->getUsername())) {
                $UserRepository->saveUser($register);
                Response::redirect(Constants::HOME);
            } else {
                Response::redirect_with_fail(Constants::HOME, "Datele trimise sunt invalide.");
            }
        } else {
            Response::redirect_with_fail(Constants::HOME, "Datele trimise sunt fie goale ,fie invalide.");
        }

    }

    public function redirect()
    {
        Response::redirect(Constants::HOME);
    }

    public function verifyLogin()
    {
        if (isset($_POST['data']['user']) && $_POST['data']['user'] && isset($_POST['data']['password']) && $_POST['data']['password']) {
            $userModel = new UserModel($this->database);
            $data = $_POST['data'];
            $username = $data['user'];
            $password = $data['password'];
            $user = new UserDAO($username, $password);
            if ($userModel->getUser($user)) {
                echo json_encode(array(Constants::SUCCESS_RESULT => Constants::SUCCESS));
            } else {
                echo json_encode(array(Constants::SUCCESS_RESULT => Constants::FAIL));
            }
        } else {
            echo json_encode(array(Constants::SUCCESS_RESULT => Constants::FAIL));
        }
    }

    public function verifyUsername()
    {
        if (isset($_POST[Constants::USER]) && $_POST[Constants::USER]) {

            $user = $_POST["user"];
            $db = new UserModel($this->database);
            if ($db->existUsername($user)) {
                echo json_encode(array(Constants::SUCCESS_RESULT => Constants::SUCCESS));
            } else {
                echo json_encode(array(Constants::SUCCESS_RESULT => Constants::FAIL));
            }
        } else {
            echo json_encode(array(Constants::SUCCESS_RESULT => Constants::FAIL));
        }
    }


    public function dies()
    {
        die('404 Not Found');
    }


    private function validateReg(): bool
    {
        $reg = $_POST['reg'];
        if (!isset($reg['username']) && !isset($reg['password']) && !isset($reg['email']) && !isset($reg['name']) && !isset($reg['confirm']) && !isset($reg['lastname'])) {
            return FALSE;
        }
        return ($reg['username'] && $reg['password'] && $reg['email'] && $reg['name'] && $reg['confirm'] && $reg['lastname']);

    }

    public
    function __construct()
    {
        parent::__construct();
        $this->session = new SessionInstance(Constants::NAME_APP);
    }

    private
        $session;

}