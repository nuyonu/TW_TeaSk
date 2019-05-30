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
        $user = $this->session->get("user");
        if ($user != NULL) {
            Parameters::setData("show", "hidden");
        } else {
            Parameters::setData("show", "show");
        }
        require_once(VIEW . 'contact.php');
    }

    public function send()
    {
        $data = $_POST['contact'];
        $contact = new ContactDao($data['name'], $data['email'], $data['type'], $data['problem']);
        $databaseConn = new ContactModel($this->database);
        $databaseConn->save($contact);
        header("Location: http://localhost/contact", TRUE, 301);
        die();
    }
}