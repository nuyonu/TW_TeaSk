<?php

class UserModel extends Database
{

    public function getUser(UserDAO $user)
    {
        $statement_find_user = "SELECT username FROM users where username=? and password=?  ";
        $this->database_connection = $this->connect();
        $stmt = $this->database_connection->prepare($statement_find_user);
        $stmt->bind_param('ss', $username, $password);
        $username = $user->getUsername();
        $password = $user->getPassword();
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        $stmt->close();
        if($result==null) {
            return false;
        }
        return true;
    }

    public function saveUser(Register $user)
    {
        $statement_register = "INSERT INTO users VALUES(?,?,?,?,?,?,?,?)";
        $this->database_connection = $this->connect();
        $stmt = $this->database_connection->prepare($statement_register);
        print_r($this->database_connection->error_list);
        $stmt->bind_param("dsssssss", $id, $username, $email, $password, $name, $last_name, $token, $token);
        $username = $user->getUsername();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $name = $user->getName();
        $last_name = $user->getLastName();
        $stmt->execute();
        $stmt->close();

    }

}