<?php

use duncan3dc\Sessions\SessionInstance;
use GuzzleHttp\Client as HttpClient;
use LinkedIn\AccessToken;

class TestController extends Controller
{
    private $id = '77fdnuwkav2mba';
    private $secret = 'AhO9z1daHL7uy6W8';


    public function show()
    {

    }

    public function code()
    {
        $client = new HttpClient();
        $db = new UserModel($this->database);
        $session = new SessionInstance(Constants::NAME_APP);
        $token = $db->getLinkedlnToken($session->get(Constants::USER));
//        $accessToken = new AccessToken($token->getToken(), $token->getExp());
        var_dump($token->getToken());
        $response = $client->request('GET', 'https://api.linkedin.com/v2/me', [
            'headers' => [
                'Host' => 'api.linkedin.com',
                'Connection' => 'Keep-Alive',
                'Authorization' => 'Bearer  ' . $token->getToken()
            ]
        ]);

        header('Content-Type: application/json');

//        var_dump($response->);
    }

    public function reset()
    {
        ResetDB::reset();
    }


}


