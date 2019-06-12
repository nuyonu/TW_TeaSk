<?php


class Transform
{
    public static function toArrayEvents($list)
    {
        $data = array();
        foreach ($list as $event) {
            $temp = array(
                "id" => $event->getId(),
                "data" => array(
                    "organizer" => $event->getOrganizer(),
                    "type" => $event->getType(),
                    "location" => $event->getLocation(),
                    "price" => $event->getPrice(),
                    "difficulty" => $event->getDifficulty(),
                    "begin date" => $event->getBeginDate(),
                    "begin time" => $event->getBeginTime(),
                    "end date" => $event->getEndDate(),
                    "end time" => $event->getEndTime(),
                    "description" => $event->getDescription(),
                    "tags" => $event->getTags(),
                    "code" => $event->getCode()
                )
            );
            array_push($data, $temp);

        }
        return $data;
    }

    public static function toArrayTraings($list)
    {
        $data = array();
        foreach ($list as $event) {

            $temp = array(
                "id" => $event->getId(),
                "data" => array(
                    "title" => $event->getTitle(),
                    "organizer" => $event->getOrganizer(),
                    "location" => $event->getLocation(),
                    "price" => $event->getPrice(),
                    "difficulty" => $event->getDifficulty(),
                    "datetime" => $event->getDatetime(),
                    "domain" => $event->getDomain(),
                    "specifications" => $event->getSpecifications(),
                    "stars" => $event->getStars(),
                    "description" => $event->getDescription()
                )
            );
            array_push($data, $temp);

        }
        return $data;
    }
}