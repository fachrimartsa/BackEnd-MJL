<?php

class TrsServisController {
    public function createDetailServis($idTransaksi, $idJenisServis) {
        $conn = (new DB())->getConnection();
        
        $query = "CALL createDetailServis(?, ?)";

        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            return json_encode(["message" => "Terjadi kesalahan saat mempersiapkan query"]);
        }
        
        $stmt->bind_param("ii", $idTransaksi, $idJenisServis);
        
        if ($stmt->execute()) {
            return json_encode(["message" => "Detail berhasil ditambahkan"]);
        } else {
            return json_encode(["message" => "Terjadi kesalahan saat menambahkan detail"]);
        }
    }

    public function createDetailBarang($iTransaksi, $idBarang) {
        $conn = (new DB())->getConnection();
        
        $query = "CALL createDetailBarang(?, ?)";

        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            return json_encode(["message" => "Terjadi kesalahan saat mempersiapkan query"]);
        }
        
        $stmt->bind_param("ii", $idTransaksi, $idBarang);
        
        if ($stmt->execute()) {
            return json_encode(["message" => "Detail berhasil ditambahkan"]);
        } else {
            return json_encode(["message" => "Terjadi kesalahan saat menambahkan detail"]);
        }
    }
}