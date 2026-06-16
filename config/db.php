<?php
// CORREGIDO: session_start() eliminado. Se controla globalmente desde el index.php.

class Database {
    // Ajusta estas credenciales con tus variables de entorno o datos de Neon
    private $host = "ep-cool-shadow-a5abcde.us-east-1.aws.neon.tech"; 
    private $db_name = "gestion_almacen";
    private $username = "neondb_owner";
    private $password = "tu_password_secreto";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            // Habilitamos SSL obligatorio para la infraestructura de Neon
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8",
                $this->username,
                $this->password,
                [PDO::MYSQL_ATTR_SSL_CA => true]
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            header('Content-Type: application/json');
            echo json_encode(["error" => "Error de conexión: " . $exception->getMessage()]);
            exit();
        }
        return $this->conn;
    }
}
?>
