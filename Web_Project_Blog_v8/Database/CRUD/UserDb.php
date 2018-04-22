<?php

// De klasse UserDb dat de functionaliteit bevat voor het aanspreken/bewerken 
// van gegevens uit de tabel Users uit de databank

include_once 'Data/User.php';
include_once 'Database/Connection/DatabaseFactory.php';

class UserDb {

    // getConnection functie die de DatabaseFactory klasse gebruikt om een 
    // databank object aan te maken
    private static function getConnection() {
        return DatabaseFactory::getDatabase();
    }

    // getAll functie die alle Users uit de databank teruggeeft (in een array)
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

    // getUserById functie die alle Users uit de databank teruggeeft 
    // die een bepaalde id bevatten (in een array)
    public static function getUserById($id) {
        $result = self::getConnection()->executeSQLQuery("SELECT * FROM Users WHERE userID=?", array($id));
        if ($result->num_rows == 1) {
            $databaseRow = $result->fetch_array();
            return self::convertRowToObject($databaseRow);
        } else {
            // Dit is een onmogelijke situatie vermits de userID primary key is, 
            // dus er is vermoedelijk iets foutgegaan
            return false;
        }
    }
    
    // insert functie die aan User object zal inserten in de databank
    public static function insert($user) {
        $hashPass = password_hash($user->password, PASSWORD_DEFAULT);
        return self::getConnection()->executeSQLQuery("INSERT INTO Users(voornaam, naam, adresID, email, username, password, isAdmin) VALUES ('?','?','?','?','?','?','?')", array($user->name, $user->lastName, $user->addressID, $user->email, $user->username, $hashPass, $user->isAdmin));
    }

    //...
    public static function insertWithAddress($user, $address){

    }

    // checkUserDetails functie zal de username en password vergelijken met 
    // de usernames en passwords uit de databank en true of false returnen
    // naar gelang de juistheid van de meegegeven gegevens
    public static function checkUserDetails($username, $password){
       $allUsers = self::getAll();
       foreach($allUsers as $user){
           if($username == $user->username){
                if(password_verify($password, $user->password)){
                    return $user->userID;
                }
           }
       }
       return false;
    }

    // convertRowToObject functie die een databaseRow (database Object) zal omzetten
    // naar een User object
    protected static function convertRowToObject($databaseRow) {
        return new User($databaseRow['userID'], $databaseRow['voornaam'], $databaseRow['naam'], $databaseRow['adresID'],  $databaseRow['email'], $databaseRow['username'], $databaseRow['password'], $databaseRow['isAdmin']);
    }
}
