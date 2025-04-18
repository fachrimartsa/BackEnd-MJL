<?php

class KategoriController {
    public function createKategori($nama) {
        $conn = (new DB())->getConnection();
        
        $query = "CALL createKategori(?)";
        
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            return json_encode(["message" => "Terjadi kesalahan saat mempersiapkan query"]);
        }
    
        $stmt->bind_param("s", $nama);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result(); // Ambil hasil dari stored procedure
            
            if ($result) {
                $row = $result->fetch_assoc();
                $id = $row['result']; // Ambil ID terakhir yang dikembalikan dari SP
                
                return json_encode([
                    "message" => "Kategori berhasil ditambahkan",
                    "ktg_id" => $id
                ]);
            }
        }
        
        return json_encode(["message" => "Terjadi kesalahan saat menambahkan kategori"]);
    }
    

    public function createDetail($idMobil, $idKategori) {
        $conn = (new DB())->getConnection();
        
        $query = "CALL createDetailMobil(?, ?)";

        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            return json_encode(["message" => "Terjadi kesalahan saat mempersiapkan query"]);
        }
        
        $stmt->bind_param("ii", $idMobil, $idKategori);
        
        if ($stmt->execute()) {
            return json_encode(["message" => "Detail berhasil ditambahkan"]);
        } else {
            return json_encode(["message" => "Terjadi kesalahan saat menambahkan detail"]);
        }
    }

    public function getAllKategori() {
        $conn = (new DB())->getConnection();
        
        $query = "CALL getAllKategori()";

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
                return json_encode(["message" => "Tidak ada kategori ditemukan"]);
            }
        } else {
            // Mengembalikan pesan error jika query gagal
            return json_encode(["message" => "Terjadi kesalahan saat mengambil data kategori"]);
        }
    }

    public function getKategoriById($id) {
        $conn = (new DB())->getConnection();
    
        $query = "CALL getKategoriById(?)";
    
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            return json_encode(["message" => "Terjadi kesalahan saat mempersiapkan query"]);
        }
    
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
    
            // Cek apakah data ditemukan
            if ($result->num_rows > 0) {
                $kategori = $result->fetch_assoc();
                return json_encode($kategori); 
            } else {
                return json_encode(["message" => "Tidak ada kategori ditemukan"]);
            }
        } else {
            return json_encode(["message" => "Terjadi kesalahan saat mengambil data kategori"]);
        }
    }

    public function getDetailById($id) {
        $conn = (new DB())->getConnection();
    
        $query = "CALL getDetailById(?)";
    
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            return json_encode(["message" => "Terjadi kesalahan saat mempersiapkan query"]);
        }
    
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                $data = [];
    
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
    
                return json_encode($data);
            } else {
                return json_encode(["message" => "Tidak ada detail ditemukan"]);
            }
        } else {
            return json_encode(["message" => "Terjadi kesalahan saat mengambil data detail"]);
        }
    }

    public function deleteKategori($id) {
        $conn = (new DB())->getConnection();
        
        $query = "CALL deleteKategori(?)";

        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            return json_encode(["message" => "Terjadi kesalahan saat mempersiapkan query"]);
        }
        
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return json_encode(["message" => "kategori berhasil dihapus"]);
        } else {
            return json_encode(["message" => "Terjadi kesalahan saat menghapus kategori"]);
        }
    }
}
?>
