<?php

class ContactController extends Controller
{
    public function show()
    {
        require_once(VIEW . 'contact.php');
    }
    public  function send(){
        $data=$_POST['contact'];
        $contact=new ContactDao($data['name'],$data['email'],$data['problem'],$data['desc']);
        $database=new ContactModel();
        $database->addProblem($contact);
        header("Location: http://localhost/events", true, 301);
        die();
    }
}