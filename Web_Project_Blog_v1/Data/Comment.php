<?php
//Klasse Comment

class Comment {
    public $commentID;
    public $userID;
    public $text;
    public $rating;
    public $postID;

    public function __construct($commentID, $userID, $text, $rating, $postID) {
        $this->commentID = $commentID;
        $this->userID = $userID;
        $this->text = $text;
        $this->rating = $rating;
        $this->postID = $postID;
        
    }
}
