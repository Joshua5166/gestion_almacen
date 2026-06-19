<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Trabajador - Gestión de Almacén</title>
    <?php require_once ROOT_PATH . 'views/header_css.php'; ?>
</head>
<body>
    <input type="checkbox" id="menu-toggle">
    <div class="menu-bar-movil">
        <span>Gestión de Almacén</span>
        <label for="menu-toggle" class="menu-icon">&#9776;</label>
    </div>

    <div class="sidebar">
        <h2>Panel de Control</h2>
        <ul>
            <li><a href="index.php?controller=dashboard&action=index">Dashboard</a></li>
            <li><a href="index.php?controller=inventario&action=index">Inventario</a></li>
            <li><a href="index.php?controller=trabajadores&action=index" class="active">Trabajadores</a></li>
            <li><a href="index.php?controller=reportes&action=index">Reportes</a></li>
            <li style="margin-top: 40px;"><a href="index.php?controller=auth&action=logout" style="color: #e74c3c; font-weight: bold;">Cerrar Sesión</a></li>
        </ul>
    </div>

    <div class="main-content">
        <header>
            <h1>Registrar Nuevo Trabajador</h1>
        </header>

        <div class="form-container">
            <form action="index.php?controller=trabajadores&action=guardar" method="POST">
                <div class="form-group">
                    <label for="nomina">Número de Nómina (ID):</label>
                    <input type="number" id="nomina" name="nomina" required placeholder="Ej. 1005">
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre Completo:</label>
                    <input type="text" id="nombre" name="nombre" required placeholder="Nombre y Apellidos">
                </div>

                <div class="form-group">
                    <label for="area">Área de Asignación:</label>
                    <select id="area" name="area" required>
                        <option value="">Selecciona un área...</option>
                        <option value="Sistemas">Sistemas</option>
                        <option value="Almacén">Almacén</option>
                        <option value="Administración">Administración</option>
                        <option value="Producción">Producción</option>
                    </select>
                </div>

                <div style="margin-top: 25px;">
                    <button type="submit" class="btn-success">Guardar Registro</button>
                    <a href="index.php?controller=trabajadores&action=index" class="btn-cancel">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
