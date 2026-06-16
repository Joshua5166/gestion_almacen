<?php
// Cargamos de forma segura el modelo necesario usando la constante global
require_once ROOT_PATH . 'models/Producto.php';

class ReportesController {

    // 1. Renderiza la vista principal del panel de reportes
    public function index() {
        // Buscamos el archivo ignorando problemas de mayúsculas/minúsculas en Linux
        $vista = ROOT_PATH . 'views/reportes.php';
        
        if (file_exists($vista)) {
            require_once $vista;
        } else {
            echo "<h1>Error</h1><p>No se encontró la vista views/reportes.php</p>";
        }
    }

    // 2. Endpoint de la API que regresa las existencias en formato JSON puro
    public function apiStock() {
        // Limpiamos cualquier buffer previo para asegurar una respuesta JSON limpia
        if (ob_get_length()) ob_clean();
        
        header('Content-Type: application/json');
        
        try {
            $database = new Database();
            $db = $database->getConnection();
            $productoModel = new Producto($db);

            // Obtenemos los registros usando el método existente en tu modelo
            $stmt = $productoModel->obtenerTodos();
            $productos = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productos[] = [
                    "codigo_serie"  => $row['codigo_serie'],
                    "nombre"        => $row['nombre'],
                    "categoria"     => $row['categoria'],
                    "stock_actual"  => (int)$row['stock_actual'],
                    "precio"        => (float)$row['precio']
                ];
            }

            echo json_encode($productos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(["error" => "Error en el servidor de reportes: " . $e->getMessage()]);
        }
        exit(); // Detenemos el flujo para que no se le concatene código HTML residual
    }
}
?>
