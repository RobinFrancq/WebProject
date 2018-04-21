<?php

// De klasse PostDb dat de functionaliteit bevat voor het aanspreken/bewerken 
// van gegevens uit de tabel Posts uit de databank

include_once 'Data/Post.php';
include_once 'CommentDb.php';
include_once 'Database/Connection/DatabaseFactory.php';

class PostDb {

    // getConnection functie die de DatabaseFactory klasse gebruikt om een 
    // databank object aan te maken
    private static function getConnection() {
        return DatabaseFactory::getDatabase();
    }

    // getAll functie die alle Posts uit de databank teruggeeft (in een array)
    public static function getAll() {
        $result = self::getConnection()->executeSQLQuery("SELECT * FROM Posts");
        $resultArray = array();
        for ($index = 0; $index < $result->num_rows; $index++) {
            $databaseRow = $result->fetch_array();
            $new = self::convertRowToObject($databaseRow);
            $resultArray[$index] = $new;
        }
        return $resultArray;
    }

    // getAllOrderOnDate functie die alle Posts uit de databank teruggeeft (in een array)
    // geordent volgens datum (meest recent naar minst recent)
    public static function getAllOrderOnDate() {
        $result = self::getConnection()->executeSQLQuery("SELECT * FROM Posts ORDER BY datum DESC");
        $resultArray = array();
        for ($index = 0; $index < $result->num_rows; $index++) {
            $databaseRow = $result->fetch_array();
            $new = self::convertRowToObject($databaseRow);
            $resultArray[$index] = $new;
        }
        return $resultArray;
    }

    // getAllDates functie die alle post data uit de databank teruggeeft (in een array)
    // geordent volgens datum (minst recent naar meest recent)
    public static function getAllDates(){
        $result = self::getConnection()->executeSQLQuery("SELECT datum FROM Posts ORDER BY datum");
        $resultArray = array();
        for ($index = 0; $index < $result->num_rows; $index++) {
            $databaseRow = $result->fetch_array();
            $new = $databaseRow['datum'];
            $resultArray[$index] = $new;
        }
        return $resultArray;
    }

    // getPostById functie die alle Posts uit de databank teruggeeft 
    // die een bepaalde id bevatten (in een array)
    public static function getPostById($id){
        $result = self::getConnection()->executeSQLQuery("SELECT * FROM Posts WHERE PostID=?", array($id));
       
        if ($result->num_rows == 1) {
            $databaseRow = $result->fetch_array();
            return self::convertRowToObject($databaseRow);
        } else {
            // Dit is een onmogelijke situatie vermits de postID primary key is, 
            // dus er is vermoedelijk iets foutgegaan
            return false;
        }
    }

    public static function getPostByCategory($id){
        $result = self::getConnection()->executeSQLQuery("SELECT * FROM Posts WHERE categorieID=?", array($id));
        $resultArray = array();
        for ($index = 0; $index < $result->num_rows; $index++) {
            $databaseRow = $result->fetch_array();
            $new = self::convertRowToObject($databaseRow);
            $resultArray[$index] = $new;
        }
        return $resultArray;
    }

    public static function getPostsByMonth($month){
        $result = self::getConnection()->executeSQLQuery("SELECT * FROM Posts WHERE MONTH(datum) = ?", array($month));
        $resultArray = array();
        for ($index = 0; $index < $result->num_rows; $index++) {
            $databaseRow = $result->fetch_array();
            $new = self::convertRowToObject($databaseRow);
            $resultArray[$index] = $new;
        }
        return $resultArray;
    }

    // get3PostsWithSameCategory functie gaat 3 posts terug geven die dezelfde categorieID bevat als 
    // de meegegeven categoryId, daarnaast wordt de post met dezelfde is als de meegegeven id 
    // genegeerd. De posts worden gereturnt in een array
    public static function get3PostsWithSameCategory($categoryId, $postId){
        $result = self::getConnection()->executeSQLQuery("SELECT * FROM Posts WHERE categorieID=? AND postID!=?", array($categoryId, $postId));
        $resultArray = array();

        // Indien er geen post werd gevonden zal een lege array worden gereturnt
        if ($result->num_rows == 0){
            return $resultArray;
        }

        // Indien er 1 post werd gevonden zal deze worden gereturnt in een array
        else if ($result->num_rows == 1){
            for ($index = 0; $index < 1; $index++) {
                $databaseRow = $result->fetch_array();
                $new =self::convertRowToObject($databaseRow);
                $resultArray[$index] = $new;
            }
            return $resultArray;
        }

        // Indien er 2 posts werden gevonden zullen deze worden gereturnt in een array
        else if ($result->num_rows == 2){
            for ($index = 0; $index < 2; $index++) {
                $databaseRow = $result->fetch_array();
                $new = self::convertRowToObject($databaseRow);
                $resultArray[$index] = $new;
            }
            return $resultArray;
        }

        // Indien er 3 posts werden gevonden zullen deze worden gereturnt in een array
        // Indien er meer dan 3 posts werden gevonden zal nog steeds een array van 3 posts 
        // worden gereturnt vermits er maximaal 3 posts mogen gereturnt worden
        else{
            for ($index = 0; $index < 3; $index++) {
                $databaseRow = $result->fetch_array();
                $new = self::convertRowToObject($databaseRow);
                $resultArray[$index] = $new;
            }
            return $resultArray;
        }
    }

