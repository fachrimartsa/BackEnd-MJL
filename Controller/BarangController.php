<?php

class BarangController {
    public function createBarang($nama, $jenis, $harga, $stok) {
        $conn = (new DB())->getConnection();
        
        $query = "CALL createBarang(?, ?, ?, ?)";

        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            return json_encode(["message" => "Terjadi kesalahan saat mempersiapkan query"]);
        }
        
        $stmt->bind_param("ssdi", $nama, $jenis, $harga, $stok);
        
        if ($stmt->execute()) {
            return json_encode(["message" => "Barang berhasil ditambahkan"]);
        } else {
            return json_encode(["message" => "Terjadi kesalahan saat menambahkan barang"]);
        }
    }

    public function getAllBarang() {
        $conn = (new DB())->getConnection();
        
        $query = "CALL getAllBarang()";

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

    public function getBarangById($id) {
        $conn = (new DB())->getConnection();
    
        $query = "CALL getBarangById(?)";
    
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

    public function getBarangByJenis($jenis) {
        $conn = (new DB())->getConnection();
    
        $query = "CALL getBarangByJenis(?)";
    
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            return json_encode(["message" => "Terjadi kesalahan saat mempersiapkan query"]);
        }
    
        $stmt->bind_param("s", $jenis);
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
    
            // Cek apakah data ditemukan
            if ($result->num_rows > 0) {
                $barang = $result->fetch_assoc();
                return json_encode([$barang]); 
            } else {
                return json_encode(["message" => "Tidak ada barang ditemukan"]);
            }
        } else {
            return json_encode(["message" => "Terjadi kesalahan saat mengambil data barang"]);
        }
    }
    
    public function updateBarang($id, $nama, $jenis, $harga, $stok) {
        $conn = (new DB())->getConnection();
        
        $query = "CALL updateBarang(?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            return json_encode(["message" => "Terjadi kesalahan saat mempersiapkan query"]);
        }
        
        $stmt->bind_param("issdi", $id, $nama, $jenis, $harga, $stok);
        
        if ($stmt->execute()) {
            return json_encode(["message" => "Barang berhasil diperbarui"]);
        } else {
            return json_encode(["message" => "Terjadi kesalahan saat memperbarui barang"]);
        }
    }

    public function deleteBarang($id) {
        $conn = (new DB())->getConnection();
        
        $query = "CALL deleteBarang(?)";

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
