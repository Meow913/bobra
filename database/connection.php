<?php

$congig = require_once 'configuration.php';

try {
        $dbh = new PDO('mysql:host=' . $congig['host'] . ';dbname=' . $congig['db_name'] . ';charset=utf8mb4;', $congig['username'], $congig['password']);
            //print "GOOD";
        $dbh ->exec("set names utf8mb4");
        }
    catch (PDOException $e)
    {
        die($e->getMessage());
}
//class Connection {
//    public function Try () {
//        $congig = require_once 'configuration.php';
//        try {
//            $dbh = new PDO('mysql:host=' . $congig['host'] . ';dbname=' . $congig['db_name'] . ';charset=utf8mb4;', $congig['username'], $congig['password']);
//            //print "GOOD";
//            $dbh ->exec("set names utf8mb4");
//        }
//    catch (PDOException $e)
//    {
//        die($e->getMessage());
//    }
//    }
//}
//$dbConnect = new Connection();
//$dbConnect->Try()->try->dbh;
?>


