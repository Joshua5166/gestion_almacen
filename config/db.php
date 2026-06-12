<?php
class Database {
    public $conn;

    public function getConnection() {
        $this->conn = null;
        
        try {
            // Neon proporciona una URL completa. Si no existe, usamos los parámetros desglosados
            // Copia el string de tu captura ('postgres://neondb_owner:***@ep-quiet-night...')
            $host = "ep-quiet-night-attxplb7.c-9.us-east-1.aws.neon.tech";
            $port = "5432";
            $dbname = "neondb"; // Neon nombra tu base de datos inicial como 'neondb' por defecto
            $username = "neondb_owner";
            $password = "npg_VkrHmx5W3Ij"; // Haz clic en 'Show password' en Neon y pégala aquí

            // DSN estándar para PostgreSQL en Neon con SSL requerido obligatorio
            $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
            
            $this->conn = new PDO($dsn, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
