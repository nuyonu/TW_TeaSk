<?php

class ContactModel extends Database
{
    public function addProblem(ContactDao $contact)
    {
        $this->database_connection = $this->connect();
        $statement = "INSERT INTO contact values(?,?,?,?,?) ";
        $stmt = $this->database_connection->prepare($statement);
        $stmt->bind_param("sssss", $id, $name, $email, $type, $problem);
        $name = $contact->getName();
        $email = $contact->getEmail();
        $type = $contact->getProblem();
        $problem = $contact->getDesc();
        $stmt->execute();
        $stmt->close();
    }
}