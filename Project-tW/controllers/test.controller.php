<?php
//require_once "../vendor/autoload.php";
//  ("../models/DAO/Register.DAO.php");
class TestController extends Controller
{

    public function show()
    {
        $user = new Register();
        echo $user->validate();
    }


}


