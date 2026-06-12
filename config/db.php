<?php
class Database {
    public $conn;

    public function getConnection() {
        $this->conn = null;
        
        // 1. Intentamos leer la URI completa de la variable DATABASE_URL de Vercel
        $db_url = getenv('DATABASE_URL');

        try {
            if ($db_url) {
                // Si existe DATABASE_URL (en Vercel), mapeamos el formato postgres:// a pgsql:
                // Ejemplo: postgres://user:pass@host:port/db -> pgsql:host=host;port=port;dbname=db;user=user;password=pass
                $dbparts = parse_url($db_url);

                $host = $dbparts['host'];
                $port = $dbparts['port'] ?? 6543;
                $dbname = ltrim($dbparts['path'], '/');
                $username = $dbparts['user'];
                $password = $dbparts['pass'];

                $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$username;password=$password";
                $this->conn = new PDO($dsn);
            } else {
                // 2. RESPALDO LOCAL: Si estás en localhost y no hay variable de entorno, usa el fallback tradicional
                // IMPORTANTE: Nota cómo el host del pooler REAL lleva tu ID de proyecto al inicio si no usas el genérico
                $host = "xgmrdapzbtdyiqjdbejk.supabase.co"; // Tu host directo tradicional
                $port = 5432; 
                $dbname = "postgres";
                $username = "postgres";
                $password = "VPFKCj6KQg8seIRc";

                $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
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
