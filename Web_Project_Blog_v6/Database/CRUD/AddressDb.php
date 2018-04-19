<?php

// De klasse AddressDb dat de functionaliteit bevat voor het aanspreken/bewerken 
// van gegevens uit de tabel Adressen uit de databank

include_once 'Data/Address.php';
include_once 'Database/Connection/DatabaseFactory.php';

class AddressDb {

    // getConnection functie die de DatabaseFactory klasse gebruikt om een 
    // databank object aan te maken
    private static function getConnection() {
        return DatabaseFactory::getDatabase();
    }

    // getAll functie die alle Adressen uit de databank teruggeeft (in een array)
    public static function getAll() {
        $result = self::getConnection()->executeSQLQuery("SELECT * FROM Adressen");
        $resultArray = array();
        for ($index = 0; $index < $result->num_rows; $index++) {
            $databaseRow = $result->fetch_array();
            $new = self::convertRowToObject($databaseRow);
            $resultArray[$index] = $new;
        }
        return $resultArray;
    }

    // getAddressById functie die alle Adressen uit de databank teruggeeft 
    // die een bepaalde id bevatten (in een array)
    public static function getAddressById($id) {
        $result = self::getConnection()->executeSQLQuery("SELECT * FROM Adressen WHERE adresID=?", array($id));
        if ($result->num_rows == 1) {
            $databaseRow = $result->fetch_array();
            return self::convertRowToObject($databaseRow);
        } else {
            // Dit is een onmogelijke situatie vermits de adresID primary key is, 
            // dus er is vermoedelijk iets foutgegaan
            return false;
        }
    }

    // getAddressIdByValues functie die alle Adressen uit de databank teruggeeft 
    // die een bepaalde postcode, gemeente, straatnaam en huisnummer bevatten (in een array)
    public static function getAddressIdByValues($postalCode, $city, $streetname, $housenumber){
        $result = self::getConnection()->executeSQLQuery("SELECT adresID FROM Adressen WHERE postcode=? AND gemeente=? AND straatnaam=? AND huisnummer=?", array($address->postalCode, $address->city, $address->streetName, $address->houseNumber));
        
        // Indien er maar 1 adres werd gevonden zal ook enkel dit adres gereturnt worden
        if ($result->num_rows == 1) {
            $databaseRow = $result->fetch_array();
            $address = self::convertRowToObject($databaseRow);
            return $address;
        } 
        
        // Indien er meerdere adressen worden gevonden zullen deze worden gezet in een array maar zal
        // slechts de eerte index van de array gereturnt worden
        else {
            $resultArray = array();
            for ($index = 0; $index < $result->num_rows; $index++) {
                $databaseRow = $result->fetch_array();
                $new = self::convertRowToObject($databaseRow);
                $resultArray[$index] = $new;
            }
            return $resultArray[0];
        }
    }

    // insert functie die aan Address object zal inserten in de databank
    public static function insert($address) {
        return self::getConnection()->executeSQLQuery("INSERT INTO Adressen(postcode, gemeente, straatnaam, huisnummer) VALUES ('?','?','?','?')", array($address->postalCode, $address->city, $address->streetName, $address->houseNumber));
    }

    // convertRowToObject functie die een databaseRow (database Object) zal omzetten
    // naar een Address object
    protected static function convertRowToObject($databaseRow) {
        return new Address($databaseRow['adresID'], $databaseRow['postcode'], $databaseRow['gemeente'], $databaseRow['straatnaam'],  $databaseRow['huisnummer']);
    }
}
