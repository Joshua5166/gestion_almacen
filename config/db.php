<?php
class Database {
    private $host; 
    private $port; 
    private $db_name;
    private $username; 
    private $password; 
    public $conn;

    public function __construct() {
        // Lee las variables de entorno de Vercel tal cual vienen, con fallbacks limpios
        $this->host = getenv('DB_HOST') ? trim(getenv('DB_HOST')) : "aws-0-us-east-1.pooler.supabase.com";
        $this->port = getenv('DB_PORT') ? (int)getenv('DB_PORT') : 6543;
        $this->db_name = getenv('DB_NAME') ? trim(getenv('DB_NAME')) : "postgres";
        $this->username = getenv('DB_USER') ? trim(getenv('DB_USER')) : "postgres.xgmrdapzbtdyiqjdbejk"; 
        $this->password = getenv('DB_PASSWORD') ? trim(getenv('DB_PASSWORD')) : "VPFKCj6KQg8seIRc";
    }

    public function getConnection() {
        $this->conn = null;
        try {
            // DSN limpio
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
