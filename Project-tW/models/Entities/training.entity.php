<?php

use Respect\Validation\Validator as v;

class Training
{
    private $id;
    private $title;
    private $organizer;
    private $username;
    private $location;
    private $datetime;
    private $domain;
    private $specifications;
    private $stars;
    private $difficulty;
    private $price;
    private $image;
    private $description;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDatetime()
    {
        return $this->datetime;
    }

    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;
    }

    public function getDomain()
    {
        return $this->domain;
    }

    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    public function getSpecifications()
    {
        return $this->specifications;
    }

    public function setSpecifications($specifications)
    {
        $this->specifications = $specifications;
    }

    public function getStars()
    {
        return $this->stars;
    }

    public function setStars($stars)
    {
        $this->stars = $stars;
    }

    public function getDifficulty()
    {
        return $this->difficulty;
    }

    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getOrganizer()
    {
        return $this->organizer;
    }

    public function setOrganizer($organizer)
    {
        $this->organizer = $organizer;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function validateTitle($title)
    {
        return v::length(6, 100)->validate($title);
    }

    public function validateOrganizer($organizer)
    {
        return v::length(2, 100)->validate($organizer);
    }

    public function validateType($type)
    {
        return v::length(1, 100)->validate($type);
    }

    public function validateLocation($type)
    {
        return v::length(2, 100)->validate($type);
    }

    public function validatePrice($type)
    {
        return v::not(v::negative())->validate($type) && v::numeric()->validate($type);
    }

    public function validateDifficulty($difficulty)
    {
        return v::between(0, 2)->validate($difficulty);
    }

    public function validateDatetime($datetime)
    {
        return v::date()->validate($datetime);
    }

    public function validateDomain($domain)
    {
        return v::length(1, 100)->validate($domain);
    }

    public function validateSpecifications($specifications)
    {
        return v::length(1, 100)->validate($specifications);
    }

    public function validateStars($stars)
    {
        return v::between(0, 5)->validate($stars);
    }

    public function validateDescription($description)
    {
        return v::length(50, 1000)->validate($description);
    }

    public function validateUsername($username)
    {
        return v::noWhitespace()->notEmpty()->validate($username);
    }

    public function validate()
    {
        return  $this->validateTitle($this->title) &&
                $this->validateOrganizer($this->organizer) &&
                $this->validateUsername($this->username) &&
                $this->validateLocation($this->location) &&
                $this->validateDatetime($this->datetime) &&
                $this->validateDomain($this->domain) &&
                $this->validateSpecifications($this->specifications) &&
                $this->validateStars($this->stars) &&
                $this->validateDifficulty($this->difficulty) &&
                $this->validatePrice($this->price) &&
                $this->validateDescription($this->description);
    }
}