<?php
class Database {
    // 1. Mantenemos la IP física que sí saltó el bloqueo de Vercel
    private $host = "44.208.221.186"; 
    private $port = "5432";                       
    
    // 2. ¡EL CAMBIO GANADOR REAL!: Cambiamos al nombre correcto de tu captura
    private $db_name = "gestion_almacen";
    
    // 3. El usuario con el TenantID para que la IP sepa a qué proyecto entrar
    private $username = "postgres.xgmrdapzbtdyiqjdbejk";               
    private $password = "VPFKCj6KQg8seIRc";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            // DSN con la base de datos real: gestion_almacen
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
