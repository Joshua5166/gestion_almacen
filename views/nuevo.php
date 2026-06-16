<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Producto - Gestión de Almacén</title>
    
    <?php require_once dirname(__DIR__) . '/views/header_css.php'; ?>
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
            <li><a href="index.php?controller=inventario&action=index" class="active">Inventario</a></li>
            <li>
                <a href="#" onclick="alert('El módulo de Movimientos está en construcción.'); return false;" style="color: #7f8c8d;">
                    Movimientos
                </a>
            </li>
            <li><a href="index.php?controller=reportes&action=index">Reportes</a></li>
            <li style="margin-top: 40px;">
                <a href="index.php?controller=auth&action=logout" style="color: #e74c3c; font-weight: bold;">
                    Cerrar Sesión
                </a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <header>
            <h1>Registrar Nuevo Producto</h1>
        </header>

        <div class="form-container">
            <form action="index.php?controller=inventario&action=guardar" method="POST">
                
                <div class="form-group">
                    <label for="codigo_serie">Código / Número de Serie:</label>
                    <input type="text" id="codigo_serie" name="codigo_serie" required placeholder="Ej. MSI-A320I">
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre del Producto:</label>
                    <input type="text" id="nombre" name="nombre" required placeholder="Ej. Tarjeta Madre MSI A320I-S01">
                </div>

                <div class="form-group">
                    <label for="categoria">Categoría:</label>
                    <select id="categoria" name="categoria" required>
                        <option value="">Seleccione una categoría...</option>
                        <option value="Componentes">Componentes Internos</option>
                        <option value="Periféricos">Periféricos (Mouse, Teclado, etc.)</option>
                        <option value="Cables">Cables y Adaptadores</option>
                        <option value="Consumibles">Consumibles</option>
                    </select>
                </div>

                <div style="display: flex; gap: 15px;">
                    <div class="form-group" style="flex: 1;">
                        <label for="stock_actual">Stock Inicial:</label>
                        <input type="number" id="stock_actual" name="stock_actual" required min="0" value="0">
                    </div>

                    <div class="form-group" style="flex: 1;">
                        <label for="stock_minimo">Stock Mínimo (Alerta):</label>
                        <input type="number" id="stock_minimo" name="stock_minimo" required min="1" value="5">
                    </div>
                </div>

                <div class="form-group">
                    <label for="precio">Precio de Venta / Valor ($):</label>
                    <input type="number" id="precio" name="precio" required min="0" step="0.01" placeholder="0.00">
                </div>

                <div style="margin-top: 25px;">
                    <button type="submit" class="btn-success">Guardar Producto</button>
                    <a href="index.php?controller=inventario&action=index" class="btn-cancel">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
