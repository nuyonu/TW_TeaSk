<?php
include(ROOT . DS . 'models' . DS . 'DAO' . DS . 'Register.DAO.php');
include(ROOT . DS . 'models' . DS . 'user.model.php');
use duncan3dc\Sessions\SessionInstance;

class HomeController extends Controller
{

    public function show()
    {
        $navbar = '';
        require_once(VIEW . 'index.php');

    }

    public function login()
    {
        $data = $_POST['data'];
        $username = $data['user'];
        $password = $data['password'];
        $user = new UserDAO($username, $password);
        if ($user->valid()) {
            $database = new UserModel();
            if ($database->getUser($user)) {
                $navbar = 'hidden';
                $session = new SessionInstance("my-app");
                $session->set('user',$username);
                header($this->home, true, 301);
                die();
            } else {
                header($this->home, true, OK);
                die();
            }
        }
        header($this->home, true, OK);
        die();
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
            $UserRepository = new UserModel();
            $UserRepository->saveUser($register);
            $navbar = '';
            header($this->home, true, 301);
            die();
        } else {
            header($this->home, true, 301);
            die();
        }

    }

    public function dies()
    {
        $this->die('404 Not Found');
    }

    private   $home="Location: http://localhost/home";
}