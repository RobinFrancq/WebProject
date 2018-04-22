<?php

// De klasse CommentDb dat de functionaliteit bevat voor het aanspreken/bewerken 
// van gegevens uit de tabel Comments uit de databank

include_once 'Data/Comment.php';
include_once 'Database/Connection/DatabaseFactory.php';

class CommentDb {

    // getConnection functie die de DatabaseFactory klasse gebruikt om een 
    // databank object aan te maken
    private static function getConnection() {
        return DatabaseFactory::getDatabase();
    }

    // getAll functie die alle Comments uit de databank teruggeeft (in een array)
    public static function getAll() {
        $result = self::getConnection()->executeSQLQuery("SELECT * FROM Comments");
        $resultArray = array();
        for ($index = 0; $index < $result->num_rows; $index++) {
            $databaseRow = $result->fetch_array();
            $new = self::convertRowToObject($databaseRow);
            $resultArray[$index] = $new;
        }
        return $resultArray;
    }

    // getCommentById functie die alle Adressen uit de databank teruggeeft 
    // die een bepaalde id bevatten (in een array)
    public static function getCommentById($id){
        $result = self::getConnection()->executeSQLQuery("SELECT * FROM Comments WHERE CommentID=?", array($id));
       
        if ($result->num_rows == 1) {
            $databaseRow = $result->fetch_array();
            return self::convertRowToObject($databaseRow);
        } else {
            // Dit is een onmogelijke situatie vermits de commentID primary key is, 
            // dus er is vermoedelijk iets foutgegaan
            return false;
        }
    }

    // getCommentsByPostId functie die alle Comments uit de databank teruggeeft 
    // die een bepaalde postID bevatten (in een array)
    public static function getCommentsByPostId($id){
        $result = self::getConnection()->executeSQLQuery("SELECT * FROM Comments WHERE postID=?", array($id));
        $resultArray = array();
        for ($index = 0; $index < $result->num_rows; $index++) {
            $databaseRow = $result->fetch_array();
            $new = self::convertRowToObject($databaseRow);
            $resultArray[$index] = $new;
        }
        return $resultArray;
    }

    // insert functie die aan Comment object zal inserten in de databank
    public static function insert($comment) {
        return self::getConnection()->executeSQLQuery("INSERT INTO Comments(userID, tekst, rating, postID, aanmaakDatum, titel) VALUES ('?','?','?','?','?','?')", array($comment->userID, $comment->text, $comment->rating, $comment->postID, $comment->dateMade, $comment->title));
    }
    
    // convertRowToObject functie die een databaseRow (database Object) zal omzetten
    // naar een Comment object
    protected static function convertRowToObject($databaseRow) {
        return new Comment($databaseRow['commentID'], $databaseRow['userID'], $databaseRow['tekst'], $databaseRow['rating'],  $databaseRow['postID'], $databaseRow['aanmaakDatum'], $databaseRow['titel']);
    }
}
