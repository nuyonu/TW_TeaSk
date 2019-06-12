<?php

use duncan3dc\Sessions\SessionInstance;
use Respect\Validation\Validator as validator;
use Github\HttpClient\Message\ResponseMediator;

define("MAX_REPOSITORIES_TO_QUERY", 5);

class SettingsController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->session = new SessionInstance(Constants::NAME_APP);

    }

    public function show()
    {
//        Logic
        $db = new UserModel($this->database);
        $dbLocation = new LocationModel($this->database);
        $username = $this->session->get(Constants::USER);
        $place = $dbLocation->getLocationUser($username) == NULL ? Constants::NOT_SETTED : $dbLocation->getLocationUser($username)->getPlace();

        $modelCode = new CodeModel($this->database);
        $lastEventsTrainings = $modelCode->getAllDetails($username);

//        Pass parameter to view
        Parameters::setData("show", "hidden");
        Parameters::setData("location", $place);
        Parameters::setData("image", FileManager::getImageUser($username));
        Parameters::setData("userData", $db->getUserDb($username));
        Parameters::setData("github", $db->isConnectedWithGithub($username));
        Parameters::setData("linkedln", $db->isConnectedWithLinkedln($username));
        Parameters::setData("user", $username);
        Parameters::setData(Constants::GRADE, $this->session->get(Constants::GRADE)['grade']);
        require_once(Constants::VIEW_SETTING);
    }

    public function personal()
    {
        if (ValidatorPost::validatePersonal()) {
            $personal_data = $_POST['personal'];
            $personal = new Personal($personal_data['name'], $personal_data['first'], $personal_data['emailSetting'],
                $this->session->get(Constants::USER));
//            validate user info
            if ($personal->valid()) {
                $db = new UserModel($this->database);
                $db->updatePerson($personal);
            }
//              validate long and lat for user
            if (validator::floatVal()->noWhitespace()->validate($personal_data['lat']) && validator::floatVal()->noWhitespace()->validate($personal_data['long'])) {
                $db = new LocationModel($this->database);
                $db->save($this->session->get("user"), $personal_data['place'], $personal_data['lat'],
                    $personal_data['long']);
            }
            Response::redirect(Constants::SETTINGS);
        } else {
            Response::redirect_with_fail(Constants::SETTINGS,
                Constants::FAUL_MESSAGE);
        }
    }

    public function contact()
    {
        $personal_data = $_POST['contact'];
        $personal = new ContactSettings($personal_data['old'], $personal_data['newC'], $personal_data['new'],
            $this->session->get("user"));
        if ($personal->valid()) {
            $db = new UserModel($this->database);
            $db->updateContact($personal);
        }
        Response::redirect(Constants::SETTINGS);
    }

    public function delete()
    {
        $username = $this->session->get(Constants::USER);
        $db = new UserModel($this->database);
        $db->deleteByUsername($username);
        $this->session->clear();
        Response::redirect(Constants::HOME);
    }

    public function role()
    {
        $username = $this->session->get(Constants::USER);
        $db = new UserModel($this->database);
        $this->session->set(Constants::GRADE, array(Constants::GRADE => $db->switchRole($username)));
        var_dump($this->session->get(Constants::GRADE));
        Response::redirect(Constants::SETTINGS);
    }

    public function upload()
    {
        $target_file = UPLOADS . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== FALSE) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
        }
        if ($uploadOk == 1 && FileManager::verifyFileExist($this->session->get(Constants::USER))) {
            unlink(UPLOADS . FileManager::getImageUser($this->session->get(Constants::USER)));
        }
        if ($_FILES["fileToUpload"]["size"] > Constants::MAX_SIZE) {
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $uploadOk = 0;
        }
        if ($uploadOk == 1 && move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],
                UPLOADS . $this->session->get("user") . '.' . $imageFileType)) {
            Response::redirect(Constants::SETTINGS);

        } else {
            Response::redirect(Constants::SETTINGS);
        }
    }

