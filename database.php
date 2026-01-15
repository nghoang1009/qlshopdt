<?php
    class DB {
        private $hostname = "localhost";
        private $username = "root";
        private $password = "";
        private $database = "qlshopdienthoai";

        function getConnection() {
            try {
                return mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
            }
            catch (Exception $ex) {
                echo $ex, "<br><br>";
                return false;
            }
        }
    }
?>