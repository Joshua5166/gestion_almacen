<?php
// 1. IMPORTANTE: Eliminamos 'config/database.php' porque el index.php de la raíz ya lo incluye de forma global.
// 2. Cargamos el modelo usando la constante absoluta ROOT_PATH para garantizar compatibilidad en Vercel
require_once ROOT_PATH . 'models/Usuario.php';

class AuthController {
    
    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $correo = $_POST['correo'];
            $password = $_POST['password'];

            // 1. Instanciamos la conexión a la Base de Datos (Ya disponible globalmente porque index.php incluyó db.php)
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
                
                // Redirigimos al módulo de dashboard de forma segura
                header("Location: index.php?controller=dashboard&action=index");
                exit();
            } else {
                $error = "Credenciales incorrectas. Verifica tu correo o contraseña.";
            }
        }
        
        // Cargar la interfaz gráfica del login usando la constante absoluta ROOT_PATH
        require_once ROOT_PATH . 'views/login.php';
    }

    public function logout() {
        // Destruir todas las variables de sesión y redirigir al login
        session_unset();
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        header("Location: index.php?controller=auth&action=login");
        exit();
    }
}
?>
