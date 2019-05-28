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

            Parameters::setData("userData", $db->getUserDb($user));
            Parameters::setData("github",$db->isConnectedWithGithub($this->session->get("user")));
            Parameters::setData("linkedln",$db->isConnectedWithLinkedln($this->session->get("user")));
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
        Response::redirect(Constants::SEEINGS);
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
        Response::redirect(Constants::SEEINGS);
    }

    public function github()
    {
        Response::redirectGithub();
    }

   public function upload(){
       $target_file = UPLOADS . basename($_FILES["fileToUpload"]["name"]);
       $uploadOk = 1;
       $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
       if(isset($_POST["submit"])) {
           $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
           if($check !== false) {
               echo "File is an image - " . $check["mime"] . ".";
               $uploadOk = 1;
           } else {
               echo "File is not an image.";
               $uploadOk = 0;
           }
       }
       if (file_exists($target_file)) {
           echo "Sorry, file already exists.";
           $uploadOk = 0;
       }
       if ($_FILES["fileToUpload"]["size"] > 500000) {
           echo "Sorry, your file is too large.";
           $uploadOk = 0;
       }
       if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
           && $imageFileType != "gif" ) {
           echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
           $uploadOk = 0;
       }
       if ($uploadOk == 0) {
           echo "Sorry, your file was not uploaded.";

       } else {
           if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
               echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
           } else {
               echo "Sorry, there was an error uploading your file.";
           }
       }
   }


    public function linkedln()
    {
        Response::redirectLinkedln();
    }

    public function login1()
    {
        $personal_data = $_POST['data'];
        $github = new GithubClient();
        $token = $github->auth($personal_data['user'], $personal_data['password']);
        if (strcmp($token, "BAD_REQUEST") == 0) {
            echo "first";
            Response::redirect("/settings/github");
        } else {
            echo "second";
            $user = $this->session->get("user");
            $userDB = new UserModel($this->database);
            $userDB->addToken($user, $token);
        }
        $github_database = new GithubModel($this->database);
        $github_database->save($github->getInfoRepos(), $this->session->get("user"));
        Response::redirect(Constants::SEEINGS);

    }

}