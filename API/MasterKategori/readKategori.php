<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include_once '../../Database/db.php';
include_once '../../Controller/KategoriController.php';

$kategoriController = new KategoriController();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo $kategoriController->getAllKategori();
} else {
    echo json_encode(["message" => "Metode request tidak diizinkan"]);
}
?>
