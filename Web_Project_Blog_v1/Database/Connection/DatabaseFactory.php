<?php
    //Deze file bevat slechts 1 functie om de database aan te maken
    include_once 'Database/Connection/Database.php';

    class DatabaseFactory {
        //Singleton
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

