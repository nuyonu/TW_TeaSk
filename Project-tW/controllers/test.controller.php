<?php

use LinkedIn\Client as ClientLinkedln;
use LinkedIn\Scope;

class TestingController extends Controller
{
    private $id = '77fdnuwkav2mba';
    private $secret = 'AhO9z1daHL7uy6W8';



    public function show()
    {
        $client = new ClientLinkedln($this->id, $this->secret);
        $scopes = [
            Scope::READ_BASIC_PROFILE,
            Scope::READ_EMAIL_ADDRESS,
            Scope::MANAGE_COMPANY,
            Scope::SHARING,
        ];
        $client->setRedirectUrl('http://localhost/testing/code');
        $loginUrl = $client->getLoginUrl($scopes);
        var_dump($loginUrl);


    }
    public function code(){
        $client = new ClientLinkedln($this->id, $this->secret);
        $code=$_GET['code'];
        $client->setRedirectUrl('http://localhost/testing/code');

        $accessToken = $client->getAccessToken($code);
        $dv=new UserModel($this->database);
//        var_dump($accessToken);
    }

    public
    function reset()
    {
        ResetDB::reset();
    }


}


