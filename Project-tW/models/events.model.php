<?php

class EventsModel
{
    private $db;

    public function __construct( $db)
    {
        $this->db = $db;
    }

    public function saveEvent(EventsDAO $event)
    {
        // prepare sql and bind parameters
        $stmt = $this->db->prepare("INSERT INTO events (title, type, location, description, price, seats, organizer, beginDate, 
                    endDate, beginTime, endTime, difficulty) VALUES (:title, :type, :location, :description, :price, :seats, 
                    :organizer, :beginDate, :endDate, :beginTime, :endTime, :difficulty)");
        $stmt->bindValue(":title", $event->getTitle());
        $stmt->bindValue(":type", $event->getType());
        $stmt->bindValue(":location", $event->getLocation());
        $stmt->bindValue(":description", $event->getDescription());
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
            . "ON events_tags.id_event = events.id";
        $statement = $this->db->query($sql);
        return $statement->fetchAll(PDO::FETCH_CLASS, "EventEntity");
    }

    public function getEventById($id)
    {

        $statement = $this->db->prepare("SELECT events.*, GROUP_CONCAT(events_tags.tag SEPARATOR ', ') AS tags FROM events_tags RIGHT JOIN events "
            . "ON events_tags.id_event = events.id WHERE events.id = :id LIMIT 1");
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
        return $statement->fetchObject("EventEntity");
    }

    public function deleteEventById($id)
    {
        $statement = $this->db->prepare("DELETE FROM events WHERE id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
    }
}