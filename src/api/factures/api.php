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

if ($action=='loadfactures') {
	
	$stmt = $pdo->query('SELECT factures.id, partners.nazwa, factures.symbol, factures.produkt_liczba, factures.data_wystawienia,
    products.produkt_nazwa, products.cena
    FROM factures
    INNER JOIN partners
    ON factures.kontrahent = partners.id
    INNER JOIN products
    ON factures.produkt_cena = products.id AND factures.produkt = products.id
    ORDER BY factures.id ASC');
    $response = array();
    while($row = $stmt->fetch()) {
        array_push($response, ["id" => $row['id'], "symbol" => $row['symbol'], "kontrahent" => $row['nazwa'], "produkt" => $row['produkt_nazwa'], "cena" => $row['cena'], "liczba" => $row['produkt_liczba'], "data" => $row['data_wystawienia']] );
    };
    echo json_encode($response);
}

if ($action=='loadpartners') {
	
	$stmt = $pdo->query('SELECT id, nazwa FROM partners');
    $response = array();
    while($row = $stmt->fetch()) {
        array_push($response, [ "id" => $row['id'] ,"nazwa" => $row['nazwa']]);
    };
    echo json_encode($response);
}

if ($action=='loadproducts') {
	
	$stmt = $pdo->query('SELECT id, produkt_nazwa FROM products');
    $response = array();
    while($row = $stmt->fetch()) {
        array_push($response, [ "id" => $row['id'] ,"produkt" => $row['produkt_nazwa']]);
    };
    echo json_encode($response);
}

if ($action=='addfacture') {
    
    $symbol = $_POST['symbol'];
    $kontrahent = $_POST['kontrahent'];
    $produkt = $_POST['produkt'];
    $liczba = intval($_POST['liczba']);
    $data = $_POST['data'];

	$sql = 'INSERT INTO factures(symbol, kontrahent, produkt, produkt_cena, produkt_liczba, data_wystawienia) VALUES (:symbol, :kontrahent, :produkt, :produkt, :liczba, :data)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["symbol" => $symbol, "kontrahent" => $kontrahent, "produkt" => $produkt, "liczba" => $liczba, "data" => $data]);
    
}

if ($action=='deletefacture') {
    $sql = 'DELETE FROM factures WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
}

if ($action=='editfacture') {
    $symbol = $_POST['symbol'];
    $kontrahent = $_POST['kontrahent'];
    $produkt = $_POST['produkt'];
    $liczba = intval($_POST['liczba']);
    $data = $_POST['data'];
    
    $sql = 'UPDATE factures SET symbol = :symbol, kontrahent = :kontrahent, produkt = :produkt, produkt_cena = :produkt, produkt_liczba = :produkt_liczba, data_wystawienia = :data WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id, "symbol" => $symbol, "kontrahent" => $kontrahent, "produkt" => $produkt, "produkt_liczba" => $liczba, "data" => $data]);

}




header("Content-type: application/json");

die();
?>