<?php

class TokenLinkedln {
    private $token;
    private $exp;

    /**
     * TokenLinkedln constructor.
     * @param $token
     * @param $exp
     */
    public function __construct($token, $exp)
    {
        $this->token = $token;
        $this->exp = $exp;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return mixed
     */
    public function getExp()
    {
        return $this->exp;
    }


}