<?php
// 1. Iniciar sesión para mantener el control de acceso y roles
session_start();

// 2. Incluir el archivo de conexión a la base de datos (Ruta raíz original)
//require_once 'config/database.php';
require_once ROOT_PATH . 'config/db.php';
// 3. Capturar el controlador y la acción desde la URL (por método GET)
// Si no hay ninguno, por defecto mandamos al usuario al login
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'auth';
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

// 4. Enrutador básico (Switch)
switch ($controller) {
    
    // --- MÓDULO DE AUTENTICACIÓN ---
    case 'auth':
        require_once 'controllers/AuthController.php';
        $authController = new AuthController();
        
        if ($action == 'login') {
            $authController->login();
        } elseif ($action == 'logout') {
            $authController->logout();
        } else {
            echo "Acción no válida en autenticación.";
        }
        break;
    
    // --- MÓDULO DASHBOARD ---
    case 'dashboard':
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }
        require_once 'controllers/DashboardController.php';
        $dashboardController = new DashboardController();
        $dashboardController->index();
        break;

    // --- MÓDULO DE INVENTARIO ---
    case 'inventario':
        // Protección de ruta
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }
        
        require_once 'controllers/InventarioController.php';
        $inventarioController = new InventarioController();
        
        if ($action == 'index') {
            $inventarioController->index(); 
        } elseif ($action == 'nuevo') {
            $inventarioController->nuevo(); 
        } elseif ($action == 'guardar') {
            $inventarioController->guardar();
        } elseif ($action == 'editar') {
            $inventarioController->editar();
        } elseif ($action == 'actualizar') {
            $inventarioController->actualizar();
        } elseif ($action == 'eliminar') {
            $inventarioController->eliminar();
        } else {
            echo "Acción no válida en inventario.";
        }
        break;

    // --- MANEJO DE ERRORES ---
    default:
        echo "<h1>Error 404</h1><p>El módulo solicitado no existe.</p>";
        break;
}
?>
