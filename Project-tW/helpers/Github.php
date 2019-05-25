<?php

use Github\Client;
use Github\Exception\RuntimeException;

class Github
{
    private $username;
    private $password;
    private $token;
    private $client;

    public function __construct()
    {
        $this->client = new Github\Client();
    }

    public function auth(string $username, string $password): string
    {
        try {
            $this->client->authenticate($username, $password, Github\Client::AUTH_HTTP_PASSWORD);
            $data = array('note' => 'TeaSk', 'scopes' => 'repo', 'name' => 'TeaSk');
            $response = $this->client->authorization()->create($data);
            return $response['token'];
        } catch (Github\Exception\RuntimeException $ex) {
            return "BAD_REQUEST";
        }
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

    public function getInfoRepos(): \Arrayy\Arrayy
    {
        $vector = new \Arrayy\Arrayy();
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
}