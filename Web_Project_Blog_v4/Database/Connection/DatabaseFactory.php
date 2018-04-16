<?php
    // De Singleton klasse DatabaseFactory dat een database zal aanmaken door gebruik
    // te maken van de klasse Databank, deze klasse bevat de gegevens voor het 
    // connecteren met de databank 
    
    include_once 'Database.php';

    class DatabaseFactory {
        private static $connection;
        
        public static function getDatabase() {
            if (self::$connection == null) {
                $hostname = "dt5.ehb.be";
                $username = "18WDA063";
                $password = "21945367";
                $database = "18WDA063";
                self::$connection = new Database($hostname, $username, $password, $database);
            }
            return self::$connection;
        }
    }
?>

