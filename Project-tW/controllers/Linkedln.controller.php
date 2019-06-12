<?php

use duncan3dc\Sessions\SessionInstance;
use LinkedIn\AccessToken;
use LinkedIn\Client as ClientLinkedln;
use LinkedIn\Scope;

class LinkedlnController extends Controller
{
    private $id;
    private $secret;
    private $session;

    public function __construct()
    {

        parent::__construct();
        $this->id = Config::get("ID_LINKEDLN");
        $this->secret = Config::get("KEY_LINKEDLN");
        $this->session = new SessionInstance(Constants::NAME_APP);
    }

    public function show()
    {
        $client = new ClientLinkedln($this->id, $this->secret);
        $scopes = [
            'r_liteprofile',
            Scope::READ_EMAIL_ADDRESS,
            Scope::MANAGE_COMPANY,
            Scope::SHARING,

        ];
        $client->setRedirectUrl('http://localhost/linkedln/accept');
        header('Location: ' . $client->getLoginUrl($scopes), TRUE, 303);
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
        }
        header('Location: http://localhost/settings', TRUE, 303);
        die();
    }
}
