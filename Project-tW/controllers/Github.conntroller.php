<?php

use duncan3dc\Sessions\SessionInstance;
use GuzzleHttp\Client as HttpClient;

class GithubController extends Controller
{
    private $session;

    public function show()
    {
        header('Location: https://github.com/login/oauth/authorize?scope=repo&client_id=de755d45d11e431e67c8');
        die();
    }

    public function __construct()
    {
        parent::__construct();
        $this->session = new SessionInstance("my-app");
    }

    public function accept()
    {

        $client = new HttpClient();
        $response = $client->request('POST', 'https://github.com/login/oauth/access_token?client_id=de755d45d11e431e67c8&
        redirect_uri=http://localhost/github/accept&client_secret=8782e4779be614afebf294d605af3dfce45caad1&code=' . $_GET['code']);
        $token = explode('&', explode('=', $response->getBody()->getContents())[1])[0];
        $userDB = new UserModel($this->database);
        $userDB->addToken($this->session->get("user"), $token);
        $github = new GithubClient();
        $github->authToken($token);
        $github_database = new GithubModel($this->database);
        $github_database->save($github->getInfoRepos(), $this->session->get("user"));
        Response::redirect('/settings');

    }

}