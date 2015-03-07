<?php

class User
{
    private $userID;
    private $username;
    private $password;
    private $position;

    public function __construct($username, $password, $position, $userID = NULL){
        $this->userID = $userID;
        $this->username = $username;
        $this->password = $password;
        $this->position = $position;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->username;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function getUserID()
    {
        return $this->userID;
    }
}