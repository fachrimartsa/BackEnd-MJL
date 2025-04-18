<?php
header("Access-Control-Allow-Origin: *");  
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json'); // Set header JSON

include_once '../../Database/db.php';
include_once '../../Controller/MobilController.php';

$mobilController = new MobilController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data JSON yang dikirim dari frontend
    $data = json_decode(file_get_contents("php://input"), true);

    // Cek apakah data yang dibutuhkan ada
    if (isset($data['id']) && isset($data['nama']) && isset($data['merek'])) {
        $id = $data['id'];
        $nama = $data['nama'];
        $merek = $data['merek'];
        
        echo $mobilController->updateMobil( $id, $nama, $merek);
    } else {
        echo json_encode(["message" => "Data tidak lengkap!"]);
    }
} else {
    echo json_encode(["message" => "Metode request tidak diizinkan"]);
}
?>
