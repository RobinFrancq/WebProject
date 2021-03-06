<?php

// Klasse User om database objecten om te kunnen zetten naar Address objecten
// en de te gebruiken in de website

class User {
    public $userID;
    public $name;
    public $lastName;
    public $addressID;
    public $email;
    public $username;
    public $password;
    public $isAdmin;

    public function __construct($userID, $name, $lastName, $addressID, $email, $username, $password, $isAdmin) {
        $this->userID = $userID;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->addressID = $addressID;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->isAdmin = $isAdmin;
    }
}
