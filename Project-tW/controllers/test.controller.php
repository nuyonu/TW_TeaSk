<?php

class TestingController extends Controller
{

    public function show()
    {

        $user = new Register();
        $user->setEmail('filo@gmail.com');
        $user->setName('filos');
        $user->setLastName('filos');
        $user->setPassword('123dasad');
        $user->setUsername('adasdadada');
        if( $user->validate()){
            echo 'dasd';
        }
    }


}


