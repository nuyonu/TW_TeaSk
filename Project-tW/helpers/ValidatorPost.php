<?php

class ValidatorPost
{
    public static function validatePersonal()
    {
        if (isset($_POST['personal'])) {
            $personal_data = $_POST['personal'];
            return isset($personal_data['name']) && isset($personal_data['first']) && isset($personal_data['emailSetting']);
        }
        return FALSE;
    }

    public static function validateContact()
    {
        if (isset($_POST['contact'])) {
            $data = $_POST['contact'];
            return isset($data['name']) && isset($data['email']) && isset($data['type']) && isset($data['problem']);
        }
        return FALSE;
    }

    public static function validateLogin()
    {
        return isset($_POST[Constants::DATA]) && isset($_POST[Constants::DATA][Constants::USER]) && isset($_POST[Constants::DATA][Constants::PSW]);
    }

}