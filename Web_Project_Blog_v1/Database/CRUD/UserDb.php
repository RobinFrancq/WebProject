<?php
//Kopieer deze template en pas deze aan naargelang de benodigde functionaliteit
include_once 'Data/User.php';
include_once 'Database/Connection/DatabaseFactory.php';

class UserDb {

    private static function getConnection() {
        return DatabaseFactory::getDatabase();
    }

    public static function getAll() {
        $result = self::getConnection()->executeSQLQuery("SELECT * FROM Users");
        $resultArray = array();
        for ($index = 0; $index < $result->num_rows; $index++) {
            $databaseRow = $result->fetch_array();
            $new = self::convertRowToObject($databaseRow);
            $resultArray[$index] = $new;
        }
        return $resultArray;
    }

    public static function getUserById($id) {
        $result = self::getConnection()->executeSQLQuery("SELECT * FROM Users WHERE UserID=?", array($id));
        if ($result->num_rows == 1) {
            $databaseRow = $result->fetch_array();
            return self::convertRowToObject($databaseRow);
        } else {
            //Dit is een onmogelijke situatie vermits de UserID primary key is, dus er is iets foutgegaan
            return false;
        }
    }

    public static function insert($user) {
        return self::getConnection()->executeSQLQuery("INSERT INTO Users(voornaam, naam, adresID, email, username, password, isAdmin) VALUES ('?','?',?,'?','?','?','?')", array($user->name, $user->lastname, $user->addressID, $user->email, $user->username, $user->password, $user->isAdmin));
    }

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
        return new User($databaseRow['userID'], $databaseRow['voornaam'], $databaseRow['naam'], $databaseRow['adresID'],  $databaseRow['email'], $databaseRow['username'], $databaseRow['password'], $databaseRow['isAdmin']);
    }
}
