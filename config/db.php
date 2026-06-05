<?php
class Database {
    private $host = "db.xgmrdapzbtdyiqjdbejk.supabase.co"; 
    private $port = "5432"; 
    private $db_name = "postgres";
    private $username = "postgres"; 
    private $password = "VPFKCj6KQg8seIRc"; 
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name, 
                $this->username, 
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
