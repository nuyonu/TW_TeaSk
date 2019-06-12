<?php

class AdminsupportController extends Controller
{
    public function show()
    {
        $db = new ContactModel($this->database);
        $list=$db->getAll();
        Parameters::setData("contact",$list );

        require_once(VIEW . 'admin-support.php');
    }

    public function delete()
    {
        if (isset($_GET[Constants::ALL_DELETE])) {
            $userForRemove = $_GET[Constants::ALL_DELETE];
            $model = new ContactModel($this->database);
            foreach ($userForRemove as $id) {
                $model->deleteById($id);
            }
        }
        Response::redirect("/adminSupport");
    }
}
