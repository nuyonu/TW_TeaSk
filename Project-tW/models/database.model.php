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
        $database_connection = new mysqli($servername, $username, $password);

        // Check connection
        if ($database_connection->connect_error)
            die("Connection failed: " . $database_connection->connect_error);

        $sql_set_database = "USE myDB";
        if ($database_connection->query($sql_set_database) === TRUE) {
            echo "";
        } else {
            echo "" . $database_connection->error;
        }
//        echo "Connected successfully";
        return $database_connection;
    }
}
