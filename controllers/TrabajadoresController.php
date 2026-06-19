<?php
require_once ROOT_PATH . 'models/Trabajador.php';

class TrabajadoresController {

    // Listar todos los trabajadores
    public function index() {
        $database = new Database();
        $db = $database->getConnection();
        $trabajadorModel = new Trabajador($db);

        $stmt_trabajadores = $trabajadorModel->obtenerTodos();
        require_once ROOT_PATH . 'views/trabajadores.php';
    }

    // Mostrar formulario de registro
    public function nuevo() {
        require_once ROOT_PATH . 'views/nuevo_trabajador.php';
    }

    // Guardar el registro en la BD
    public function guardar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $database = new Database();
            $db = $database->getConnection();
            $trabajadorModel = new Trabajador($db);

            $creado = $trabajadorModel->crear($_POST['nomina'], $_POST['nombre'], $_POST['area']);

            if ($creado) {
                header("Location: index.php?controller=trabajadores&action=index");
                exit();
            } else {
                echo "<p>Error al registrar al trabajador. Asegúrate que la nómina no esté duplicada.</p>";
            }
        }
    }

    // Mostrar formulario de edición
    public function editar() {
        if (isset($_GET['id'])) {
            $database = new Database();
            $db = $database->getConnection();
            $trabajadorModel = new Trabajador($db);

            $trabajador = $trabajadorModel->obtenerPorNomina($_GET['id']);
            require_once ROOT_PATH . 'views/editar_trabajador.php';
        } else {
            header("Location: index.php?controller=trabajadores&action=index");
        }
    }

    // Actualizar registro en la BD
    public function actualizar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nomina'])) {
            $database = new Database();
            $db = $database->getConnection();
            $trabajadorModel = new Trabajador($db);

            $actualizado = $trabajadorModel->actualizar($_POST['nomina'], $_POST['nombre'], $_POST['area']);

            if ($actualizado) {
                header("Location: index.php?controller=trabajadores&action=index");
                exit();
            } else {
                echo "<p>Error al actualizar los datos.</p>";
            }
        }
    }

    // Eliminar registro
    public function eliminar() {
        if (isset($_GET['id'])) {
            $database = new Database();
            $db = $database->getConnection();
            $trabajadorModel = new Trabajador($db);

            if ($trabajadorModel->eliminar($_GET['id'])) {
                header("Location: index.php?controller=trabajadores&action=index");
                exit();
            } else {
                echo "<p>Error al eliminar al trabajador.</p>";
            }
        }
    }
}
?>
