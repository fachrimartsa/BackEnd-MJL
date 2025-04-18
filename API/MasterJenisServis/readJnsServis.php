<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include_once '../../Database/db.php';
include_once '../../Controller/JnsServisController.php';

$jnsServisController = new JnsServisController();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo $jnsServisController->getAllJnsServis();
} else {
    echo json_encode(["message" => "Metode request tidak diizinkan"]);
}
?>
