<?php

use duncan3dc\Sessions\SessionInstance;
use Respect\Validation\Validator as validator;


class SettingsController extends Controller
{
    private $session;

    public function __construct()
    {
        parent::__construct();
        $this->session = new SessionInstance(Constants::NAME_APP);
    }

    public function show()
    {
        $user = $this->session->get(Constants::USER);
        if ($user != NULL) {
            $db = new UserModel($this->database);
            $dbLocation = new LocationModel($this->database);
            $place = $dbLocation->getLocationUser($this->session->get("user")) == NULL ? 'nesetat' : $dbLocation->getLocationUser($this->session->get("user"))->getPlace();
            Parameters::setData("show", "hidden");
            Parameters::setData("location", $place);
            Parameters::setData("image", $this->imageUser());
            Parameters::setData("userData", $db->getUserDb($user));
            Parameters::setData("github", $db->isConnectedWithGithub($this->session->get("user")));
            Parameters::setData("linkedln", $db->isConnectedWithLinkedln($this->session->get("user")));
            Parameters::setData("user",$this->session->get("user"));
        } else {

            Parameters::setData("show", "show");
        }
        require_once(Constants::VIEW_SETTING);
    }

    public function personal()
    {
        $personal_data = $_POST['personal'];
        $personal = new Personal($personal_data['name'], $personal_data['first'], $personal_data['emailSetting'],
            $personal_data['username']);
        if ($personal->valid()) {
            $db = new UserModel($this->database);
            $db->updatePerson($personal);
        }

        if (validator::floatVal()->noWhitespace()->validate($personal_data['lat']) && validator::floatVal()->noWhitespace()->validate($personal_data['long'])) {
            echo $personal_data['place'];
            $db = new LocationModel($this->database);
            $db->save($this->session->get("user"), $personal_data['place'], $personal_data['lat'],
                $personal_data['long']);
        }
        Response::redirect(Constants::SETTINGS);
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
        if ($this->verify() && $uploadOk==1) {
            unlink(UPLOADS . $this->imageUser());
        }
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $uploadOk = 0;
        }
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],
                UPLOADS . $this->session->get("user") . '.' . $imageFileType)) {
                Response::redirect("/settings");
            } else {
                Response::redirect("/settings");
            }
        } else {
            Response::redirect("/settings");
        }
    }

    public function github()
    {
        Response::redirectGithub();
    }

    public function linkedln()
    {
        Response::redirectLinkedln();
    }


    private function verify(): bool
    {
        if (file_exists(UPLOADS . $this->session->get("user") . '.jpg')) {
            return TRUE;
        }
        if (file_exists(UPLOADS . $this->session->get("user") . '.png')) {
            return TRUE;
        }
        return file_exists(UPLOADS . $this->session->get("user") . '.gif');

    }

    private function imageUser(): string
    {
        $file = 'default.jpg';
        if (file_exists(UPLOADS . $this->session->get("user") . '.jpg')) {
            $file = $this->session->get("user") . '.jpg';
        } elseif (file_exists(UPLOADS . $this->session->get("user") . '.png')) {
            $file = $this->session->get("user") . '.png';
        } elseif (file_exists(UPLOADS . $this->session->get("user") . '.gif')) {
            $file = $this->session->get("user") . '.gif';
        }
        return $file;


    }
}