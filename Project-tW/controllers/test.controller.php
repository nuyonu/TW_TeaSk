<?php

class TestingController extends Controller
{

    public function show()
    {

        $client = new \Github\Client();
//        $client->authenticate('d52409ea9bc18b178ec8ef756df9158a1377c642', '', Github\Client::AUTH_URL_TOKEN);
        $client->authenticate("filosgabriel@gmail.com", "98@gmail.com", Github\Client::AUTH_HTTP_PASSWORD);


        $vector = new \Arrayy\Arrayy();
        $info = new GithubInfo();
        foreach ($client->currentUser()->repositories() as $repo) {
            if($repo['language']!=NULL){
            $info->setLanguage($repo['language']);
            $info->setCreatedAt($repo['created_at']);
            $info->setForked($repo['fork']);
            $info->setPushedAt($repo['pushed_at']);
            $info->setUpdatedAt($repo['updated_at']);
            $info->setRepoName($repo['name']);
//            var_dump($info);
            $vector->add(clone $info);
            }
        }
        foreach ($vector as $element) {
            var_dump($element);
            echo "</br>";
            echo "</br>";

        }


    }

    public
    function reset()
    {
        ResetDB::reset();
    }


}


