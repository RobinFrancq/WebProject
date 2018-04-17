<?php

// Klasse Address om database objecten om te kunnen zetten naar Address objecten
// en de te gebruiken in de website

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
