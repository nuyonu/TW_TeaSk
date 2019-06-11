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
        $stmt = $this->db->prepare("INSERT INTO events (title, type, location, description, username, price, seats, organizer, beginDate, 
                    endDate, beginTime, endTime, difficulty) VALUES (:title, :type, :location, :description, :username, :price, :seats, 
                    :organizer, :beginDate, :endDate, :beginTime, :endTime, :difficulty)");
        $stmt->bindValue(":title", $event->getTitle());
        $stmt->bindValue(":type", $event->getType());
        $stmt->bindValue(":location", $event->getLocation());
        $stmt->bindValue(":description", $event->getDescription());
        $stmt->bindValue(":username", $event->getUsername());
        $stmt->bindValue(":price", $event->getPrice());
        $stmt->bindValue(":seats", $event->getSeats());
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
    }

    public function getAllEvents()
    {
        $sql = "SELECT events.*, GROUP_CONCAT(events_tags.tag SEPARATOR ', ') AS tags FROM events_tags RIGHT JOIN events "
            . "ON events_tags.id_event = events.id GROUP BY events.id";
        $statement = $this->db->query($sql);
        return $statement->fetchAll(PDO::FETCH_CLASS, "EventEntity");
    }

    public function getAllEventsOrderByDateASC () {
        $sql = "SELECT events.*, GROUP_CONCAT(events_tags.tag SEPARATOR ', ') AS tags FROM events_tags RIGHT JOIN events ".
            " ON events_tags.id_event = events.id GROUP BY events.id ORDER BY beginDate ASC";
        $statement = $this->db->query($sql);
        return $statement->fetchAll(PDO::FETCH_CLASS, "EventEntity");
    }

    public function getAllEventsByUsernameOrderByDateASC ($username, $left, $right) {
        $sql = "SELECT events.*, GROUP_CONCAT(events_tags.tag SEPARATOR ', ') AS tags FROM events_tags RIGHT JOIN events ".
            " ON events_tags.id_event = events.id WHERE events.username = :username GROUP BY events.id ORDER BY beginDate LIMIT :left, :right";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(":username", $username);
        $statement->bindValue(":left", $left);
        $statement->bindValue(":right", $right);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, "EventEntity");
    }

    public function getCountEventsByUsername($username) {
        $sql = "SELECT events.*, GROUP_CONCAT(events_tags.tag SEPARATOR ', ') AS tags FROM events_tags RIGHT JOIN events ".
            " ON events_tags.id_event = events.id WHERE events.username = :username GROUP BY events.id";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(":username", $username);
        $statement->execute();
        return $number_of_results = $statement->rowCount();
    }

    public function getEventById($id)
    {
        $statement = $this->db->prepare("SELECT events.*, GROUP_CONCAT(events_tags.tag SEPARATOR ', ') AS tags FROM events_tags RIGHT JOIN events "
            . "ON events_tags.id_event = events.id WHERE events.id = :id GROUP BY events.id LIMIT 1");
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
}