<?php

use duncan3dc\Sessions\SessionInstance;

define("MAX_REPOSITORIES_TO_QUERY", 10);
define("MAX_FORKS_TO_QUERY", 5);

include(ROOT . DS . 'models' . DS . 'training.model.php');

class TrainingsController extends Controller
{
    private $session;

    public function __construct()
    {
        parent::__construct();
        $this->session = new SessionInstance(Constants::NAME_APP);
    }

    public function show()
    {
        $this->model = new TrainingModel($this->database);

        $github = new GithubClient();
        $user_model = new UserModel($this->database);

        $username = $this->session->get("user");
        $github_token = $user_model->getTokenGithub($username);

        $favourite_languages = array();

        // Verificam daca suntem logati la GitHub
        if (isset($github_token) && $github->authToken($github_token))
        {
            // Luam toate repo-urile utilizatorului logat
            // Sunt returnate in ordine alfabetica
            $all_repos = $github->getClient()->api('current_user')->repositories();
            //$all_repos = $github->getClient()->api('user')->repositories('FilosGabriel');

            // Separam fork-urile de repo-urile simple
            $repos = array_filter($all_repos, function($v, $k) {
                return $v['fork'] === false;
            }, ARRAY_FILTER_USE_BOTH);

            $forks = array_filter($all_repos, function($v, $k) {
                return $v['fork'] === true;
            }, ARRAY_FILTER_USE_BOTH);

            // Sortam toate repo-urile dupa un scor (criteriile se gasesc in functie)
            $repos = $this->sortByScore($repos);
            $forks = $this->sortByScore($forks);

            // Din primele ZECE repo-uri sortate anterior, luam numarul de bytes pe limbaj de programare
            $repos_languages = $this->queryLanguages($github->getClient(), $repos, MAX_REPOSITORIES_TO_QUERY);
            $repos_bytes_per_language = $this->combine($repos_languages);
            arsort($repos_bytes_per_language);

            // Din primele CINCI fork-uri sortate anterior, luam numarul de bytes pe limbaj de programare
            // Vom lua 5% din fiecare limbaj, apoi vom adauga la limbajele din repo-uri
            // Practic vrem ca fork-urile sa fie mai putin importante ca repo-urile
            $forks_languages = $this->queryLanguages($github->getClient(), $forks, MAX_FORKS_TO_QUERY);
            $forks_bytes_per_language = $this->combine($forks_languages);

            foreach ($forks_bytes_per_language as &$language)
            {
                $language *= 0.05;
                $language = round($language);
            }

            arsort($forks_bytes_per_language);

            $favourite_languages = $this->combine(array($repos_bytes_per_language, $forks_bytes_per_language));
            arsort($favourite_languages);

            //echo '<pre>' . var_export($favourite_languages, true) . '</pre>';
        }

        $trainings = $this->model->getTrainings();

        $total = 2;
        $cheap_trainings = $this->model->getCheapTrainings($trainings, $total);
        $favorable_trainings = $this->model->getFavorableTrainings($trainings, $total);
        $close_trainings = $this->model->getCloseTrainings($trainings, $total);
        $recent_trainings = $this->model->getRecentTrainings($trainings, $total);

        $trainings = $this->recommend($trainings, $favourite_languages); //, $favourite_organizers);

        require_once(VIEW . 'trainings.php');
    }

    public function ideal($repos, $property)
    {
        $best = 0;

        foreach ($repos as $repo)
            if ($repo[$property])
                $best = max($best, $repo[$property]);

        return $best;
    }

    public function sortByScore($repos)
    {
        // Calculam maximele din toate repo-urile pentru:
        // - marimea repo-ului in KB
        // - numarul de 'watchers'
        // - numarul de 'stargazers'
        // - data ultimului commit
        $ideal_pushed_at = strtotime($this->ideal($repos, 'pushed_at'));
        $ideal_stargazers_count = $this->ideal($repos, 'stargazers_count');
        $ideal_watchers_count = $this->ideal($repos, 'watchers_count');
        $ideal_size = $this->ideal($repos, 'size');

        // Fiecarui repo ii vom da un scor in functie de cei patru parametrii de mai sus
        // Scorul este bazat pe distanta pana la optim (adica repo-ul format din toate criteriile anterioare)
        // Cu cat e mai apropiat, cu atat are scorul mai mare
        foreach ($repos as &$repository)
        {
            $pushed = strtotime($repository['pushed_at']);
            $stargazers = $repository['stargazers_count'];
            $watchers = $repository['watchers_count'];
            $size = $repository['size'];

            $inv = sqrt(
                ($pushed - $ideal_pushed_at) ** 2.0 +
                ($stargazers - $ideal_stargazers_count) ** 2.0 +
                ($watchers - $ideal_watchers_count) ** 2.0 +
                ($size - $ideal_size) ** 2.0);

            if ($inv === 0.0)
                $repository['score'] = INF;
            else
                $repository['score'] = 1.0 / $inv;
        }

        // Sortam repo-urile dupa scoruri, descrescator
        usort($repos, function($a, $b) {
            return $b['score'] - $a['score'];
        });

        return $repos;
    }

    public function queryLanguages($github_client, $repos, $max_languages)
    {
        $languages_array = array();
        $count = 0;

        foreach ($repos as $repository)
        {
            $count++;

            $languages_array[] = $github_client->api('repo')->languages($repository['owner']['login'], $repository['name']);

            if ($count >= $max_languages)
                break;
        }

        return $languages_array;
    }

    public function combine($arrays_of_arrays)
    {
        $result = array();

        foreach ($arrays_of_arrays as $array)
        {
            foreach ($array as $k => $v)
            {
                if (!isset($result[$k]))
                    $result[$k] = $v;
                else
                    $result[$k] += $v;
            }
        }

        return $result;
    }

    public function recommend($trainings, $favourite_languages) //, $favourite_organizers)
    {
        $trainings_languages_score = array();

        foreach ($trainings as $training)
        {
            $score = 10.0;
            $trainings_languages_score[$training->getId()] = 0.0;

            foreach ($favourite_languages as $language => $bytes)
            {
                if ($this->contains($language, $training->getSpecifications()))
                    $trainings_languages_score[$training->getId()] += $score;

                if ($this->contains($language, $training->getTitle()))
                    $trainings_languages_score[$training->getId()] += $score / 2.0;

                if ($this->contains($language, $training->getDescription()))
                    $trainings_languages_score[$training->getId()] += $score / 4.0;

                $score /= 2.0;
            }
        }

        usort($trainings, function($a, $b) use(&$trainings_languages_score) {
            return $trainings_languages_score[$b->getId()] - $trainings_languages_score[$a->getId()];
        });

        return $trainings;
    }

    private function contains($needle, $haystack)
    {
        return strpos(strtolower($haystack), strtolower($needle)) !== false;
    }

    public function dies()
    {
        $this->die('404 Not Found');
    }
}