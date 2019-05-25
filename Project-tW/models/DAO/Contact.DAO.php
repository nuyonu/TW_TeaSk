<?php

class ContactDao
{


    private $name;
    private $email;
    private $type;
    private $problem;

    /**
     * ContactDao constructor.
     * @param string $name
     * @param string $email
     * @param string $type
     * @param string $problem
     */
    public function __construct(string $name, string $email, string $type, string $problem)
    {
        $this->name = $name;
        $this->email = $email;
        $this->type = $type;
        $this->problem=$problem;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getProblem(): string
    {
        return $this->problem;
    }

    /**
     * @param string $problem
     */
    public function setProblem(string $problem): void
    {
        $this->problem = $problem;
    }


}