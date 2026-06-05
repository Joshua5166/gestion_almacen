<?php
class Database {
    private $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            // Esta es la URI oficial calculada directamente con los datos de tu proyecto.
            // REEMPLAZA únicamente lo que está dentro de las llaves por tu contraseña real (borra también las llaves {}).
            $db_url = "postgresql://postgres.xgmrdapzbtdyiqjdbejk:{VPFKCj6KQg8seIRc}@aws-0-us-east-1.pooler.supabase.com:5432/postgres";

            // Parseamos la URL de forma automática para extraer los datos limpios
            $dbparsed = parse_url($db_url);

            $host = $dbparsed["host"];
            $port = $dbparsed["port"];
            $user = $dbparsed["user"];
            $pass = $dbparsed["pass"];
            $dbname = ltrim($dbparsed["path"], "/");

            // Conexión PDO optimizada para evitar los bloqueos de IPv6 de Vercel
            $this->conn = new PDO(
                "pgsql:host=$host;port=$port;dbname=$dbname", 
                $user, 
                $pass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_PERSISTENT => false // Cierra conexiones muertas para que no se sature Supabase
                ]
            );
            
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
