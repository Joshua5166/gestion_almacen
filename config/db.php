<?php
class Database {
    private $host; 
    private $port; 
    private $db_name;
    private $username; 
    private $password; 
    public $conn;

    public function __construct() {
        // 1. Cargamos las variables de entorno o fallbacks locales
        $this->host = getenv('DB_HOST') ? trim(getenv('DB_HOST')) : "aws-0-us-east-1.pooler.supabase.com";
        $this->port = getenv('DB_PORT') ? (int)getenv('DB_PORT') : 6543;
        $this->db_name = getenv('DB_NAME') ? trim(getenv('DB_NAME')) : "postgres";
        $this->password = getenv('DB_PASSWORD') ? trim(getenv('DB_PASSWORD')) : "VPFKCj6KQg8seIRc";
        
        // 2. EL CAMBIO CLAVE: El usuario para el Pooler DEBE llevar el ID del proyecto concatenado con un punto
        // Cambiamos "postgres" por "postgres.xgmrdapzbtdyiqjdbejk"
        $base_user = getenv('DB_USER') ? trim(getenv('DB_USER')) : "postgres";
        $this->username = $base_user . ".xgmrdapzbtdyiqjdbejk"; 
    }

    public function getConnection() {
        $this->conn = null;
        try {
            // 3. Añadimos opciones de configuración al DSN para resolver el SNI/Tenant en el Pooler
            $dsn = "pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name . ";options='--string_order=utf8'"; 
            
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
