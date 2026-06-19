<?php
class Trabajador {
    private $conn;
    private $table_name = "trabajadores";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todos los trabajadores
    public function obtenerTodos() {
        $query = "SELECT nomina, nombre, area FROM " . $this->table_name . " ORDER BY nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Registrar un nuevo trabajador
    public function crear($nomina, $nombre, $area) {
        $query = "INSERT INTO " . $this->table_name . " (nomina, nombre, area) VALUES (:nomina, :nombre, :area)";
        $stmt = $this->conn->prepare($query);

        $nomina_limpia = (int)$nomina;
        $nombre_limpio = htmlspecialchars(strip_tags($nombre));
        $area_limpia = htmlspecialchars(strip_tags($area));

        $stmt->bindParam(":nomina", $nomina_limpia);
        $stmt->bindParam(":nombre", $nombre_limpio);
        $stmt->bindParam(":area", $area_limpia);

        return $stmt->execute();
    }

    // Obtener un trabajador específico por su nómina
    public function obtenerPorNomina($nomina) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE nomina = :nomina LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nomina", $nomina);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar los datos de un trabajador (Sin cambiar la clave primaria nómina)
    public function actualizar($nomina, $nombre, $area) {
        $query = "UPDATE " . $this->table_name . " SET nombre = :nombre, area = :area WHERE nomina = :nomina";
        $stmt = $this->conn->prepare($query);

        $nombre_limpio = htmlspecialchars(strip_tags($nombre));
        $area_limpia = htmlspecialchars(strip_tags($area));

        $stmt->bindParam(":nombre", $nombre_limpio);
        $stmt->bindParam(":area", $area_limpia);
        $stmt->bindParam(":nomina", $nomina);

        return $stmt->execute();
    }

    // Eliminar un trabajador
    public function eliminar($nomina) {
        $query = "DELETE FROM " . $this->table_name . " WHERE nomina = :nomina";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nomina", $nomina);
        return $stmt->execute();
    }
}
?>
