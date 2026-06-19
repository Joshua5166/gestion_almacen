<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Trabajador - Gestión de Almacén</title>
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
            <h1>Modificar Datos de Trabajador</h1>
        </header>

        <div class="form-container">
            <form action="index.php?controller=trabajadores&action=actualizar" method="POST">
                <div class="form-group">
                    <label for="nomina_display">Número de Nómina (No modificable):</label>
                    <input type="number" id="nomina_display" value="<?php echo $trabajador['nomina']; ?>" disabled style="background-color: #eee;">
                    <input type="hidden" name="nomina" value="<?php echo $trabajador['nomina']; ?>">
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre Completo:</label>
                    <input type="text" id="nombre" name="nombre" required value="<?php echo $trabajador['nombre']; ?>">
                </div>

                <div class="form-group">
                    <label for="area">Área de Asignación:</label>
                    <select id="area" name="area" required>
                        <option value="Sistemas" <?php echo ($trabajador['area'] == 'Sistemas') ? 'selected' : ''; ?>>Sistemas</option>
                        <option value="Almacén" <?php echo ($trabajador['area'] == 'Almacén') ? 'selected' : ''; ?>>Almacén</option>
                        <option value="Administración" <?php echo ($trabajador['area'] == 'Administración') ? 'selected' : ''; ?>>Administración</option>
                        <option value="Producción" <?php echo ($trabajador['area'] == 'Producción') ? 'selected' : ''; ?>>Producción</option>
                    </select>
                </div>

                <div style="margin-top: 25px;">
                    <button type="submit" class="btn-success">Actualizar Trabajador</button>
                    <a href="index.php?controller=trabajadores&action=index" class="btn-cancel">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
