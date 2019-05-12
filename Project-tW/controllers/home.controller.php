<?php
include(ROOT . DS . 'models' . DS . 'DAO' . DS . 'Register.DAO.php');
include(ROOT . DS . 'models' . DS . 'user.model.php');

class HomeController extends Controller
{

    public function show()
    {
        require_once(VIEW . 'index.php');
    }

    public function login()
    {
        $params = App::getRouter()->getParams();
        $data = $_POST['data'];
        $username = $data['user'];
        $password = $data['password'];
        echo $username;
        echo $password;

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
        echo $register->getLastName();
        $UserRepository = new UserModel();

//        todo validation user reg
        $UserRepository->saveUser($register);
        require_once(VIEW . 'test.php');
        echo "ok";
    }

    public function dies()
    {
        $this->die('404 Not Found');
    }
}