<?php
// 1. Iniciar sesión para mantener el control de acceso y roles
session_start();

// 2. Definir la constante de ruta absoluta para la arquitectura Serverless de Vercel
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', __DIR__ . '/');
}
require_once ROOT_PATH . 'config/db.php';

// 3. Capturar el controlador y la acción desde la URL (por método GET)
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'auth';
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

// 4. Enrutador básico (Switch) blindado con ROOT_PATH
switch ($controller) {
    
    // --- MÓDULO DE AUTENTICACIÓN ---
    case 'auth':
        require_once ROOT_PATH . 'controllers/AuthController.php';
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
        require_once ROOT_PATH . 'controllers/DashboardController.php';
        $dashboardController = new DashboardController();
        $dashboardController->index();
        break;

    // --- MÓDULO DE INVENTARIO ---
    case 'inventario':
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }
        
        require_once ROOT_PATH . 'controllers/InventarioController.php';
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

    // --- API DE REPORTES ---
    case 'reportes':
        if (!isset($_SESSION['usuario_id'])) {
            header('HTTP/1.0 403 Forbidden');
            header('Content-Type: application/json');
            echo json_encode(["error" => "Acceso denegado. Inicia sesión primero."]);
            exit();
        }
        
        require_once ROOT_PATH . 'controllers/ReportesController.php';
        $reportesController = new ReportesController();
        
        if ($action == 'apiStock') {
            $reportesController->apiStock();
        } elseif ($action == 'index') {
            $reportesController->index(); 
        } else {
            header('Content-Type: application/json');
            echo json_encode(["error" => "Endpoint no válido en la API."]);
        }
        break;

    // --- MANEJO DE ERRORES ---
    default:
        echo "<h1>Error 404</h1><p>El módulo solicitado no existe.</p>";
        break;
}
?>
