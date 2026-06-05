<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - Gestión de Almacén</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .form-container { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); max-width: 600px; margin-top: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; color: #333; }
        .form-group input, .form-group select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn-warning { background-color: #f39c12; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 1rem; }
        .btn-warning:hover { background-color: #d68910; }
        .btn-cancel { background-color: #7f8c8d; color: white; text-decoration: none; padding: 10px 20px; border-radius: 5px; font-size: 1rem; display: inline-block; margin-left: 10px;}
    </style>
</head>
<body>
   <div class="sidebar">
        <h2>Panel de Control</h2>
        <ul>
            <li><a href="index.php?controller=dashboard&action=index">Dashboard</a></li>
            <li><a href="index.php?controller=inventario&action=index">Inventario</a></li>
            
            <li>
                <a href="#" onclick="alert('El módulo de Movimientos está en construcción.'); return false;" style="color: #95a5a6;">
                    Movimientos
                </a>
            </li>
            <li>
                <a href="#" onclick="alert('La API de Reportes está programada para la semana del 11 de junio.'); return false;" style="color: #95a5a6;">
                    Reportes
                </a>
            </li>
            
            <li style="margin-top: 30px;">
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

                <div style="margin-top: 20px;">
                    <button type="submit" class="btn-warning">Actualizar Producto</button>
                    <a href="index.php?controller=inventario&action=index" class="btn-cancel">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>