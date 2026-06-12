<?php
class Database {
    private $host; 
    private $port; 
    private $db_name;
    private $username; 
    private $password; 
    public $conn;

   public function __construct() {
    // Lee las variables de entorno de Vercel, si no existen usa valores por defecto locales
    $this->host = getenv('DB_HOST') ? trim(getenv('DB_HOST')) : "localhost";
    $this->port = getenv('DB_PORT') ? (int)getenv('DB_PORT') : 6543;
    $this->db_name = getenv('DB_NAME') ? trim(getenv('DB_NAME')) : "postgres";
    $this->username = getenv('DB_USER') ? trim(getenv('DB_USER')) : "postgres";
    $this->password = getenv('DB_PASSWORD') ? trim(getenv('DB_PASSWORD')) : "VPFKCj6KQg8seIRc";
}

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
