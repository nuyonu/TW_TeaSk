<?php


use AsyncTask\Collection;

class GithubUpdate
{

    /**
     * Override this method to perform a computation on a background thread.
     *
     * @param \AsyncTask\Collection $collection
     *
     * @return mixed
     */

    public static function doInBackground($db_con, $user)
    {
        $database = new UserModel($db_con);
        if ($user != NULL) {
            $token = $database->getTokenGithub($user);
            if ($token != NULL) {
                $last = strtotime($database->lastUpdate($user));
                $current = strtotime(date("Y-m-d"));
                $diff = abs($current - $last);
                if ($diff > Constants::INTERVAL_UPDATE) {
                    $github = new GithubClient();
                    $github->authToken($token);
                    $result = $github->getInfoRepos();
                    $db = new GithubModel($db_con);
                    $db->save($result, $user);
                }
            }
        }
    }
}