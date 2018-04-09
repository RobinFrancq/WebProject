<?php
//Klasse Post

class Post {
    public $postID;
    public $photo;
    public $title;
    public $categoryID;
    public $date;
    public $text;
    public $autorID;

    public function __construct($postID, $photo, $title, $categoryID, $date, $text, $autorID) {
        $this->postID = $postID;
        $this->photo = $photo;
        $this->title = $title;
        $this->categoryID = $categoryID;
        $this->date = $date;
        $this->text = $text;
        $this->autorID = $autorID;
    }
}
