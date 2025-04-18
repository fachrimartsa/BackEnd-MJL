<?php

class MobilController {
    public function createMobil($nama, $merek) {
        $conn = (new DB())->getConnection();
        
        $query = "CALL createMobil(?, ?)";

        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            return json_encode(["message" => "Terjadi kesalahan saat mempersiapkan query"]);
        }
        
        $stmt->bind_param("ss", $nama, $merek);
        
        if ($stmt->execute()) {
            return json_encode(["message" => "Barang berhasil ditambahkan"]);
        } else {
            return json_encode(["message" => "Terjadi kesalahan saat menambahkan barang"]);
        }
    }

    public function getAllMobil() {
        $conn = (new DB())->getConnection();
        
        $query = "CALL getAllMobil()";

        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            return json_encode(["message" => "Terjadi kesalahan saat mempersiapkan query"]);
        }

        if ($stmt->execute()) {
            // Menyimpan hasil query
            $result = $stmt->get_result();
            
            // Mengecek apakah ada data
            if ($result->num_rows > 0) {
                $data = [];
                
                // Mengambil semua data hasil query
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
    
                // Mengembalikan data dalam format JSON
                return json_encode($data);
            } else {
                // Mengembalikan pesan jika tidak ada data
                return json_encode(["message" => "Tidak ada mobil ditemukan"]);
            }
        } else {
            // Mengembalikan pesan error jika query gagal
            return json_encode(["message" => "Terjadi kesalahan saat mengambil data mobil"]);
        }
    }

    public function getMobilById($id) {
        $conn = (new DB())->getConnection();
    
        $query = "CALL getMobilById(?)";
    
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            return json_encode(["message" => "Terjadi kesalahan saat mempersiapkan query"]);
        }
    
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
    
            // Cek apakah data ditemukan
            if ($result->num_rows > 0) {
                $mobil = $result->fetch_assoc();
                return json_encode($mobil); 
            } else {
                return json_encode(["message" => "Tidak ada mobil ditemukan"]);
            }
        } else {
            return json_encode(["message" => "Terjadi kesalahan saat mengambil data mobil"]);
        }
    }
    
    public function updateMobil($id, $nama, $merek) {
        $conn = (new DB())->getConnection();
        
        $query = "CALL updateMobil(?, ?, ?)";

        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            return json_encode(["message" => "Terjadi kesalahan saat mempersiapkan query"]);
        }
        
        $stmt->bind_param("iss", $id, $nama, $merek);
        
        if ($stmt->execute()) {
            return json_encode(["message" => "Mobil berhasil diperbarui"]);
        } else {
            return json_encode(["message" => "Terjadi kesalahan saat memperbarui mobil"]);
        }
    }

    public function deleteMobil($id) {
        $conn = (new DB())->getConnection();
        
        $query = "CALL deleteMobil(?)";

        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            return json_encode(["message" => "Terjadi kesalahan saat mempersiapkan query"]);
        }
        
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return json_encode(["message" => "Mobil berhasil dihapus"]);
        } else {
            return json_encode(["message" => "Terjadi kesalahan saat menghapus mobil"]);
        }
    }
}
?>
