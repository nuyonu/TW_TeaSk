<?php

use duncan3dc\Sessions\SessionInstance;

class ContactController extends Controller
{
    private $session;

    public function __construct()
    {
        parent::__construct();
        $this->session = new SessionInstance("my-app");
    }

    public function show()
    {
        Parameters::setData("show", "hidden");
        require_once(VIEW . 'contact.php');
    }

    public function send()
    {
        if (ValidatorPost::validateContact()) {

            $data = $_POST['contact'];
            $contact = new ContactDao($data['name'], $data['email'], $data['type'], $data['problem']);
            $databaseConn = new ContactModel($this->database);
            $databaseConn->save($contact);
            Response::redirect(Constants::CONTACT);
        }

    }
}