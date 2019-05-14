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

        echo $query;

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

    public function save(Training $training)
    {
        $statement_save = "INSERT INTO trainings VALUES(DEFAULT, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $connection = $this->db->connect();

        $statement = $connection->prepare($statement_save);

        print_r($connection->error_list);

        $statement->bind_param("sssssiiis",
            $training->getTitle(),
            $training->getLocation(),
            $training->getDatetime(),
            $training->getDomain(),
            $training->getSpecifications(),
            $training->getStars(),
            $training->getDifficulty(),
            $training->getPrice(),
            $training->getImage());

        $statement->execute();

        printf("%d Row inserted.\n", $statement->affected_rows);

        $statement->close();
        $connection->close();
    }
}