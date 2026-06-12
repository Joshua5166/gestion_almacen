<?php
// Usamos la ruta directa desde la raíz del proyecto. 
// Si en tu index.php definiste ROOT_PATH, puedes usar: require_once ROOT_PATH . 'config/db.php';
require_once 'config/db.php';
require_once 'models/Producto.php';

class DashboardController {
    public function index() {
        $database = new Database();
        $db = $database->getConnection();
        $productoModel = new Producto($db);

        // Obtenemos los datos clave
        $valorTotal = $productoModel->obtenerValorizacionTotal();
        $stmt_alertas = $productoModel->obtenerStockBajo();

        // Cargamos la vista de forma limpia
        require_once 'views/dashboard.php';
    }
}
?>
