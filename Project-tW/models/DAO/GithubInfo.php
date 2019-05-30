<?php

class GithubInfo{
    private $language;
    private $forked;
    private $repo_name;
    private $created_at;
    private $updated_at;
    private $pushed_at;


    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    /**
     * @return bool
     */
    public function isForked(): bool
    {
        return $this->forked;
    }

    /**
     * @param bool $forked
     */
    public function setForked(bool $forked): void
    {
        $this->forked = $forked;
    }

    /**
     * @return string
     */
    public function getRepoName(): string
    {
        return $this->repo_name;
    }

    /**
     * @param string $repo_name
     */
    public function setRepoName(string $repo_name): void
    {
        $this->repo_name = $repo_name;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     */
    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    /**
     * @param string $updated_at
     */
    public function setUpdatedAt(string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return string
     */
    public function getPushedAt(): string
    {
        return $this->pushed_at;
    }

    /**
     * @param string $pushed_at
     */
    public function setPushedAt(string $pushed_at): void
    {
        $this->pushed_at = $pushed_at;
    }



}