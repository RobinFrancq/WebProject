<?php
//Klasse User

class Address {
    public $addressID;
    public $postalCode;
    public $city;
    public $streetName;
    public $houseNumber;

    public function __construct($addressID, $postalCode, $city, $streetName, $houseNumber) {
        $this->addressID = $addressID;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->streetName = $streetName;
        $this->houseNumber = $houseNumber;
    }
}
