<?php
//Kopieer deze template en pas deze aan naargelang de benodigde functionaliteit
include_once 'Data/Address.php';
include_once 'Database/Connection/DatabaseFactory.php';

class AddressDb {

    private static function getConnection() {
        return DatabaseFactory::getDatabase();
    }

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

    public static function getAddressById($id) {
        $result = self::getConnection()->executeSQLQuery("SELECT * FROM Adressen WHERE adresID=?", array($id));
        if ($result->num_rows == 1) {
            $databaseRow = $result->fetch_array();
            return self::convertRowToObject($databaseRow);
        } else {
            //Dit is een onmogelijke situatie vermits de UserID primary key is, dus er is iets foutgegaan
            return false;
        }
    }

    public static function getAddressIdByValues($postalCode, $city, $streetname, $housenumber){
        $result = self::getConnection()->executeSQLQuery("SELECT adresID FROM Adressen WHERE postcode=? AND gemeente=? AND straatnaam=? AND huisnummer=?", array($address->postalCode, $address->city, $address->streetName, $address->houseNumber));
        if ($result->num_rows == 1) {
            $databaseRow = $result->fetch_array();
            $address = self::convertRowToObject($databaseRow);
            return $address;
        } else {
            $resultArray = array();
            for ($index = 0; $index < $result->num_rows; $index++) {
                $databaseRow = $result->fetch_array();
                $new = self::convertRowToObject($databaseRow);
                $resultArray[$index] = $new;
            }
            return $resultArray[0];
        }
    }

    public static function insert($address) {
        return self::getConnection()->executeSQLQuery("INSERT INTO Adressen(postcode, gemeente, straatnaam, huisnummer) VALUES ('?','?','?','?')", array($address->postalCode, $address->city, $address->streetName, $address->houseNumber));
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
        return new Address($databaseRow['adresID'], $databaseRow['postcode'], $databaseRow['gemeente'], $databaseRow['straatnaam'],  $databaseRow['huisnummer']);
    }
}
