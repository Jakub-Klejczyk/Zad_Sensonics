<?php

$host = 'localhost';
$user = 'postgres';
$password = '123456';
$dbname = 'zadanie';

//set Data Source Name (DSN)
$dsn = "pgsql:host=$host;port=5432;dbname=$dbname;";

//create a PDO instance
$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

if(!$pdo){
    echo "Error! Nie znaleziono bazy danych"; 
}

?>