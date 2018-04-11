<?php

// De klasse CategoryDb dat de functionaliteit bevat voor het aanspreken/bewerken 
// van gegevens uit de tabel Categorieen uit de databank

include_once 'Data/Category.php';
include_once 'Database/Connection/DatabaseFactory.php';

class CategoryDb {

    // getConnection functie die de DatabaseFactory klasse gebruikt om een 
    // databank object aan te maken
    private static function getConnection() {
        return DatabaseFactory::getDatabase();
    }

    // getAll functie die alle Categorieen uit de databank teruggeeft (in een array)
    public static function getAll() {
        $result = self::getConnection()->executeSQLQuery("SELECT * FROM Categorieen");
        $resultArray = array();
        for ($index = 0; $index < $result->num_rows; $index++) {
            $databaseRow = $result->fetch_array();
            $new = self::convertRowToObject($databaseRow);
            $resultArray[$index] = $new;
        }
        return $resultArray;
    }

    // getCategoryById functie die alle Categorieen uit de databank teruggeeft 
    // die een bepaalde id bevatten (in een array)
    public static function getCategoryById($id){
        $result = self::getConnection()->executeSQLQuery("SELECT * FROM Categorieen WHERE categorieID=?", array($id));
       
        if ($result->num_rows == 1) {
            $databaseRow = $result->fetch_array();
            return self::convertRowToObject($databaseRow);
        } else {
            // Dit is een onmogelijke situatie vermits de categorieID primary key is, 
            // dus er is vermoedelijk iets foutgegaan
            return false;
        }
    }

    // convertRowToObject functie die een databaseRow (database Object) zal omzetten
    // naar een Category object
    protected static function convertRowToObject($databaseRow) {
        return new Category($databaseRow['categorieID'], $databaseRow['naam']);
    }
}
