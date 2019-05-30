<?php

class Database
{
    protected $database_connection;

    public function connect()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";

        // Create connection
        $this->database_connection=new mysqli($servername, $username, $password);

        // Check connection
        if ($this->database_connection->connect_error) {
            die("Connection failed: " . $this->database_connection->connect_error);
        }

        $sql_set_database = "USE myDB";
        if ($this->database_connection->query($sql_set_database) === TRUE) {
            echo "";
        } else {
            echo "" . $this->database_connection->error;
        }
        return $this->database_connection;
    }
}