    // get3PopularPostIDs functie gaat 3 posts terug geven die de meeste comments bevat
    // De posts worden gereturnt in een array
    public static function get3PopularPostIDs(){
        $result = self::getConnection()->executeSQLQuery("SELECT postID FROM Comments GROUP BY postID ORDER BY COUNT(postID) DESC");
        $resultArray = array();
        
        // Indien er geen post werd gevonden zal een lege array worden gereturnt
        if ($result->num_rows == 0){
            return $resultArray;
        }

        // Indien er 1 post werd gevonden zal deze worden gereturnt in een array
        else if ($result->num_rows == 1){
            for ($index = 0; $index < 1; $index++) {
                $databaseRow = $result->fetch_array();
                $new = $databaseRow['postID'];
                $resultArray[$index] = $new;
            }
            return $resultArray;
        }

        // Indien er 2 posts werden gevonden zullen deze worden gereturnt in een array
        else if ($result->num_rows == 2){
            for ($index = 0; $index < 2; $index++) {
                $databaseRow = $result->fetch_array();
                $new = $databaseRow['postID'];
                $resultArray[$index] = $new;
            }
            return $resultArray;
        }

        // Indien er 3 posts werden gevonden zullen deze worden gereturnt in een array
        // Indien er meer dan 3 posts werden gevonden zal nog steeds een array van 3 posts 
        // worden gereturnt vermits er maximaal 3 posts mogen gereturnt worden
        else{
            for ($index = 0; $index < 3; $index++) {
                $databaseRow = $result->fetch_array();
                $new = $databaseRow['postID'];
                $resultArray[$index] = $new;
            }
            return $resultArray;
        }
    }

    // get3RandomPosts functie gaat 3 random posts terug geven
    // De posts worden gereturnt in een array
    public static function get3RandomPosts(){
        $result = self::getConnection()->executeSQLQuery("SELECT * FROM Posts WHERE MONTH(datum) = MONTH(NOW())");
        $resultArray = array();

        // Indien er geen post werd gevonden zal een lege array worden gereturnt
        if ($result->num_rows == 0){
            return $resultArray;
        }

        // Indien er 1 post werd gevonden zal deze worden gereturnt in een array
        if ($result->num_rows == 1){
            for ($index = 0; $index < 1; $index++) {
                $databaseRow = $result->fetch_array();
                $new = self::convertRowToObject($databaseRow);
                $resultArray[$index] = $new;
            }
            return $resultArray;
        }

        // Indien er 2 posts werden gevonden zullen deze worden gereturnt in een array
        else if ($result->num_rows == 2){
            for ($index = 0; $index < 2; $index++) {
                $databaseRow = $result->fetch_array();
                $new = self::convertRowToObject($databaseRow);
                $resultArray[$index] = $new;
            }
            return $resultArray;
        }

        // Indien er 3 posts werden gevonden zullen deze worden gereturnt in een array
        // Indien er meer dan 3 posts werden gevonden zal nog steeds een array van 3 posts 
        // worden gereturnt vermits er maximaal 3 posts mogen gereturnt worden
        else{
            for ($index = 0; $index < 3; $index++) {
                $databaseRow = $result->fetch_array();
                $new = self::convertRowToObject($databaseRow);
                $resultArray[$index] = $new;
            }
            return $resultArray;
        }
    }

    // getAmountOfCommentsByID functie geeft het aantal comments terug van een meegegeven postID
    public static function getAmountOfCommentsByID($id){
        $result = self::getConnection()->executeSQLQuery("SELECT * FROM Comments WHERE postID=?", array($id));

        // Indien er geen comments worden gevonden zal het cijfer 0 worden gereturnt
        if($result->num_rows <= 0){
           return 0;
        }
        else return $result->num_rows;
    }

    // insert functie die aan Post object zal inserten in de databank
    public static function insert($post) {
        return self::getConnection()->executeSQLQuery("INSERT INTO Posts(foto, titel, categorieID, datum, tekst, auteurID) VALUES ('?','?','?','?','?','?')", array($post->photo, $post->title, $post->categoryID, $post->date, $post->text, $post->autorID));
    }
    
    public static function deleteById($id) {
        return self::getConnection()->executeSQLQuery("DELETE FROM Posts where postID=?", array($id));
    }

    /*
    public static function delete($boek) {
        return self::deleteById($boek->boekId);
    }

    public static function update($boek) {
        return self::getVerbinding()->voerSqlQueryUit("UPDATE Boek SET Titel='?',Uitgavedatum='?',PrijsExclBtw='?',EmailUitgeverij='?' WHERE BoekId=?", array($boek->titel, $boek->uitgavedatum, $boek->prijsExclBtw, $boek->emailUitgeverij));
    }
    */

    // convertRowToObject functie die een databaseRow (database Object) zal omzetten
    // naar een Post object
    protected static function convertRowToObject($databaseRow) {
        return new Post($databaseRow['postID'], $databaseRow['foto'], $databaseRow['titel'], $databaseRow['categorieID'],  $databaseRow['datum'], $databaseRow['tekst'], $databaseRow['auteurID']);
    }
}
