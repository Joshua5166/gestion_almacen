<?php
class Producto {
    private $conn;
    private $table_name = "productos";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para obtener todo el catálogo de productos
    public function obtenerTodos() {
        $query = "SELECT id, codigo_serie, nombre, categoria, stock_actual, stock_minimo, precio FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }

    // NUEVO: Método para registrar un nuevo producto
    public function crear($codigo, $nombre, $categoria, $stock_actual, $stock_minimo, $precio) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (codigo_serie, nombre, categoria, stock_actual, stock_minimo, precio) 
                  VALUES (:codigo, :nombre, :categoria, :stock_actual, :stock_minimo, :precio)";
        
        $stmt = $this->conn->prepare($query);

        // Limpiar datos y vincular parámetros (Evita Inyección SQL)
        $stmt->bindParam(":codigo", htmlspecialchars(strip_tags($codigo)));
        $stmt->bindParam(":nombre", htmlspecialchars(strip_tags($nombre)));
        $stmt->bindParam(":categoria", htmlspecialchars(strip_tags($categoria)));
        $stmt->bindParam(":stock_actual", $stock_actual);
        $stmt->bindParam(":stock_minimo", $stock_minimo);
        $stmt->bindParam(":precio", $precio);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Obtener los datos de un solo producto usando su ID
    public function obtenerPorId($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar un producto existente
    public function actualizar($id, $codigo, $nombre, $categoria, $stock_actual, $stock_minimo, $precio) {
        $query = "UPDATE " . $this->table_name . " 
                  SET codigo_serie = :codigo, nombre = :nombre, categoria = :categoria, 
                      stock_actual = :stock_actual, stock_minimo = :stock_minimo, precio = :precio 
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);

        // Limpiar datos
        $stmt->bindParam(":codigo", htmlspecialchars(strip_tags($codigo)));
        $stmt->bindParam(":nombre", htmlspecialchars(strip_tags($nombre)));
        $stmt->bindParam(":categoria", htmlspecialchars(strip_tags($categoria)));
        $stmt->bindParam(":stock_actual", $stock_actual);
        $stmt->bindParam(":stock_minimo", $stock_minimo);
        $stmt->bindParam(":precio", $precio);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    // Eliminar un producto
    public function eliminar($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        
        return $stmt->execute();
    }
    // Calcular el valor total del inventario (Stock * Precio)
    public function obtenerValorizacionTotal() {
        $query = "SELECT SUM(stock_actual * precio) as total_valor FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_valor'] ? $row['total_valor'] : 0;
    }

    // Obtener solo los productos que necesitan reabastecimiento
    public function obtenerStockBajo() {
        $query = "SELECT codigo_serie, nombre, stock_actual, stock_minimo FROM " . $this->table_name . " WHERE stock_actual <= stock_minimo";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>