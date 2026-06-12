<?php
class Database {
    public $conn;

    public function getConnection() {
        $this->conn = null;
        
        // 1. Intentamos leer la URL completa de Vercel (Recomendado)
        $db_url = getenv('DATABASE_URL');

        try {
            if ($db_url) {
                // Limpiamos el prefijo postgresql:// por pgsql:// para que PDO lo entienda
                $db_url = str_replace("postgresql://", "pgsql://", $db_url);
                
                $dbparts = parse_url($db_url);

                $host = $dbparts['host'];
                $port = $dbparts['port'] ?? 5432;
                $dbname = ltrim($dbparts['path'], '/');
                $username = $dbparts['user'];
                $password = $dbparts['pass'];

                // Neon requiere sslmode=require de forma obligatoria
                $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
                $this->conn = new PDO($dsn, $username, $password);
            } else {
                // 2. RESPALDO NUEVO: Si no encuentra variable de entorno, usa los datos del nuevo proyecto
                $host = "ep-patient-sky-atucuhoo-pooler.c-9.us-east-1.aws.neon.tech";
                $port = "5432";
                $dbname = "neondb"; 
                $username = "neondb_owner";
                $password = "npg_VkrHmx5W3Ijv"; 

                $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
                $this->conn = new PDO($dsn, $username, $password);
            }

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
