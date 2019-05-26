<?php

use duncan3dc\Sessions\SessionInstance;
use LinkedIn\Client as ClientLinkedln;
use LinkedIn\Scope;

class LinkedlnController extends Controller
{
    private $id = '77fdnuwkav2mba';
    private $secret = 'AhO9z1daHL7uy6W8';
    private $session;

    public function __construct()
    {

        parent::__construct();
        $this->session = new SessionInstance("my-app");
    }

    public function show()
    {
        $client = new ClientLinkedln($this->id, $this->secret);
        $scopes = [
            'r_fullprofile',
            Scope::READ_BASIC_PROFILE,
            Scope::READ_EMAIL_ADDRESS,
            Scope::MANAGE_COMPANY,
            Scope::SHARING,
        ];
        $client->setRedirectUrl('http://localhost/linkedln/accept');
        header('Location: '.$client->getLoginUrl(),TRUE,303);
        die();


    }

    public function accept()
    {
        $client = new ClientLinkedln($this->id, $this->secret);
        $code = $_GET['code'];
        $client->setRedirectUrl('http://localhost/linkedln/accept');
        $accessToken = $client->getAccessToken($code);
        if ($accessToken != NULL) {
            $db = new UserModel($this->database);
            $db->addTokenLinkedln($this->session->get("user"), $accessToken);
            $db->addTokenLinkedln($this->session->get("user"),$accessToken);

        }

        header('Location: http://localhost/settings', TRUE, 303);
        die();
    }
}
