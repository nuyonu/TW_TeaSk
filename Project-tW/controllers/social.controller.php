<?php

use duncan3dc\Sessions\SessionInstance;

class SocialController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->session = new SessionInstance(Constants::NAME_APP);

    }

    public function github()
    {
        Response::redirectGithub();
    }

    public function linkedln()
    {
        Response::redirectLinkedln();
    }

    public function dissconect1()
    {
        $db = new UserModel($this->database);
        $db->deleteGithub($this->session->get(Constants::USER));
        Response::redirect(Constants::SETTINGS);
    }

    public function dissconect2()
    {
        $db = new UserModel($this->database);
        $db->deleteLinkedln($this->session->get(Constants::USER));
        Response::redirect(Constants::SETTINGS);
    }


}