<?php

use duncan3dc\Sessions\SessionInstance;

class AdminusersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->session = new SessionInstance(Constants::NAME_APP);
    }

    public function show()
    {
        $db = new UserModel($this->database);
        $result = 0;
        if (isset($_POST[Constants::SEARCH])) {
            $result = $db->getUsersSearch($_POST[Constants::SEARCH]);
        } else {
            $result = $db->getUsers();
        }
        Parameters::setData("users", $result);
//        require_once(Constants::VIEW_ADMIN_USERS);
    }

    public function delete()
    {
        if (isset($_GET[Constants::ALL_DELETE])) {
            $userForRemove = $_GET[Constants::ALL_DELETE];
            $model = new UserModel($this->database);
            foreach ($userForRemove as $id) {K
                $model->deleteById($id);
            }
        }
        Response::redirect(Constants::ADMIN_USERS);
    }

    private $session;
}
