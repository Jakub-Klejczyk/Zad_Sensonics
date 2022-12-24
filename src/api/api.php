<?php
include "./config.php";

if (isset($_SERVER['HTTP_ORIGIN'])) {
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Credentials: true');
	header('Access-Control-Max-Age: 1000');
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
			header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
	}

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
			header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
	}
	exit(0);
}


$action='';

if (isset($_GET['action'])) {
	
	$action=$_GET['action'];
}

if ($action=='loaddata') {
	
	$stmt = $pdo->query('SELECT * FROM partners');
    $response = array();
    while($row = $stmt->fetch()) {
        array_push($response, ["id" => $row['id'], "nazwa" => $row['nazwa'], "nip" => $row['nip'], "adres" => $row['adres'], "telefon" => $row['telefon'], "mail" => $row['mail']]);
    };
    echo json_encode($response);
 }

if ($action=='addpartner') {
    print_r($_POST);
    $nazwa = $_POST['nazwa'];
    $nip = intval($_POST['nip']);
    $adres = $_POST['adres'];
    $telefon = intval($_POST['telefon']);
    $mail = $_POST['mail'];
	

	$sql = 'INSERT INTO partners(nazwa, nip, adres, telefon, mail) VALUES (:nazwa, :nip, :adres, :telefon, :mail)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nazwa' => $nazwa, 'nip' => $nip, 'adres' => $adres, 'telefon' => $telefon, 'mail' => $mail]);
    
}




header("Content-type: application/json");

die();
?>