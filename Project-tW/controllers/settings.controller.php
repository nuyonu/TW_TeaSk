<?php

class SettingsController extends Controller
{
    public function show()
    {
        require_once(VIEW . 'setting.php');
    }

    public  function  personal(){
        $personal_data=$_POST['personal'];
        $personal=new Personal($personal_data['name'],$personal_data['first'],$personal_data['email'],$personal_data['username']);
        if($personal->valid()){
            echo
        }


    }

}