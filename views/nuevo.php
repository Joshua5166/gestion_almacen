<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Producto - Gestión de Almacén</title>
    <style>
        /* Tu CSS Estructural Original */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; height: 100vh; background-color: #f4f7f6; }

        .sidebar { width: 250px; background-color: #2c3e50; color: white; padding: 20px; }
        .sidebar h2 { margin-bottom: 30px; font-size: 1.5rem; text-align: center; }
        .sidebar ul { list-style: none; }
        .sidebar ul li a { color: #bdc3c7; text-decoration: none; display: block; padding: 12px; border-radius: 5px; margin-bottom: 5px; }
        .sidebar ul li a:hover { background-color: #34495e; color: white; }

        .main-content { flex: 1; padding: 30px; overflow-y: auto; }
        header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        h1 { color: #333; }

        /* Estilos Integrados y Adaptados para el Formulario */
        .form-container { 
            background: white; 
            padding: 25px; 
            border-radius: 8px; 
            box-shadow: 0 1px 3px rgba(0,0,0,0.1); 
            max-width: 600px; 
            margin-top: 20px; 
        }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; color: #333; font-size: 0.95rem; }
        
        /* Inputs estilizados para que hagan juego con tu buscador */
        .form-group input, .form-group select { 
            width: 100%; 
            padding: 10px; 
            border: 1px solid #ccc; 
            border-radius: 5px; 
            box-sizing: border-box; 
            outline: none;
            font-size: 0.95rem;
        }
        .form-group input:focus, .form-group select:focus {
            border-color: #2980b9;
        }

        /* Botones alineados con tu paleta de colores */
        .btn-success { background-color: #27ae60; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 1rem; font-weight: bold; display: inline-block; }
        .btn-success:hover { background-color: #219150; }
        
        .btn-cancel { background-color: #7f8c8d; color: white; text-decoration: none; padding: 10px 20px; border-radius: 5px; font-size: 1rem; display: inline-block; margin-left: 10px; font-weight: bold; }
        .btn-cancel:hover { background-color: #6c7a7b; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Panel de Control</h2>
        <ul>
            <li><a href="index.php?controller=dashboard&action=index">Dashboard</a></li>
            <li><a href="index.php?controller=inventario&action=index">Inventario</a></li>
            
            <li>
                <a href="#" onclick="alert('El módulo de Movimientos está en construcción.'); return false;" style="color: #7f8c8d;">
                    Movimientos
                </a>
            </li>
            <li>
                <a href="#" onclick="alert('La API de Reportes está programada para la semana del 11 de junio.'); return false;" style="color: #7f8c8d;">
                    Reportes
                </a>
            </li>
            
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
