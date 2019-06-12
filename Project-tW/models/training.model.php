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

    public function getTrainingsByUsernameOrderByDateASC($username, $total, $starting_offset)
    {
        $sql = "SELECT * FROM trainings WHERE username = :username ORDER BY datetime LIMIT :starting_offset, :total";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(":username", $username);
        $statement->bindValue(":total", $total);
        $statement->bindValue(":starting_offset", $starting_offset);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, "Training");
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