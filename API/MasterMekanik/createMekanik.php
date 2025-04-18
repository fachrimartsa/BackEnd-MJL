<?php
header("Access-Control-Allow-Origin: *");  
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json'); // Set header JSON

include_once '../../Database/db.php';
include_once '../../Controller/MekanikController.php';

$mekanikController = new MekanikController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data JSON yang dikirim dari frontend
    $data = json_decode(file_get_contents("php://input"), true);

    // Cek apakah data yang dibutuhkan ada
    if (isset($data['nama']) && isset($data['telepon']) && isset($data['status'])) {
        $nama = $data['nama'];
        $telepon = $data['telepon'];
        $status = $data['status'];
        
        echo $mekanikController->createMekanik($nama, $telepon, $status);
    } else {
        echo json_encode(["message" => "Data tidak lengkap!"]);
    }
} else {
    echo json_encode(["message" => "Metode request tidak diizinkan"]);
}
?>
