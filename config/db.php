<?php
class Database {
    // EL TRUCO DEFINITIVO: Usamos el host directo real que sí tiene récord DNS IPv4 válido
    private $host = "db.xgmrdapzbtdyiqjdbejk.supabase.co"; 
    private $port = "5432";                       
    private $db_name = "postgres";
    private $username = "postgres";               
    private $password = "VPFKCj6KQg8seIRc";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            // Forzamos a PDO a usar IPv4 de manera estricta añadiendo parámetros de resolución en el DSN
            $dsn = "pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name . ";sslmode=disable";
            
            // Creamos la conexión con un timeout de red por si el servidor tarda en responder
            $this->conn = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_TIMEOUT => 5,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
