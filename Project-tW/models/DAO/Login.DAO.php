<?php

use Respect\Validation\Validator as v;

class UserDAO
{
    private $username;
    private $password;


    public function valid(){
        $nameValidator = v::alpha()->noWhitespace();
        $passwordValidator = v::alnum()->noWhitespace()->length(5, 20);
        if($nameValidator->validate($this->username)|| $passwordValidator->validate($this->password)){
            return true;
        }
        return false;
    }
    /**
     * UserDAO constructor.
     * @param $username
     * @param $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }


    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

}