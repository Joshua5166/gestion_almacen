<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - Gestión de Almacén</title>
    
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
            <li><a href="index.php?controller=trabajadores&action=index">Trabajadores</a></li>
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
            <h1>Editar Producto</h1>
        </header>

        <div class="form-container">
            <form action="index.php?controller=inventario&action=actualizar" method="POST">
                <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                
                <div class="form-group">
                    <label for="codigo_serie">Código / Número de Serie:</label>
                    <input type="text" id="codigo_serie" name="codigo_serie" required value="<?php echo $producto['codigo_serie']; ?>">
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre del Producto:</label>
                    <input type="text" id="nombre" name="nombre" required value="<?php echo $producto['nombre']; ?>">
                </div>

                <div class="form-group">
                    <label for="categoria">Categoría:</label>
                    <select id="categoria" name="categoria" required>
                        <option value="Componentes" <?php if($producto['categoria'] == 'Componentes') echo 'selected'; ?>>Componentes Internos</option>
                        <option value="Periféricos" <?php if($producto['categoria'] == 'Periféricos') echo 'selected'; ?>>Periféricos (Mouse, Teclado, etc.)</option>
                        <option value="Cables" <?php if($producto['categoria'] == 'Cables') echo 'selected'; ?>>Cables y Adaptadores</option>
                        <option value="Consumibles" <?php if($producto['categoria'] == 'Consumibles') echo 'selected'; ?>>Consumibles</option>
                    </select>
                </div>

                <div style="display: flex; gap: 15px;">
                    <div class="form-group" style="flex: 1;">
                        <label for="stock_actual">Stock Actual:</label>
                        <input type="number" id="stock_actual" name="stock_actual" required min="0" value="<?php echo $producto['stock_actual']; ?>">
                    </div>

                    <div class="form-group" style="flex: 1;">
                        <label for="stock_minimo">Stock Mínimo (Alerta):</label>
                        <input type="number" id="stock_minimo" name="stock_minimo" required min="1" value="<?php echo $producto['stock_minimo']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="precio">Precio de Venta / Valor ($):</label>
                    <input type="number" id="precio" name="precio" required min="0" step="0.01" value="<?php echo $producto['precio']; ?>">
                </div>

                <div style="margin-top: 25px;">
                    <button type="submit" class="btn-edit" style="font-size: 1rem; padding: 10px 20px; border-radius: 5px;">Actualizar Producto</button>
                    <a href="index.php?controller=inventario&action=index" class="btn-cancel">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
