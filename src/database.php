<?php

$server  ='hac353.encs.concordia.ca:3306';
$username = 'hac353_4';
$password = 'db353eng';
$database = 'hac353_4';


try{
    $conn = new PDO("mysql:host=$server;dbname=$database;",$username,$password);
}catch( PDOException $e){
    die('Connection Failed : '. $e->getMessage());
}



?>