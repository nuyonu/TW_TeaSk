<?php

use AsyncTask\AsyncTask;
use AsyncTask\Collection;

class GithubUpdate extends AsyncTask
{

    /**
     * Override this method to perform a computation on a background thread.
     *
     * @param \AsyncTask\Collection $collection
     *
     * @return mixed
     */
    protected function doInBackground(Collection $collection)
    {
        $github = new GithubClient();
        $github->authToken($collection->get('token'));
        $result = $github->getInfoRepos();
        $db = new GithubModel($collection->get("db"));
        $db->save($result, $collection->get("user"));
        return "Done";
    }
}