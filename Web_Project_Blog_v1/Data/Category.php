<?php
//Klasse Category

class Category {
    public $categoryID;
    public $name;

    public function __construct($categoryID, $name) {
        $this->categoryID = $categoryID;
        $this->name = $name;
    }
}
