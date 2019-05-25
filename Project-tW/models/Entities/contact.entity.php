<?php
declare(strict_types=1);

class ContactEntity
{
    private $id;
    private $name;
    private $email;
    private $type;
    private $problem;

    /**
     * @return mixed
     */
    public function getId():int
    {
        return $this->id;
    }

    public function setId(int $id):int
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName():string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail():string
    {
        return $this->email;
    }


    /**
     * @param string $email
     * @return string
     */
    public function setEmail(string $email):string
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getType():string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getProblem():string
    {
        return $this->problem;
    }

    /**
     * @param string $problem
     */
    public function setProblem(string $problem)
    {
        $this->problem = $problem;
    }

    /**
     * ContactEntity constructor.
     * @param int $id
     * @param string $name
     * @param string $email
     * @param string $type
     * @param string $problem
     */

    public function __construct(int $id,string $name,string $email,string $type,string $problem)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->type = $type;
        $this->problem = $problem;
    }


}