<?php
//Kopieer deze template en pas deze aan naargelang de benodigde functionaliteit
include_once 'Data/Post.php';
include_once 'CommentDb.php';
include_once 'Database/Connection/DatabaseFactory.php';

class PostDb {

    private static function getConnection() {
        return DatabaseFactory::getDatabase();
    }

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

    public static function getPostById($id){
        $result = self::getConnection()->executeSQLQuery("SELECT * FROM Posts WHERE PostID=?", array($id));
       
        if ($result->num_rows == 1) {
            $databaseRow = $result->fetch_array();
            return self::convertRowToObject($databaseRow);
        } else {
            //Dit is een onmogelijke situatie vermits de PostID primary key is, dus er is iets foutgegaan
            return false;
        }
    }

    public static function get3PopularPostIDs(){
        $result = self::getConnection()->executeSQLQuery("SELECT postID FROM Comments GROUP BY postID ORDER BY COUNT(postID) DESC");
        $resultArray = array();
        for ($index = 0; $index < 3; $index++) {
            
            $databaseRow = $result->fetch_array();
            $new = $databaseRow['postID'];
            $resultArray[$index] = $new;
        }
        return $resultArray;
    }

    public static function getAmountOfCommentsByID($id){
        $result = self::getConnection()->executeSQLQuery("SELECT * FROM Comments WHERE postID=?", array($id));

       if($result->num_rows <= 0){
           return 0;
       }
       else return $result->num_rows;
    }

    /*
    public static function insert($user) {
        return self::getConnection()->executeSQLQuery("INSERT INTO Users(voornaam, naam, adresID, email, username, password, isAdmin) VALUES ('?','?',?,'?','?','?','?')", array($user->name, $user->lastname, $user->addressID, $user->email, $user->username, $user->password, $user->isAdmin));
    }
    */

    /*
    public static function deleteById($id) {
        return self::getVerbinding()->voerSqlQueryUit("DELETE FROM Boek where BoekId=?", array($id));
    }

    public static function delete($boek) {
        return self::deleteById($boek->boekId);
    }

    public static function update($boek) {
        return self::getVerbinding()->voerSqlQueryUit("UPDATE Boek SET Titel='?',Uitgavedatum='?',PrijsExclBtw='?',EmailUitgeverij='?' WHERE BoekId=?", array($boek->titel, $boek->uitgavedatum, $boek->prijsExclBtw, $boek->emailUitgeverij));
    }
    */

    protected static function convertRowToObject($databaseRow) {
        return new Post($databaseRow['postID'], $databaseRow['foto'], $databaseRow['titel'], $databaseRow['categorieID'],  $databaseRow['datum'], $databaseRow['tekst'], $databaseRow['auteurID']);
    }
}
