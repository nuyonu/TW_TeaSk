<?php

use Respect\Validation\Validator as v;

class Personal
{
    private $name;
    private $fname;
    private $email;
    private $username;

    /**
     * Personal constructor.
     * @param $name
     * @param $fname
     * @param $email
     * @param $username
     */
    public function __construct($name, $fname, $email, $username)
    {
        $this->name = $name;
        $this->fname = $fname;
        $this->email = $email;
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    public function valid(){
        $usernameV=v::alnum()->noWhitespace()->length(5,20);
        $nameV = v::alpha()->noWhitespace();
        $emailV=v::email();
        if(!$nameV->validate($this->name)||$nameV->validate($this->fname) ||!$usernameV->validate($this->username)|| !$emailV->validate($this->email)){
            return false;
        }
        return true;
    }


}