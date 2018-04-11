<?php

// Klasse Category om database objecten om te kunnen zetten naar Address objecten
// en de te gebruiken in de website

class Category {
    public $categoryID;
    public $name;

    public function __construct($categoryID, $name) {
        $this->categoryID = $categoryID;
        $this->name = $name;
    }
}
