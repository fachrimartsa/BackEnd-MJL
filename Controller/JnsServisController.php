<?php

class JnsServisController {
    public function createJnsServis($nama, $kategori, $waktu, $harga) {
        $conn = (new DB())->getConnection();
        
        $query = "CALL createJnsService(?, ?, ?, ?)";

        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            return json_encode(["message" => "Terjadi kesalahan saat mempersiapkan query"]);
        }
        
        $stmt->bind_param("sisd", $nama, $kategori, $waktu, $harga);
        
        if ($stmt->execute()) {
            return json_encode(["message" => "Jenis servis berhasil ditambahkan"]);
        } else {
            return json_encode(["message" => "Terjadi kesalahan saat menambahkan jenis servis"]);
        }
    }

    public function getAllJnsServis() {
        $conn = (new DB())->getConnection();
        
        $query = "CALL getAllJnsServis()";

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
                return json_encode(["message" => "Tidak ada barang ditemukan"]);
            }
        } else {
            // Mengembalikan pesan error jika query gagal
            return json_encode(["message" => "Terjadi kesalahan saat mengambil data barang"]);
        }
    }

    public function getJnsServisById($id) {
        $conn = (new DB())->getConnection();
    
        $query = "CALL getJenisServisById(?)";
    
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            return json_encode(["message" => "Terjadi kesalahan saat mempersiapkan query"]);
        }
    
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
    
            // Cek apakah data ditemukan
            if ($result->num_rows > 0) {
                $barang = $result->fetch_assoc();
                return json_encode($barang); 
            } else {
                return json_encode(["message" => "Tidak ada barang ditemukan"]);
            }
        } else {
            return json_encode(["message" => "Terjadi kesalahan saat mengambil data barang"]);
        }
    }
    
    public function updateJnsServis($id, $harga, $waktu) {
        $conn = (new DB())->getConnection();
        
        $query = "CALL updateJnsServis(?, ?, ?)";

        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            return json_encode(["message" => "Terjadi kesalahan saat mempersiapkan query"]);
        }
        
        $stmt->bind_param("isd", $id, $waktu, $harga);
        
        if ($stmt->execute()) {
            return json_encode(["message" => "Jenis servis berhasil diperbarui"]);
        } else {
            return json_encode(["message" => "Terjadi kesalahan saat memperbarui jenis servis"]);
        }
    }

    public function deleteJnsServis($id) {
        $conn = (new DB())->getConnection();
        
        $query = "CALL deleteJnsServis(?)";

        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            return json_encode(["message" => "Terjadi kesalahan saat mempersiapkan query"]);
        }
        
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return json_encode(["message" => "Barang berhasil dihapus"]);
        } else {
            return json_encode(["message" => "Terjadi kesalahan saat menghapus barang"]);
        }
    }
}
?>
