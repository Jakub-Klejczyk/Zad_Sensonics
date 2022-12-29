<?php
include "../config.php";
include "../headers.php";



$action='';
$id='';

if (isset($_GET['action'])) {
	
	$action=$_GET['action'];
}

if (isset($_GET['id'])) {
	
	$id=$_GET['id'];
}

if ($action=='loadpartners') {
	
	$stmt = $pdo->query('SELECT * FROM partners ORDER BY id ASC');
    $response = array();
    while($row = $stmt->fetch()) {
        array_push($response, ["id" => $row['id'], "nazwa" => $row['nazwa'], "nip" => $row['nip'], "adres" => $row['adres'], "telefon" => $row['telefon'], "mail" => $row['mail']]);
    };
    echo json_encode($response);
 }

if ($action=='addpartner') {
    
    $nazwa = $_POST['nazwa'];
    $nip = intval($_POST['nip']);
    $adres = $_POST['adres'];
    $telefon = intval($_POST['telefon']);
    $mail = $_POST['mail'];
	

	$sql = 'INSERT INTO partners(nazwa, nip, adres, telefon, mail) VALUES (:nazwa, :nip, :adres, :telefon, :mail)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nazwa' => $nazwa, 'nip' => $nip, 'adres' => $adres, 'telefon' => $telefon, 'mail' => $mail]);
    
}

if ($action=='deletepartner') {
    $sql = 'DELETE FROM partners WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
}

if ($action=='editpartner') {
    $nazwa = $_POST['nazwa'];
    $nip = intval($_POST['nip']);
    $adres = $_POST['adres'];
    $telefon = intval($_POST['telefon']);
    $mail = $_POST['mail'];

    $sql = 'UPDATE partners SET nazwa = :nazwa, nip = :nip, adres = :adres, telefon = :telefon, mail = :mail WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id, 'nazwa' => $nazwa, 'nip' => $nip, 'adres' => $adres, 'telefon' => $telefon, 'mail' => $mail]);

}



header("Content-type: application/json");

die();
?>