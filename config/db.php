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
            // PLAN B: Forzar el tenant_id dentro del string si el usuario con punto falla
            $dsn = "pgsql:host=44.216.29.125;port=6543;dbname=gestion_almacen;user=postgres;password=VPFKCj6KQg8seIRc;options='--project=xgmrdapzbtdyiqjdbejk'";
            
            $this->conn = new PDO($dsn);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
