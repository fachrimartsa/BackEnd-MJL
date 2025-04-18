<?php
class DB {
    private $host = 'localhost';
    private $db_name = 'db_mjl';
    private $username = 'root';
    private $password = '';
    public $conn;

    // Fungsi untuk mendapatkan koneksi ke database
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return $this->conn;
    }
}
?>
