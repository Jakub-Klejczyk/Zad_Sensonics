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

if ($action=='loadproducts') {
	
	$stmt = $pdo->query('SELECT * FROM products');
    $response = array();
    while($row = $stmt->fetch()) {
        array_push($response, ["id" => $row['id'], "nazwa" => $row['nazwa'], "cena" => $row['cena'], "symbol" => $row['symbol']]);
    };
    echo json_encode($response);
 }

if ($action=='addproduct') {
    
    $nazwa = $_POST['nazwa'];
    $cena = intval($_POST['cena']);
    $symbol = $_POST['symbol'];

	$cena = number_format((float)$cena, 2, '.', '');
    

	$sql = 'INSERT INTO products(nazwa, cena, symbol) VALUES (:nazwa, :cena, :symbol)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["nazwa" => $nazwa, "cena" => $cena, "symbol" => $symbol]);
    
}

if ($action=='deleteproduct') {
    $sql = 'DELETE FROM products WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
}

if ($action=='editproduct') {
    $nazwa = $_POST['nazwa'];
    $cena = intval($_POST['cena']);
    $symbol = $_POST['symbol'];
    
    $sql = 'UPDATE products SET nazwa = :nazwa, cena = :cena, symbol = :symbol WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id, 'nazwa' => $nazwa, 'cena' => $sformatowanaCena, 'symbol' => $symbol]);

}




header("Content-type: application/json");

die();
?>