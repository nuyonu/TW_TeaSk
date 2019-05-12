<?php

class ContactDao{


    private $name;
    private $email;
    private $problem;
    private $desc;

    /**
     * ContactDao constructor.
     * @param $name
     * @param $email
     * @param $problem
     * @param $desc
     */
    public function __construct($name, $email, $problem, $desc)
    {
        $this->name = $name;
        $this->email = $email;
        $this->problem = $problem;
        $this->desc = $desc;
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
    public function setName($name)
    {
        $this->name = $name;
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
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getProblem()
    {
        return $this->problem;
    }

    /**
     * @param mixed $problem
     */
    public function setProblem($problem)
    {
        $this->problem = $problem;
    }

    /**
     * @return mixed
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @param mixed $desc
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
    }

}