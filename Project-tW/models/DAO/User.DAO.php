<?php
class UserAdmin {
    private $id;
    private $username;
    private $e_mail;
    private $last_name;
    private $first_name;
    private $github_token;
    private $linkedln_token;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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
    public function getEMail()
    {
        return $this->e_mail;
    }

    /**
     * @param mixed $e_mail
     */
    public function setEMail($e_mail): void
    {
        $this->e_mail = $e_mail;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name): void
    {
        $this->first_name = $first_name;
    }

    /**
     * @return mixed
     */
    public function getGithubToken()
    {
        return $this->github_token!=NULL?"DA":"NU";
    }

    /**
     * @param mixed $github_token
     */
    public function setGithubToken($github_token): void
    {
        $this->github_token = $github_token;
    }

    /**
     * @return mixed
     */
    public function getLinkedlnToken()
    {
        return $this->linkedln_token!=NULL?"DA":"NU";
    }

    /**
     * @param mixed $linkedln_token
     */
    public function setLinkedlnToken($linkedln_token): void
    {
        $this->linkedln_token = $linkedln_token;
    }

}