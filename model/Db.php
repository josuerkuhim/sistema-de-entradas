<?php
    class Db{
        public static function getConnection(){
            $host = "Localhost";
            $dbname = "cadastro";
            $user = "root";
            $password = "";

            $connection = mysqli_connect($host, $user, $password, $dbname);

            if($connection){
                return $connection;
            }

            return null;
        }
    }
?>
