<?php
class Usuario {
    private $conn;
    private $table_name = "usuarios";

    // El constructor recibe la conexión PDO a la base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para validar las credenciales
    public function autenticar($correo, $password) {
        // Consulta SQL preparada para evitar Inyección SQL
        $query = "SELECT id, nombre, rol, password FROM " . $this->table_name . " WHERE correo = :correo LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();

        // Verificamos si se encontró el correo
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verificamos la contraseña
            if ($password === $row['password']) {
                // Si todo es correcto, devolvemos el arreglo con los datos del usuario
                return $row;
            }
        }
        
        // Retorna falso si el correo no existe o la contraseña está mal
        return false; 
    }
}
?>