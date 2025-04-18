<?php

class MekanikController {
    public function createMekanik($nama, $telepon, $status) {
        $conn = (new DB())->getConnection();
        
        $query = "CALL createMekanik(?, ?, ?)";

        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            return json_encode(["message" => "Terjadi kesalahan saat mempersiapkan query"]);
        }
        
        $stmt->bind_param("sss", $nama, $telepon, $status);
        
        if ($stmt->execute()) {
            return json_encode(["message" => "Mekanik berhasil ditambahkan"]);
        } else {
            return json_encode(["message" => "Terjadi kesalahan saat menambahkan mekanik"]);
        }
    }

    public function getAllMekanik() {
        $conn = (new DB())->getConnection();
        
        $query = "CALL getAllMekanik()";

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
                return json_encode(["message" => "Tidak ada mekanik ditemukan"]);
            }
        } else {
            // Mengembalikan pesan error jika query gagal
            return json_encode(["message" => "Terjadi kesalahan saat mengambil data mekanik"]);
        }
    }

    public function getMekanikById($id) {
        $conn = (new DB())->getConnection();
    
        $query = "CALL getMekanikById(?)";
    
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            return json_encode(["message" => "Terjadi kesalahan saat mempersiapkan query"]);
        }
    
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
    
            // Cek apakah data ditemukan
            if ($result->num_rows > 0) {
                $mekanik = $result->fetch_assoc();
                return json_encode($mekanik); // Mengembalikan data mekanik yang ditemukan
            } else {
                return json_encode(["message" => "Tidak ada mekanik ditemukan"]);
            }
        } else {
            return json_encode(["message" => "Terjadi kesalahan saat mengambil data mekanik"]);
        }
    }
    
    public function updateMekanik($id, $nama, $telepon) {
        $conn = (new DB())->getConnection();
        
        $query = "CALL updateMekanik(?, ?, ?)";

        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            return json_encode(["message" => "Terjadi kesalahan saat mempersiapkan query"]);
        }
        
        $stmt->bind_param("iss", $id, $nama, $telepon);
        
        if ($stmt->execute()) {
            return json_encode(["message" => "Mekanik berhasil diperbarui"]);
        } else {
            return json_encode(["message" => "Terjadi kesalahan saat memperbarui mekanik"]);
        }
    }

    public function deleteMekanik($id) {
        $conn = (new DB())->getConnection();
        
        $query = "CALL deleteMekanik(?)";

        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            return json_encode(["message" => "Terjadi kesalahan saat mempersiapkan query"]);
        }
        
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return json_encode(["message" => "Mekanik berhasil dihapus"]);
        } else {
            return json_encode(["message" => "Terjadi kesalahan saat menghapus mekanik"]);
        }
    }
}
?>
