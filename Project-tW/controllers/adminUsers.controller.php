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
        $search = UtilsAdminUsers::getSearch($this->params);
        $maxPage = $search == NULL ? $db->getMaxPage() : $db->getMaxPageSearch($search);
        $page = UtilsAdminUsers::getPage($maxPage,$this->params);
        $result = $search != NULL ? $db->getUsersSearch($search, $page) : $db->getUsers($page);

        Parameters::setData("max_page", $maxPage);
        Parameters::setData("current_page", $page);
        Parameters::setData("users", $result);
        Parameters::setData("search", $search);
        require_once(Constants::VIEW_ADMIN_USERS);
    }

    public function delete()
    {
        if (isset($_GET[Constants::ALL_DELETE])) {
            $userForRemove = $_GET[Constants::ALL_DELETE];
            $model = new UserModel($this->database);
            foreach ($userForRemove as $id) {
                $model->deleteById($id);
            }
        }
        Response::redirect(Constants::ADMIN_USERS);
    }

    private $session;
}
