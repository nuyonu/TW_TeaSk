<?php

class TrainingDAO
{
    private $title;
    private $location;
    private $dateStart;
    private $dateEnd;
    private $domain;
    private $specs;
    private $minStars;
    private $maxStars;
    private $diffs;
    private $minPrice;
    private $maxPrice;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * @param mixed $dateStart
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;
    }

    /**
     * @return mixed
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @param mixed $dateEnd
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
    }

    /**
     * @return mixed
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param mixed $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return mixed
     */
    public function getSpecs()
    {
        return $this->specs;
    }

    /**
     * @param mixed $specs
     */
    public function setSpecs($specs)
    {
        $this->specs = $specs;
    }

    /**
     * @return mixed
     */
    public function getMinStars()
    {
        return $this->minStars;
    }

    /**
     * @param mixed $minStars
     */
    public function setMinStars($minStars)
    {
        $this->minStars = $minStars;
    }

    /**
     * @return mixed
     */
    public function getMaxStars()
    {
        return $this->maxStars;
    }

    /**
     * @param mixed $maxStars
     */
    public function setMaxStars($maxStars)
    {
        $this->maxStars = $maxStars;
    }

    /**
     * @return mixed
     */
    public function getDiffs()
    {
        return $this->diffs;
    }

    /**
     * @param mixed $diffs
     */
    public function setDiffs($diffs)
    {
        $this->diffs = $diffs;
    }

    /**
     * @return mixed
     */
    public function getMinPrice()
    {
        return $this->minPrice;
    }

    /**
     * @param mixed $minPrice
     */
    public function setMinPrice($minPrice)
    {
        $this->minPrice = $minPrice;
    }

    /**
     * @return mixed
     */
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * @param mixed $maxPrice
     */
    public function setMaxPrice($maxPrice)
    {
        $this->maxPrice = $maxPrice;
    }
}