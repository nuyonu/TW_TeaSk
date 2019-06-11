<?php

use Arrayy\Arrayy as Arrayy;
use Github\Client;
use Github\Exception\RuntimeException as RuntimeException;


class GithubClient
{

    public function __construct()
    {
        $this->client = new Github\Client();
    }

    /**
     * @param string $username =username of  github account
     * @param string $password =password of github acconut
     * @return string =token of github account
     */
    public function auth(string $username, string $password): string
    {
        try {
//            $this->client->
            $this->client->authenticate($username, $password, Github\Client::AUTH_HTTP_PASSWORD);
            $data = array('note' => 'TeaSk', 'scopes' => 'repo', 'name' => 'TeaSk');
            $response = $this->client->authorization()->create($data);
            return $response['token'];
        } catch (RuntimeException $ex) {
            return self::BAD_REQUEST;
        }
    }

//    todo revoke token
    public function revoke(string $token){
//        $this->client->user()->

    }


    public function authToken(string $token): bool
    {
        $this->token = $token;
        try {
            $this->client->authenticate($token, '', Github\Client::AUTH_URL_TOKEN);
            return TRUE;
        } catch (Github\Exception\RuntimeException $ex) {
            return FALSE;
        }
    }

    public function getInfoRepos(): Arrayy
    {
        $vector = new Arrayy();
        $info = new GithubInfo();
        foreach ($this->client->currentUser()->repositories() as $repo) {
            if ($repo['language'] != NULL) {
                $info->setLanguage($repo['language']);
                $info->setCreatedAt($repo['created_at']);
                $info->setForked($repo['fork']);
                $info->setPushedAt($repo['pushed_at']);
                $info->setUpdatedAt($repo['updated_at']);
                $info->setRepoName($repo['name']);
                $vector->add(clone $info);
            }

        }
        return $vector;
    }

    private $token;
    private $client;
    private const BAD_REQUEST = "BAD_REQUEST";

}