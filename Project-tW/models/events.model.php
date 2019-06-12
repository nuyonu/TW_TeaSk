<?php

class EventsModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function saveEvent(EventsDAO $event)
    {
        // prepare sql and bind parameters
        $stmt = $this->db->prepare("INSERT INTO events (title, type, location, description, username, price/*, seats*/, organizer, beginDate, 
                    endDate, beginTime, endTime, difficulty) VALUES (:title, :type, :location, :description, :username, :price/*, :seats*/, 
                    :organizer, :beginDate, :endDate, :beginTime, :endTime, :difficulty)");
        $stmt->bindValue(":title", $event->getTitle());
        $stmt->bindValue(":type", $event->getType());
        $stmt->bindValue(":location", $event->getLocation());
        $stmt->bindValue(":description", $event->getDescription());
        $stmt->bindValue(":username", $event->getUsername());
        $stmt->bindValue(":price", $event->getPrice());
        /*        $stmt->bindValue(":seats", $event->getSeats());*/
        $stmt->bindValue(":organizer", $event->getOrganizer());
        $stmt->bindValue(":beginDate", $event->getBeginDate());
        $stmt->bindValue(":endDate", $event->getEndDate());
        $stmt->bindValue(":beginTime", $event->getBeginTime());
        $stmt->bindValue(":endTime", $event->getEndTime());
        $stmt->bindValue(":difficulty", $event->getDifficulty());
        $stmt->execute();

        $lastEventId = $this->db->lastInsertId();

        $tags = explode(',', $event->getTags());
        foreach ($tags as $tag) {
            if (strcmp("", str_replace(' ', '', $tag))) {
                $stmt = $this->db->prepare("INSERT INTO events_tags (id_event, tag) VALUES (:lastEventId, :tag)");
                $stmt->bindValue(":lastEventId", $lastEventId);
                $stmt->bindValue(":tag", $tag);
                $stmt->execute();
            }
        }

        $stmt = $this->db->prepare("INSERT INTO identification_code (id_event, code) VALUES (:lastEventId, :code)");
        $stmt->bindValue(":lastEventId", $lastEventId);
        $stmt->bindValue(":code", $event->getCode());
        $stmt->execute();
    }

    public function getAllEvents()
    {
        $sql = "SELECT events.*, GROUP_CONCAT(events_tags.tag SEPARATOR ', ') AS tags FROM events_tags RIGHT JOIN events "
            . "ON events_tags.id_event = events.id GROUP BY events.id";
        $statement = $this->db->query($sql);
        return $statement->fetchAll(PDO::FETCH_CLASS, "EventEntity");
    }

    public function getAllEventsOrderByDateASC()
    {
        $sql = "SELECT events.*, GROUP_CONCAT(events_tags.tag SEPARATOR ', ') AS tags FROM events_tags RIGHT JOIN events " .
            " ON events_tags.id_event = events.id GROUP BY events.id ORDER BY beginDate ASC";
        $statement = $this->db->query($sql);
        return $statement->fetchAll(PDO::FETCH_CLASS, "EventEntity");
    }

    public function getAllEventsByUsernameOrderByDateASC($username, $left, $right)
    {
        $sql = "SELECT events.*, GROUP_CONCAT(events_tags.tag SEPARATOR ', ') AS tags FROM events_tags RIGHT JOIN events " .
            " ON events_tags.id_event = events.id WHERE events.username = :username GROUP BY events.id ORDER BY beginDate LIMIT :left, :right";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(":username", $username);
        $statement->bindValue(":left", $left);
        $statement->bindValue(":right", $right);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, "EventEntity");
    }

    public function getCountEventsByUsername($username)
    {
        $sql = "SELECT events.*, GROUP_CONCAT(events_tags.tag SEPARATOR ', ') AS tags FROM events_tags RIGHT JOIN events " .
            " ON events_tags.id_event = events.id WHERE events.username = :username GROUP BY events.id";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(":username", $username);
        $statement->execute();
        return $number_of_results = $statement->rowCount();
    }

    public function getEventById($id)
    {
        $statement = $this->db->prepare("SELECT events.*, GROUP_CONCAT(events_tags.tag SEPARATOR ', ') AS tags, identification_code.code FROM events_tags RIGHT JOIN events "
            . "ON events_tags.id_event = events.id JOIN identification_code ON identification_code.id_event = events.id WHERE events.id = :id GROUP BY events.id LIMIT 1");
        $statement->bindValue(":id", $id);
        $statement->execute();
        return $statement->fetchObject("EventEntity");
    }

    public function getEventByTitle($title)
    {
        $statement = $this->db->prepare("SELECT events.*, GROUP_CONCAT(events_tags.tag SEPARATOR ', ') AS tags FROM events_tags RIGHT JOIN events "
            . "ON events_tags.id_event = events.id WHERE events.title = :title LIMIT 1");
        $statement->bindValue(":title", $title);
        $statement->execute();
        $object = $statement->fetchObject("EventEntity");
        return ($object->getId() == null ? false : $object);
    }

    public function deleteEventById($id)
    {
        $statement = $this->db->prepare("DELETE FROM events WHERE id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
    }

    public function codeAlreadyExist(string $code)
    {
        $statement = $this->db->prepare("SELECT code FROM identification_code WHERE code = :code");
        $statement->bindValue(":code", $code);
        $statement->execute();
        $count = $statement->rowCount();
        return $count > 0;
    }

    public function getEventsByFilter($params)
    {
        $conditions = array();
        $input = array();

        if (isset($params["beginDate"]) && $params["title"] != "") {
            $conditions[] = "title LIKE :title";
            $input[":title"] = "%" . $params["title"] . "%";
        }

        if (isset($params["beginDate"]) && $params["location"] != "") {
            $conditions[] = "location LIKE :location";
            $input[":location"] = "%" . $params["location"] . "%";
        }

        if (isset($params["beginDate"]) && $params["beginDate"] != "") {
            $conditions[] = "beginDate >= :beginDate";
            $input[":beginDate"] = $params["beginDate"];
        }

        if (isset($params["endDate"]) && $params["endDate"] != "") {
            $conditions[] = "endDate <= :endDate";
            $input[":endDate"] = $params["endDate"];
        }

        if (isset($params["orderBy"]) && $params["orderBy"] != "") {
            $orderBy = " ORDER BY " . $params["orderBy"];
            if ($orderBy != "beginDate")
                if ($orderBy != "price") {
                    $orderBy = "";
                }
        } else
            $orderBy = "";

        $where = "1";
        if (!empty($conditions))
            $where = implode(" AND ", $conditions);

        $query = "SELECT * FROM events WHERE " . $where . $orderBy;

        try {
            if (empty($input)) {
                $statement = $this->db->query($query);
            } else {
                $statement = $this->db->prepare($query);
                $statement->execute($input);
            }

            if (!$statement)
                throw new Exception("Couldn't execute statement to query trainings by filter.");

            $result = $statement->fetchAll(PDO::FETCH_CLASS, "EventEntity");
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }

        return $result;
    }

    public function getAllEventsByUsernameAndTitleOrderByDateASC($username, $title, int $left, int $right)
    {
        $sql = "SELECT events.*, GROUP_CONCAT(events_tags.tag SEPARATOR ', ') AS tags FROM events_tags RIGHT JOIN events " .
            " ON events_tags.id_event = events.id WHERE events.username = :username AND title LIKE :title GROUP BY events.id ORDER BY beginDate LIMIT :left, :right";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(":username", $username);
        $statement->bindValue(":title", $title);
        $statement->bindValue(":left", $left);
        $statement->bindValue(":right", $right);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, "EventEntity");
    }

    public function getCountEventsByUsernameAndTitle($username, $title)
    {
        $title = "%" . $title . "%";
        $sql = "SELECT events.*, GROUP_CONCAT(events_tags.tag SEPARATOR ', ') AS tags FROM events_tags RIGHT JOIN events " .
            " ON events_tags.id_event = events.id WHERE events.username = :username AND title LIKE :title GROUP BY events.id";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(":username", $username);
        $statement->bindValue(":title", $title);
        $statement->execute();
        return $number_of_results = $statement->rowCount();
    }

    public function getCountEventsByTitle($title) {
        $title = "%" . $title . "%";
        $sql = "SELECT events.*, GROUP_CONCAT(events_tags.tag SEPARATOR ', ') AS tags FROM events_tags RIGHT JOIN events " .
            " ON events_tags.id_event = events.id WHERE title LIKE :title GROUP BY events.id";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(":title", $title);
        $statement->execute();
        return $number_of_results = $statement->rowCount();
    }

    public function getAllEventsByTitle($title, $left, $right) {
        $title = "%" . $title . "%";
        $sql = "SELECT events.*, GROUP_CONCAT(events_tags.tag SEPARATOR ', ') AS tags FROM events_tags RIGHT JOIN events " .
            " ON events_tags.id_event = events.id WHERE events.title LIKE :title GROUP BY events.id ORDER BY beginDate LIMIT :left, :right";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(":title", $title);
        $statement->bindValue(":left", $left);
        $statement->bindValue(":right", $right);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, "EventEntity");
    }

    public function getUsernameFromEvent($eventId)
    {
        $statement = $this->db->prepare("SELECT username FROM events WHERE events.id = :id");
        $statement->bindValue(":id", $eventId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result["username"];
    }
}