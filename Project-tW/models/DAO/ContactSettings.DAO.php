<?php

use Respect\Validation\Validator as v;

class ContactSettings
{
    private $oldPassword;
    private $confirmPassword;
    private $newPassword;
    private $username;

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
     * ContactSettings constructor.
     * @param $oldPassword
     * @param $confirmPassword
     * @param $newPassword
     * @param $username
     */
    public function __construct($oldPassword, $confirmPassword, $newPassword, $username)
    {
        $this->oldPassword = $oldPassword;
        $this->confirmPassword = $confirmPassword;
        $this->newPassword = $newPassword;
        $this->username = $username;
    }


    /**
     * @return mixed
     */
    public function getOldPassword(): string
    {
        return $this->oldPassword;
    }

    /**
     * @param mixed $oldPassword
     */
    public function setOldPassword(string $oldPassword): void
    {
        $this->oldPassword = $oldPassword;
    }

    /**
     * @return mixed
     */
    public function getConfirmPassword(): string
    {
        return $this->confirmPassword;
    }

    /**
     * @param mixed $confirmPassword
     */
    public function setConfirmPassword(string $confirmPassword): void
    {
        $this->confirmPassword = $confirmPassword;
    }

    /**
     * @return mixed
     */
    public function getNewPassword(): string
    {
        return $this->newPassword;
    }

    /**
     * @param mixed $newPassword
     */
    public function setNewPassword(string $newPassword): void
    {
        $this->newPassword = $newPassword;
    }

    public function valid(): bool
    {
        $passwordValidator = v::alnum()->noWhitespace()->length(5, 20);
        if ($passwordValidator->validate($this->confirmPassword) && $passwordValidator->validate($this->newPassword) && $passwordValidator->validate($this->oldPassword) && strcmp($this->confirmPassword,
                $this->newPassword) == 0) {
            return TRUE;
        }
        return FALSE;

    }


}