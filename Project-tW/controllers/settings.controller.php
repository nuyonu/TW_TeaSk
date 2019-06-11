<?php

use duncan3dc\Sessions\SessionInstance;
use Respect\Validation\Validator as validator;

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
        $this->session->set(Constants::GRADE,array(Constants::GRADE=>$db->switchRole($username)));
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

    private $session;
}