<?php
//Klasse database

    class Database {
        protected $hostname;
        protected $username;
        protected $password;
        protected $database;
        protected $connection = null;

        public function __construct($hostname, $username, $password, $database) {
            $this->hostname = $hostname;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;
        }

        public function __destruct() {
            if ($this->connection != null) {
                $this->verbreekVerbindingMetDatabase();
            }
        }

        protected function makeConnection() {
            $this->connection = new mysqli($this->hostname, $this->username, $this->password, $this->database);
            if ($this->connection->connect_error) {
                die("Connect Error (" . $this->connection->connect_errno . ") " . $this->connection->connect_error);
            }
        }

        protected function closeConnection() {
            if ($this->connection != null) {
                $this->connection->close();
                $this->connection = null;
            }
        }

        protected function preventSQLInjection($parameter) {
            $resul = $this->connection->real_escape_string($parameter);
            return $resul;
        }

        public function executeSQLQuery($SQLQuery, $parameterArray = null) {
            return $this->doAdvancedSQLQuery($SQLQuery, true, $parameterArray);
        }

        protected function doAdvancedSQLQuery($SQLQuery, $automaticCloseConnection = true, $parameterArray = null) {
            $this->makeConnection();

            if ($parameterArray != null) {
                //Verander alle vraagtekens in de query door parameterwaarden uit de parameterArray
                $queryParts = preg_split("/\?/", $SQLQuery);
                if (count($queryParts) != count($parameterArray) + 1) {
                    return false;
                }
                $finalQuery = $queryParts[0];
                for ($index = 0; $index < count($parameterArray); $index++) {
                    $finalQuery = $finalQuery . $this->preventSQLInjection($parameterArray[$index]) . $queryParts[$index + 1];
                }
                $SQLQuery = $finalQuery;
            }

            $result = $this->connection->query($SQLQuery);
            if ($automaticCloseConnection) {
                $this->closeConnection();
            }
            return $result;
        }
    }

?>