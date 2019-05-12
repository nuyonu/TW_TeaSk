<?php
include(ROOT . DS . 'models' . DS . 'DAO' . DS . 'Register.DAO.php');
include(ROOT . DS . 'models' . DS . 'user.model.php');

class HomeController extends Controller
{

    public function show()
    {
        $navbar = '';
        require_once(VIEW . 'index.php');

    }

    public function login()
    {
        $params = App::getRouter()->getParams();
        $data = $_POST['data'];
        $username = $data['user'];
        $password = $data['password'];
        $user = new UserDAO($username, $password);
        if ($user->valid()) {
            $database = new UserModel();
            if ($database->getUser($user)) {
                $navbar = 'hidden';
                header("Location: http://localhost/events", true, 301);
                die();
            } else {
                header("Location: http://localhost/home", true, OK);
                die();
            }
        }
        header("Location: http://localhost/home", true, OK);
        die();
    }

    public function register()
    {
        $params = App::getRouter()->getParams();

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
            header("Location: http://localhost/home", true, 301);
            die();
        } else {
            header("Location: http://localhost/home", true, 301);
            die();
        }

    }

    public function dies()
    {
        $this->die('404 Not Found');
    }
}