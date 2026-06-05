<?php
class Database {
    private $host = "aws-0-us-east-1.pooler.supabase.com";
    private $port = "5432"; // <-- FORZAMOS EL PUERTO DIRECTO
    private $db_name = "postgres";
    private $username = "postgres.xgmrdapzbtdyiqjdbejk"; // <-- Tu usuario completo del pooler modo session
    private $password = "VPFKCj6KQg8seIRc"; // <-- Pega aquí tu contraseña real de Supabase sin llaves ni corchetes
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            // Conexión directa por PDO usando los datos limpios
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
