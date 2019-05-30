<?php
include(ROOT . DS . 'models' . DS . 'DAO' . DS . 'Register.DAO.php');
include(ROOT . DS . 'models' . DS . 'user.model.php');

use duncan3dc\Sessions\SessionInstance;

class HomeController extends Controller
{

    private $session;

    /**
     * HomeController constructor.
     */
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
        } else {
            Parameters::setData("show", "");
        }

        require_once(VIEW . 'index.php');
    }

    public function disconect()
    {
        $this->session->set("user", "");
        Response::redirect(self::HOME);
    }

    public function login()
    {
        $data = $_POST['data'];
        $username = $data['user'];
        $password = $data['password'];
        $user = new UserDAO($username, $password);
        if ($user->valid()) {
            $database = new UserModel($this->database);
            if ($database->getUser($user)) {
                $this->session->set('user', $username);
                Response::redirect(self::HOME);
            } else {
                Response::redirect(self::HOME);
            }
        } else {
            Response::redirect(self::HOME);
        }
    }

    public function register()
    {
        $reg = $_POST['reg'];
        $register = new Register();
        $register->setUsername($reg['username']);
        $register->setPassword($reg['password']);
        $register->setEmail($reg['email']);
        $register->setName($reg['name']);
        $register->setConfirm($reg['confirm']);
        $register->setLastName($reg['lastname']);

        if ($register->validate()) {
            $UserRepository = new UserModel($this->database);
            $UserRepository->saveUser($register);
            Response::redirect(self::HOME);
        } else {
            Response::redirect(self::HOME);
        }
    }

    public
    function redirect()
    {
        Response::redirect(self::HOME);
    }


    public
    function dies()
    {
        die('404 Not Found');
    }

    private const HOME = "/home";
}