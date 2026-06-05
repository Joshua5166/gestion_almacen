<?php
require_once 'config/database.php';
require_once 'models/Producto.php';

class DashboardController {
    public function index() {
        $database = new Database();
        $db = $database->getConnection();
        $productoModel = new Producto($db);

        // Obtenemos los datos clave
        $valorTotal = $productoModel->obtenerValorizacionTotal();
        $stmt_alertas = $productoModel->obtenerStockBajo();

        // Cargamos la vista
        require_once 'views/dashboard.php';
    }
}
?>