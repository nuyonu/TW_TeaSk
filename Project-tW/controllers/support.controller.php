<?php

use duncan3dc\Sessions\SessionInstance;

class SupportController extends Controller
{
    private $session;

    public function __construct()
    {
        parent::__construct();
        $this->session = new SessionInstance(Constants::NAME_APP);
    }

    public function show()
    {

        Parameters::setData("show", "");
        require_once(VIEW . 'support.php');
    }

}