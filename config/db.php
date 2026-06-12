<?php
class Database {
    // 1. Usamos la IP del Pooler de Supabase
    private $host = "44.216.29.125"; 
    private $port = "6543"; // ¡OBLIGATORIO puerto 6543 para el Pooler!
    
    // 2. Tu base de datos corregida (gracias a tu genial vista de águila)
    private $db_name = "gestion_almacen";
    
    // 3. El formato de usuario que el Pooler exige en modo transacción
    private $username = "postgres.xgmrdapzbtdyiqjdbejk";               
    private $password = "VPFKCj6KQg8seIRc";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            // Construimos el DSN apuntando a la IP y puerto del Pooler
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
