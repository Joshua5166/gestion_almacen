<?php
class Database {
    private $host; 
    private $port; 
    private $db_name;
    private $username; 
    private $password; 
    public $conn;

    public function __construct() {
        // 1. Dejamos las variables base limpias de Vercel (o los fallbacks)
        $this->host = getenv('DB_HOST') ? trim(getenv('DB_HOST')) : "aws-0-us-east-1.pooler.supabase.com";
        $this->port = getenv('DB_PORT') ? (int)getenv('DB_PORT') : 6543;
        $this->db_name = getenv('DB_NAME') ? trim(getenv('DB_NAME')) : "postgres";
        $this->username = getenv('DB_USER') ? trim(getenv('DB_USER')) : "postgres"; 
        $this->password = getenv('DB_PASSWORD') ? trim(getenv('DB_PASSWORD')) : "VPFKCj6KQg8seIRc";
    }

    public function getConnection() {
        $this->conn = null;
        try {
            // 2. Usamos el formato de URI para el DSN. 
            // Esto le pasa el usuario, la contraseña, el host, el puerto y la BD en un string directo.
            // Para el Pooler, el formato de usuario REFIERE al Tenant de forma nativa en la URL:
            
            $project_id = "xgmrdapzbtdyiqjdbejk"; // Tu ID de proyecto
            
            // Construimos el DSN usando la estructura: pgsql:host=HOST;port=PORT;dbname=DB;user=USUARIO.ID_PROYECTO;password=PASS
            $dsn = "pgsql:host=" . $this->host . 
                   ";port=" . $this->port . 
                   ";dbname=" . $this->db_name . 
                   ";user=" . $this->username . "." . $project_id . 
                   ";password=" . $this->password; 
            
            // Pasamos un arreglo vacío a PDO ya que las credenciales van incrustadas de forma segura en el DSN
            $this->conn = new PDO($dsn);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
