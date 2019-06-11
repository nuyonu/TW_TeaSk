<?php

use duncan3dc\Sessions\SessionInstance;

class AdmintrainingsController extends Controller
{
    private $session;

    public function __construct()
    {
        parent::__construct();
        $this->session = new SessionInstance("my-app");
    }

    public function show()
    {
        require_once(VIEW . 'admin-trainings.php');
    }
}
