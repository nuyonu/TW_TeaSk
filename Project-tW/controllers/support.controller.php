<?php

use duncan3dc\Sessions\SessionInstance;

class SupportController extends Controller
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
            Parameters::setData("show", "");
        }
        require_once(VIEW . 'support.php');
    }

}