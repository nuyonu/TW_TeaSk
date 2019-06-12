<?php

class CodeModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function codeExist($code)
    {
        $statement = $this->db->prepare("SELECT code FROM identification_code WHERE code = :code");
        $statement->bindValue(":code", $code);
        $statement->execute();
        if ($statement->rowCount() > 0)
            return true;
        return false;
    }

    public function codeAlreadyUsedByUser($code, $user)
    {
        $userID = $user->getId();

        $statement = $this->db->prepare("SELECT participations.id_user FROM participations
                        JOIN identification_code ON identification_code.id = participations.id_identification_code
                        WHERE code = :code AND id_user = :id_user");
        $statement->bindValue(":code", $code);
        $statement->bindValue(":id_user", $userID);
        $statement->execute();
        if ($statement->rowCount() > 0)
            return true;
        return false;
    }

    public function insertCode($code, $user)
    {
        $userID = $user->getId();

        $statement = $this->db->prepare("SELECT id FROM identification_code WHERE code = :code");
        $statement->bindValue(":code", $code);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $identificationCode = $result["id"];

        $statement = $this->db->prepare("INSERT INTO participations (id_user, id_identification_code) VALUES (:id_user, :id_identification_code)");
        $statement->bindValue(":id_user", $userID);
        $statement->bindValue("id_identification_code", $identificationCode);
        $statement->execute();
    }

    public function getAllDetails($username)
    {
        $query = "SELECT 0 'type', events.title, events.beginDate, events.organizer, events.location, events.price
            FROM events
                     JOIN identification_code ON identification_code.id_event = events.id
                     JOIN participations ON participations.id_identification_code = identification_code.id
                     JOIN users ON users.id = participations.id_user
            WHERE users.username = :username1
            UNION
            SELECT 1 'type', trainings.title, trainings.datetime, trainings.organizer, trainings.location, trainings.price
            FROM trainings
                     JOIN identification_code ON identification_code.id_training = trainings.id
                     JOIN participations ON participations.id_identification_code = identification_code.id
                     JOIN users ON users.id = participations.id_user
            WHERE users.username = :username2";
        $statement = $this->db->prepare($query);
        $statement->bindValue(":username1", $username);
        $statement->bindValue(":username2", $username);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, "CodeEntity");
    }
}