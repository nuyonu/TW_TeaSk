<?php

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class EventsDAO
{
    private $title;
    private $organizer;
    private $type;
    private $location;
    private $username;
    private $price;
    private $seats;
    private $difficulty;
    private $beginDate;
    private $endDate;
    private $beginTime;
    private $endTime;
    private $description;
    private $tags;

    /**
     * EventsDAO constructor.
     * @param $title
     * @param $organizer
     * @param $type
     * @param $location
     * @param $username
     * @param $price
     * @param $seats
     * @param $difficulty
     * @param $beginDate
     * @param $endDate
     * @param $beginTime
     * @param $endTime
     * @param $description
     * @param $tags
     */
    public function __construct($title, $organizer, $type, $location, $username, $price, $seats, $difficulty, $beginDate, $endDate, $beginTime, $endTime, $description, $tags)
    {
        $this->title = $title;
        $this->organizer = $organizer;
        $this->type = $type;
        $this->location = $location;
        $this->username = $username;
        $this->price = $price;
        $this->seats = $seats;
        $this->difficulty = $difficulty;
        $this->beginDate = $beginDate;
        $this->endDate = $endDate;
        $this->beginTime = $beginTime;
        $this->endTime = $endTime;
        $this->description = $description;
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getOrganizer()
    {
        return $this->organizer;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * @return mixed
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * @return mixed
     */
    public function getBeginDate()
    {
        return $this->beginDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @return mixed
     */
    public function getBeginTime()
    {
        return $this->beginTime;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function validateTitle($title)
    {
        return v::length(1, 50)->validate($title);
    }

    public function validateOrganizer($organizer)
    {
        return v::length(1, 50)->validate($organizer);
    }

    public function validateType($type)
    {
        return v::length(1, 50)->validate($type);
    }

    public function validateLocation($type)
    {
        return v::length(1, 50)->validate($type);
    }

    public function validatePrice($type)
    {
        return v::not(v::negative())->validate($type) && v::numeric()->validate($type);
    }

    public function validateSeats($seats)
    {
        return v::not(v::negative())->validate($seats) && v::numeric()->validate($seats);
    }

    public function validateDifficulty($difficulty)
    {
        return v::between(1, 3)->validate($difficulty);
    }

    public function validateBeginDate($beginDate)
    {
        return v::date()->validate($beginDate);
    }

    public function validateEndDate($endDate)
    {
        return v::date()->validate($endDate);
    }

    public function validateBeginTime($beginTime)
    {
        return v::noWhitespace()->validate($beginTime);
    }

    public function validateEndTime($endTime)
    {
        return v::noWhitespace()->validate($endTime);
    }

    public function validateDescription($description)
    {
        return v::length(50, 1000)->validate($description);
    }

    public function validateUsername($username) {
        return v::noWhitespace()->notEmpty()->validate($username);
    }

    public function validateAllInternAttributes()
    {
        return $this->validateTitle($this->title) &&
            $this->validateLocation($this->location) &&
            $this->validateType($this->type) &&
            $this->validateOrganizer($this->organizer) &&
            $this->validateBeginDate($this->beginDate) &&
            $this->validateBeginTime($this->beginTime) &&
            $this->validateDescription($this->description) &&
            $this->validateDifficulty($this->difficulty) &&
            $this->validateEndDate($this->endDate) &&
            $this->validateEndTime($this->endTime) &&
            $this->validatePrice($this->price) &&
            $this->validateUsername($this->username) &&
            $this->validateSeats($this->seats);
    }
}