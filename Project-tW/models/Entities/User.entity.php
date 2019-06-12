<?php
declare(strict_types=1);

use Respect\Validation\Validator as v;

class UserEntity
{
    private $id;
    private $username;
    private $e_mail;
    private $password;
    private $first_name;
    private $last_name;
    private $github_token;
    private $linkedln_token;
    private $linkedln_exp;
    private $last_update;


    /**
     * @return mixed
     */
    public function getLastUpdate()
    {
        return $this->last_update;
    }

    /**
     * @param mixed $last_update
     */
    public function setLastUpdate($last_update): void
    {
        $this->last_update = $last_update;
    }


    /**
     * @return mixed
     */
    public function getLinkedlnExp(): int
    {
        return $this->linkedln_exp;
    }

    /**
     * @param mixed $linkedln_exp
     */
    public function setLinkedlnExp(int $linkedln_exp): void
    {
        $this->linkedln_exp = $linkedln_exp;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEMail(): string
    {
        return $this->e_mail;
    }

    /**
     * @param string $e_mail
     */
    public function setEMail(string $e_mail): void
    {
        $this->e_mail = $e_mail;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
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

    /**
     * @return string
     */
    public function getGithubToken()
    {
        return $this->github_token;
    }

    /**
     * @param string $github_token
     */
    public function setGithubToken(string $github_token): void
    {
        $this->github_token = $github_token;
    }

    /**
     * @return string
     */
    public function getLinkedlnToken()
    {
        return $this->linkedln_token;
    }

    /**
     * @param string $linkedin_token
     */
    public function setLinkedinToken(string $linkedin_token): void
    {
        $this->linkedin_token = $linkedin_token;
    }

    public static function default(): UserEntity
    {
        return new UserEntity();
    }

    public function valid()
    {
        $usernameValidator = v::alnum()->noWhitespace()->length(5, 20);
        $emailValidator = v::email()->noWhitespace();
        $nameValidator = v::alpha('- ');
        if (!$usernameValidator->validate($this->username) || !$this->validatePassword($this->password) || !$emailValidator->validate($this->e_mail)) {
            return FALSE;
        }
        return $nameValidator->validate($this->first_name) && $nameValidator->validate($this->last_name) && strlen($this->password) < 100;

    }

    private function validatePassword(string $password)
    {
        $regex = '^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})^';
        preg_match($regex, $password, $matches, PREG_OFFSET_CAPTURE);
        return count($matches) != 0;
    }


}