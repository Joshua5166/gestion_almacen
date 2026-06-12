<?php
class Database {
    private $host = "aws-0-us-east-1.supabase.co"; // Endpoint directo IPv4 (sin la palabra 'db')
    private $port = "5432";                       // Puerto clásico directo de PostgreSQL
    private $db_name = "postgres";
    private $username = "postgres";               // El usuario limpio, sin puntos ni IDs
    private $password = "VPFKCj6KQg8seIRc";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $dsn = "pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name;
            
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
