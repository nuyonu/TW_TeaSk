<?php

class TrainingModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getTrainings()
    {
        $statement = $this->db->query("SELECT * FROM trainings");
        return $statement->fetchAll(PDO::FETCH_CLASS, "Training");
    }

    public function getTrainingById($id)
    {
        $statement = $this->db->prepare("SELECT * FROM trainings WHERE id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        return $statement->fetchObject("Training");
    }

    public function getTrainingsByFilter($params)
    {
        $conditions = array();
        $input = array();

        if ($params["title"] != "")
        {
            $conditions[] = "title LIKE :title";
            $input[":title"] = "%" . $params["title"] . "%";
        }

        if ($params["location"] != "")
        {
            $conditions[] = "location LIKE :location";
            $input[":location"] = "%" . $params["location"] . "%";
        }

        if ($params["dateStart"] != "")
        {
            $conditions[] = "datetime >= :dateStart";
            $input[":dateStart"] = $params["dateStart"];
        }

        if ($params["dateEnd"] != "")
        {
            $conditions[] = "datetime <= :dateEnd";
            $input[":dateEnd"] = $params["dateEnd"];
        }

        if ($params["domain"] != "")
        {
            $conditions[] = "domain LIKE :domain";
            $input[":domain"] = "%" . $params["domain"] . "%";
        }

        if ($params["specs"] != "")
        {
            $conditions[] = "specifications LIKE :specifications";
            $input[":specifications"] = "%" . $params["specs"] . "%";
        }

        if ($params["minStars"] != "")
        {
            $conditions[] = "stars >= :minStars";
            $input[":minStars"] = intval($params["minStars"]);
        }

        if ($params["maxStars"] != "")
        {
            $conditions[] = "stars <= :maxStars";
            $input[":maxStars"] = intval($params["maxStars"]);
        }

        if ($params["minPrice"] != "")
        {
            $conditions[] = "price >= :minPrice";
            $input[":minPrice"] = intval($params["minPrice"]);
        }

        if ($params["maxPrice"] != "")
        {
            $conditions[] = "price <= :maxPrice";
            $input[":maxPrice"] = intval($params["maxPrice"]);
        }

        if (!empty($params["diffs"]))
        {
            $func_cond = function($value) {
                return "difficulty = :diffs" . $value;
            };

            $mapped = array_map($func_cond, $params["diffs"]);
            $conditions[] = "(" . implode(" OR ", $mapped) . ")";

            foreach ($params["diffs"] as $diff)
                $input[":diffs" . $diff] = intval($diff);
        }

        $where = "1";
        if (!empty($conditions))
            $where = implode(" AND ", $conditions);

        $query = "SELECT * FROM trainings WHERE " . $where;

        try
        {
            if (empty($input))
            {
                $statement = $this->db->query($query);
            }
            else
            {
                $statement = $this->db->prepare($query);
                $statement->execute($input);
            }

            if (!$statement)
                throw new Exception("Couldn't execute statement to query trainings by filter.");

            $result = $statement->fetchAll(PDO::FETCH_CLASS, "Training");
        }
        catch (Exception $ex)
        {
            echo $ex->getMessage();
        }

        return $result;
    }

    public function getCheapTrainings($trainings, $total)
    {
        usort($trainings, function ($a,  $b) { return ($a->getPrice() <=> $b->getPrice()); });
        return array_slice($trainings, 0, $total);
    }

    public function getFavorableTrainings($trainings, $total)
    {
        usort($trainings, function ($a,  $b) { return -($a->getStars() <=> $b->getStars()); });
        return array_slice($trainings, 0, $total);
    }

    public function getCloseTrainings($trainings, $total)
    {
        usort($trainings, function ($a,  $b) { return ($a->getLocation() <=> $b->getLocation()); });
        return array_slice($trainings, 0, $total);
    }

    public function getRecentTrainings($trainings, $total)
    {
        usort($trainings, function ($a,  $b) { return ($a->getDatetime() <=> $b->getDatetime()); });
        return array_slice($trainings, 0, $total);
    }

    public function getCountTrainingsByUsername($username)
    {
        $sql = "SELECT * FROM trainings WHERE username = :username";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(":username", $username);
        $statement->execute();
        return $statement->rowCount();
    }

    public function getTrainingsByUsernameOrderByDateASC($username, $left, $right)
    {
        $sql = "SELECT * FROM trainings WHERE username = :username ORDER BY datetime LIMIT :left, :right";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(":username", $username);
        $statement->bindValue(":left", $left);
        $statement->bindValue(":right", $right);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, "Training");
    }

    public function getAllTrainingsByUsernameAndTitleOrderByDateASC($username, $title, int $left, int $right) {
        $sql = "SELECT * FROM trainings " .
            " WHERE username = :username AND title LIKE :title ORDER BY datetime LIMIT :left, :right";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(":username", $username);
        $statement->bindValue(":title", $title);
        $statement->bindValue(":left", $left);
        $statement->bindValue(":right", $right);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, "Training");
    }

    public function getCountTrainingsByUsernameAndTitle($username, $title)
    {
        $title = "%" . $title . "%";
        $sql = "SELECT * FROM trainings" .
            " WHERE trainings.username = :username AND title LIKE :title GROUP BY trainings.id";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(":username", $username);
        $statement->bindValue(":title", $title);
        $statement->execute();
        return $number_of_results = $statement->rowCount();
    }

    public function getCountTrainingsByTitle($title) {
        $title = "%" . $title . "%";
        $sql = "SELECT * from trainings " .
            "WHERE title LIKE :title GROUP BY trainings.id";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(":title", $title);
        $statement->execute();
        return $number_of_results = $statement->rowCount();
    }

    public function getAllTrainingsByTitle($title, $left, $right) {
        $title = "%" . $title . "%";
        $sql = "SELECT * FROM trainings " .
            " WHERE trainings.title LIKE :title GROUP BY trainings.id ORDER BY datetime LIMIT :left, :right";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(":title", $title);
        $statement->bindValue(":left", $left);
        $statement->bindValue(":right", $right);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, "EventEntity");
    }

    public function deleteTrainingById($id)
    {
        $statement = $this->db->prepare("DELETE FROM trainings WHERE id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
    }

    public function save(Training $training)
    {
        $sql = "INSERT INTO trainings 
                (
                    title, organizer, username, location, datetime, domain, specifications, stars, difficulty, price,
                    description
                ) 
                VALUES 
                ( 
                    :title, :organizer, :username, :location, :datetime, :domain, :specifications, :stars, :difficulty, 
                    :price, :description
                )";

        $statement = $this->db->prepare($sql);

        $props = $this->dismount($training);

        unset($props[':id']);
        unset($props[':image']);

        $statement->execute($props);

        $lastId = $this->db->lastInsertId();
        $sql = "INSERT INTO identification_code (id_training, code) VALUES (:id_training,:code)";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(":id_training", $lastId);
        $statement->bindValue(":code", CommonFunctions::generateCode());
        $statement->execute();

    }

    function dismount($object)
    {
        $reflectionClass = new ReflectionClass(get_class($object));
        $array = array();
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $array[':' . $property->getName()] = $property->getValue($object);
            $property->setAccessible(false);
        }
        return $array;
    }
}