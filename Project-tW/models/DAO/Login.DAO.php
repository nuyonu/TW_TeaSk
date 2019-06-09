<?php

use Respect\Validation\Validator as v;

class UserDAO
{
    private $username;
    private $password;


    public function valid(): bool
    {
        $usernameValidator = v::alnum('_')->noWhitespace()->length(5, 20);
        return $usernameValidator->validate($this->username) && $this->validatePassword($this->password);
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

    public function validatePassword(string $password)
    {
        $regex = '^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})^';
        preg_match($regex, $password, $matches, PREG_OFFSET_CAPTURE);
        return count($matches)!=0;
    }

}