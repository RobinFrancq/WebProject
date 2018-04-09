<?php
//Klasse Comment

class Comment {
    public $commentID;
    public $userID;
    public $text;
    public $rating;
    public $postID;
    public $dateMade;
    public $title;

    public function __construct($commentID, $userID, $text, $rating, $postID, $dateMade, $title) {
        $this->commentID = $commentID;
        $this->userID = $userID;
        $this->text = $text;
        $this->rating = $rating;
        $this->postID = $postID;
        $this->dateMade = $dateMade;
        $this->title = $title;
    }
}
