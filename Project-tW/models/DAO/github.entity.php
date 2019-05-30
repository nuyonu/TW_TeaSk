<?php

class GithubEntity
{
    private $id;
    private $id_user;
    private $language;
    private $forked;
    private $repo_name;
    private $created_at;
    private $updated_at;
    private $pushed_at;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user): void
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language): void
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getForked()
    {
        return $this->forked;
    }

    /**
     * @param mixed $forked
     */
    public function setForked($forked): void
    {
        $this->forked = $forked;
    }

    /**
     * @return mixed
     */
    public function getRepoName()
    {
        return $this->repo_name;
    }

    /**
     * @param mixed $repo_name
     */
    public function setRepoName($repo_name): void
    {
        $this->repo_name = $repo_name;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return mixed
     */
    public function getPushedAt()
    {
        return $this->pushed_at;
    }

    /**
     * @param mixed $pushed_at
     */
    public function setPushedAt($pushed_at): void
    {
        $this->pushed_at = $pushed_at;
    }


}