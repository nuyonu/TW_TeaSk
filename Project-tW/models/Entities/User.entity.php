<?php
declare(strict_types=1);

class UserEntity
{
    private $id;
    private $username;
    private $e_mail;
    private $password;
    private $first_name;
    private $last_name;
    private $github_token;
    private $linkedin_token;


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
    public function getGithubToken(): string
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
    public function getLinkedinToken(): string
    {
        return $this->linkedin_token;
    }

    /**
     * @param string $linkedin_token
     */
    public function setLinkedinToken(string $linkedin_token): void
    {
        $this->linkedin_token = $linkedin_token;
    }

    public static function default():UserEntity{
        return new UserEntity();
    }


}