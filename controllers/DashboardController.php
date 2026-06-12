<?php
// Usamos __DIR__ para retroceder una carpeta (salir de controllers) y entrar a config/db.php o models/
require_once dirname(__DIR__) . '/config/db.php';
require_once dirname(__DIR__) . '/models/Producto.php';

class DashboardController {
    public function index() {
        $database = new Database();
        $db = $database->getConnection();
        $productoModel = new Producto($db);

        // Obtenemos los datos clave
        $valorTotal = $productoModel->obtenerValorizacionTotal();
        $stmt_alertas = $productoModel->obtenerStockBajo();

        // Cargamos la vista usando también la ruta absoluta
        require_once dirname(__DIR__) . '/views/dashboard.php';
    }
}
?>