//    todo spit class

    public function github()
    {
        Response::redirectGithub();
    }

    public function linkedln()
    {
        Response::redirectLinkedln();
    }

    public function dissconect1()
    {
        $db = new UserModel($this->database);
        $db->deleteGithub($this->session->get(Constants::USER));
        Response::redirect(Constants::SETTINGS);
    }

    public function dissconect2()
    {
        $db = new UserModel($this->database);
        $db->deleteLinkedln($this->session->get(Constants::USER));
        Response::redirect(Constants::SETTINGS);
    }

    public function deleteAccount()
    {
        $db = new UserModel($this->database);
        $db->deleteByUsername($this->session->get(Constants::USER));
        $this->session->clear();
        Response::redirect(Constants::HOME);
    }

    public function addCode()
    {
        $model = new UserModel($this->database);
        $username = $this->session->get("user");
        $user = $model->getUserDb($username);
        if (isset($_POST['code'])) {
            $code = $_POST['code'];
            $model = new CodeModel($this->database);

            if (!$model->codeExist($code)) {
                echo json_encode(array(Constants::SUCCESS_RESULT => 0));
            } else {
                if ($model->codeAlreadyUsedByUser($code, $user)) {
                    echo json_encode(array(Constants::SUCCESS_RESULT => 1));
                } else {
                    $model->insertCode($code, $user);
                    echo json_encode(array(Constants::SUCCESS_RESULT => 2));
                }
            }
        } else {
            echo json_encode(array(Constants::SUCCESS_RESULT => 3));
        }
    }

    public function getStatistics()
    {
        $github = new GithubClient();
        $user_model = new UserModel($this->database);

        $username = $this->session->get("user");
        $github_token = $user_model->getTokenGithub($username);

        if (isset($github_token) && $github->authToken($github_token)) {
            // Luam toate repo-urile
            $repos = $github->getClient()->api('current_user')->repositories();

            // Sortam pe baza ultimului commit commit, descrescator
            usort($repos, function ($a, $b) {
                return strtotime($b['pushed_at']) - strtotime($a['pushed_at']);
            });

            // Maxim cinci repo-uri pe care le vom analiza (mai exact primele cinci)
            $count = min(MAX_REPOSITORIES_TO_QUERY, count($repos));

            $results = array();
            // Pentru fiecare repo... vom returna:
            // - numarul de commit-uri din ultimele doua saptamani de catre utilizator + limbajul de programare al repo-ului
            // - schimbarile (numarul de adaugari, stergeri, commit-uri) facute de utilizator, din ultimele doua saptamani
            for ($index = 0; $index < $count; $index++) {
                $full_name = $repos[$index]['full_name'];
//                $full_name = 'nuyonu/TW_TeaSk';

//                echo $full_name . "<br>";

                // Luam numarul de commit-uri al utilizatorului, cat si limbajul, din repo-ul curent
                // din saptamana curenta si anterioara
                $response = $github->getClient()->getHttpClient()->get('repos/' . $full_name . '/stats/participation');
                $stats = Github\HttpClient\Message\ResponseMediator::getContent($response);

                $language = $repos[$index]['language'];
                $last_week_commits = $stats['owner']['50'];
                $this_week_commits = $stats['owner']['51'];
                $difference_in_commits = $this_week_commits - $last_week_commits;

//                echo '<pre>' . var_export($language, true) . '</pre>';
//                echo '<pre>' . var_export($last_week_commits, true) . '</pre>';
//                echo '<pre>' . var_export($this_week_commits, true) . '</pre>';

                // Luam numarul de adaugari, stergeri si commit-uri din ultima saptamana si penultima
                $response = $github->getClient()->getHttpClient()->get('repos/' . $full_name . '/stats/contributors');
                $stats = Github\HttpClient\Message\ResponseMediator::getContent($response);

                $this_week_changes = $last_week_changes = array('w' => 0, 'a' => 0, 'd' => 0, 'c' => 0);
                $difference_in_changes = 0;

                foreach ($stats as $stat) {
                    if ($stat['author']['login'] === $repos[$index]['owner']['login']) {
                        $this_week_changes = end($stat['weeks']);
                        $last_week_changes = prev($stat['weeks']);

                        $difference_in_changes =
                            ($this_week_changes['a'] + $this_week_changes['d'] + $this_week_changes['c']) -
                            ($last_week_changes['a'] + $last_week_changes['d'] + $last_week_changes['c']);
                    }
                }

/*                echo '<pre>' . var_export($last_week_changes, true) . '</pre>';
                echo '<pre>' . var_export($this_week_changes, true) . '</pre>';*/

                // Punem totul la un loc
                $results[] = array("language" => $language,
                    "last_week_commits" => $last_week_commits,
                    "this_week_commits" => $this_week_commits,
                    "difference_in_commits" => $difference_in_commits,
                    "last_week_changes" => $last_week_changes,
                    "this_week_changes" => $this_week_changes,
                    "difference_in_changes" => $difference_in_changes);
            }

            // Formatam pentru afisat pe pagina
/*            echo '<pre>' . var_export($results, true) . '</pre>';*/

            $total_repos = count($results);

            $less_worked_repos = $more_worked_repos =
            $total_commits_this_week = $total_commits_last_week =
            $total_adds_last_week = $total_deletions_last_week =
            $total_adds_this_week = $total_deletions_this_week = 0;

            $worked_on_languages = array();

            foreach ($results as $result) {
                $less_worked_repos += ($result["difference_in_changes"] <= 0) || ($result["difference_in_commits"] <= 0);
                $more_worked_repos += ($result["difference_in_changes"] > 0) || ($result["difference_in_commits"] > 0);

                if (($result["difference_in_changes"] > 0) || ($result["difference_in_commits"] > 0))
                    $worked_on_languages[] = $result["language"];

                $total_commits_this_week += $result["this_week_commits"];
                $total_commits_last_week += $result["last_week_commits"];

                $total_adds_this_week += $result["this_week_changes"]["a"];
                $total_adds_last_week += $result["last_week_changes"]["a"];

                $total_deletions_this_week += $result["this_week_changes"]["d"];
                $total_deletions_last_week += $result["last_week_changes"]["d"];
            }

            echo "<p class='info-statistics'>S-au analizat ultimele " . $total_repos . " repo-uri ale tale de pe GitHub." . "</p>";
            echo '<p class=\'info-statistics green\'>Ai facut progrese in ' . $more_worked_repos . ' repo-uri.' . "</p>";
            echo '<p class=\'info-statistics red\'>Nu ai progresat sau nu ai modificat nimic in ' . $less_worked_repos . ' repo-uri.' . "</p>";

            $this->formatDifference($total_commits_this_week, $total_commits_last_week, 'commit-uri');
            $this->formatDifference($total_adds_this_week, $total_adds_last_week, 'adaugari');
            $this->formatDifference($total_deletions_this_week, $total_deletions_last_week, 'stergeri');

            $worked_on_languages = array_unique($worked_on_languages);
            if (count($worked_on_languages) !== 0)
                echo '<p class=\'info-statistics green\'>Ai lucrat saptamana asta la repo-uri cu limbajele: ' . implode(", ", $worked_on_languages) . ".</p>";
            else
                echo '<p class=\'info-statistics red\'>N-ai lucrat saptamana asta la vreun limbaj din vreun repo.' . "</p>";
        }
    }

    private function formatDifference($this_week, $last_week, $description)
    {
        echo '<br><p class=\'info-statistics\'>Saptamana asta ai avut in total: ' . $this_week . ' ' . $description . '.' . "</p>";
        echo '<p class=\'info-statistics\'>Saptamana trecuta ai avut in total: ' . $last_week . ' ' . $description . '.' . "</p>";

        if ($this_week > $last_week)
            echo '<p class=\'info-statistics green\'>Ai progresat, deoarece ai mai multe adaugari saptamana asta ' . $this_week . ', ' .
                'decat saptamana trecuta ' . $last_week . '.</p>';
        else if ($this_week === $last_week)
            echo '<p class=\'info-statistics\'>N-ai progresat, deoarece ai acelasi numar de adaugari ca saptamana trecuta ' .
                $this_week . '.</p>';
        else
            echo '<p class=\'info-statistics red\'>Ai regresat, deoarece ai mai putine adaugari saptamana asta ' . $this_week . ', ' .
                'decat saptamana trecuta (' . $last_week . ').</p>';
        echo '<p class=\'info-statistics\'>Diferenta este de ' . ($this_week - $last_week) . ' ' . $description . '.</p>';
    }

    private $session;
}