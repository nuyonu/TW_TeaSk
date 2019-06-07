<?php

use Respect\Validation\Validator as v;

class Register
{
    public function validate(): bool
    {
        $usernameValidator = v::alnum()->noWhitespace()->length(5, 20);
        $passwordValidator = v::alnum()->noWhitespace()->length(5, 20);
        $emailValidator = v::email()->noWhitespace();
        $nameValidator = v::alpha('- ');
        if (!$usernameValidator->validate($this->username) || !$passwordValidator->validate($this->password) || !$emailValidator->validate($this->email)) {
            return FALSE;
        }

        return $nameValidator->validate($this->name) && $nameValidator->validate($this->last_name);
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
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
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
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getConfirm()
    {
        return $this->confirm;
    }

    /**
     * @param mixed $confirm
     */
    public function setConfirm($confirm): void
    {
        $this->confirm = $confirm;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }


    private $username = ' ';
    private $email = '';
    private $password = ' ';
    private $name = ' ';
    private $last_name = ' ';
    private $confirm = ' ';


}