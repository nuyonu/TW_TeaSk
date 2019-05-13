<?php

class ContactModel extends Database
{
    public function addProblem(ContactDao $contact)
    {

        $name = $contact->getName();
        $email = $contact->getEmail();
        $type = $contact->getProblem();
        $problem = $contact->getDesc();
        $this->database_connection = $this->connect();
        $statement = "INSERT INTO contact values(?,?,?,?,?) ";
        $stmt = $this->database_connection->prepare($statement);
        $stmt->bind_param("sssss", $id, $name, $email, $type, $problem);
        $stmt->execute();
        $stmt->close();
    }
}