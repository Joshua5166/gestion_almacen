<?php
// 1. IMPORTANTE: Eliminamos 'config/database.php' porque el index.php de la raíz ya lo incluye de forma global.
// 2. Cargamos el modelo usando la constante absoluta ROOT_PATH para que no falle en Vercel
require_once __DIR__ . '/../models/Usuario.php';

class AuthController {
    
    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $correo = $_POST['correo'];
            $password = $_POST['password'];

            // 1. Instanciamos la conexión a la Base de Datos (Ya disponible globalmente)
            $database = new Database();
            $db = $database->getConnection();

            // 2. Instanciamos el Modelo Usuario pasándole la conexión
            $usuarioModel = new Usuario($db);

            // 3. Llamamos al método de autenticación
            $usuarioValido = $usuarioModel->autenticar($correo, $password);

            if ($usuarioValido) {
                // 4. Si es válido, guardamos los datos reales en las variables de sesión
                $_SESSION['usuario_id'] = $usuarioValido['id'];
                $_SESSION['rol'] = $usuarioValido['rol'];
                $_SESSION['nombre'] = $usuarioValido['nombre'];
                
                // Redirigimos al módulo de inventario
                header("Location: index.php?controller=dashboard&action=index");
                exit();
            } else {
                $error = "Credenciales incorrectas. Verifica tu correo o contraseña.";
            }
        }
        
        // Cargar la interfaz gráfica del login usando ruta segura relativa a este archivo
        require_once __DIR__ . '/../views/login.php';
    }

    public function logout() {
        // Destruir todas las variables de sesión y redirigir al login
        session_unset();
        session_destroy();
        header("Location: index.php?controller=auth&action=login");
        exit();
    }
}
?>
