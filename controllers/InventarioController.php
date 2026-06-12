<?php
require_once dirname(__DIR__) . '/config/db.php';
require_once dirname(__DIR__) . '/models/Producto.php';

class InventarioController {
    
    // Carga la tabla principal
public function index() {
        $database = new Database();
        $db = $database->getConnection();
        $productoModel = new Producto($db);
        
        $stmt_productos = $productoModel->obtenerTodos();
        
        // Apuntamos directo al nombre real detectado por el escáner
        require_once dirname(__DIR__) . '/views/inventory.php';
    }

    // NUEVO: Carga la vista del formulario HTML
    public function nuevo() {
        // CORREGIDO: Ruta absoluta para el formulario de inserción
        require_once dirname(__DIR__) . '/views/nuevo.php';
    }

    // NUEVO: Recibe los datos del formulario (POST) y los guarda en la BD
    public function guardar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database = new Database();
            $db = $database->getConnection();
            $productoModel = new Producto($db);

            $creado = $productoModel->crear(
                $_POST['codigo_serie'],
                $_POST['nombre'],
                $_POST['categoria'],
                $_POST['stock_actual'],
                $_POST['stock_minimo'],
                $_POST['precio']
            );

            if ($creado) {
                header("Location: index.php?controller=inventario&action=index");
                exit();
            } else {
                echo "<p>Error al guardar el producto. Verifica los datos.</p>";
            }
        }
    }

    // Carga la vista del formulario con los datos actuales del producto
    public function editar() {
        if (isset($_GET['id'])) {
            $database = new Database();
            $db = $database->getConnection();
            $productoModel = new Producto($db);
            
            $producto = $productoModel->obtenerPorId($_GET['id']);
            // CORREGIDO: Ruta absoluta para el formulario de edición
            require_once dirname(__DIR__) . '/views/editar.php';
        } else {
            header("Location: index.php?controller=inventario&action=index");
        }
    }

    // Recibe los datos modificados por POST y actualiza la BD
    public function actualizar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
            $database = new Database();
            $db = $database->getConnection();
            $productoModel = new Producto($db);

            $actualizado = $productoModel->actualizar(
                $_POST['id'],
                $_POST['codigo_serie'],
                $_POST['nombre'],
                $_POST['categoria'],
                $_POST['stock_actual'],
                $_POST['stock_minimo'],
                $_POST['precio']
            );

            if ($actualizado) {
                header("Location: index.php?controller=inventario&action=index");
                exit();
            } else {
                echo "<p>Error al actualizar el producto.</p>";
            }
        }
    }

    // Procesa la eliminación de un producto
    public function eliminar() {
        if (isset($_GET['id'])) {
            $database = new Database();
            $db = $database->getConnection();
            $productoModel = new Producto($db);

            if ($productoModel->eliminar($_GET['id'])) {
                header("Location: index.php?controller=inventario&action=index");
                exit();
            } else {
                echo "<p>Error al eliminar el producto.</p>";
            }
        }
    }
}
?>
