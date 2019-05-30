<?php

use duncan3dc\Sessions\SessionInstance;

class AboutController extends Controller
{
    private $session;

    /**
     * AboutController constructor.
     */
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
        require_once(VIEW . 'about.php');
    }
}
