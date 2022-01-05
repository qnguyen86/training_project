<?php 

    class Connection{
        public static function getInstance(){

            $conn = new PDO("mysql:host=localhost; dbname=train_database","root","");

            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
            $conn->exec("set names utf8");
            return $conn;
        }
    }
  ?>