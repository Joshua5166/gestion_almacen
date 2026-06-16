<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gestión de Almacén</title>
    <style>
        /* Tu CSS Estructural Original */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; height: 100vh; background-color: #f4f7f6; }

        .sidebar { width: 250px; background-color: #2c3e50; color: white; padding: 20px; }
        .sidebar h2 { margin-bottom: 30px; font-size: 1.5rem; text-align: center; }
        .sidebar ul { list-style: none; }
        .sidebar ul li a { color: #bdc3c7; text-decoration: none; display: block; padding: 12px; border-radius: 5px; margin-bottom: 5px; }
        .sidebar ul li a:hover, .sidebar ul li a.active { background-color: #34495e; color: white; }

        .main-content { flex: 1; padding: 30px; overflow-y: auto; }
        header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        h1 { color: #333; }

        /* Estilos específicos de las tarjetas del Dashboard */
        .cards-container { display: flex; gap: 20px; margin-bottom: 30px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); flex: 1; text-align: center; }
        .card h3 { color: #7f8c8d; font-size: 1rem; margin-bottom: 10px; }
        .card .valor { font-size: 2rem; color: #2c3e50; font-weight: bold; }

        /* Estilos de la tabla de inventario y alertas */
        .inventory-table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .inventory-table th, .inventory-table td { padding: 15px; text-align: left; border-bottom: 1px solid #ddd; }
        .inventory-table th { background-color: #f8f9f9; color: #333; }
        
        /* Cabecera roja para la tabla de stock bajo */
        .alert-table th { background-color: #e74c3c; color: white; font-weight: 600; text-transform: uppercase; font-size: 0.85rem; }
        .inventory-table tbody tr:hover { background-color: #fcfcfc; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Panel de Control</h2>
        <ul>
            <li><a href="index.php?controller=dashboard&action=index" class="active">Dashboard</a></li>
            <li><a href="index.php?controller=inventario&action=index">Inventario</a></li>
            
            <li>
                <a href="#" onclick="alert('El módulo de Movimientos está en construcción.'); return false;" style="color: #7f8c8d;">
                    Movimientos
                </a>
            </li>
            <li>
                <a href="index.php?controller=reportes&action=index">Reportes</a>
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
            <h1>Resumen del Almacén</h1>
        </header>

        <div class="cards-container">
            <div class="card">
                <h3>Valorización Total del Stock</h3>
                <div class="valor">$<?php echo number_format($valorTotal, 2); ?> MXN</div>
            </div>
            <div class="card">
                <h3>Estado General</h3>
                <div class="valor" style="color: #27ae60;">Operativo</div>
            </div>
        </div>

        <h2>Alertas de Stock Bajo</h2>
        <table class="inventory-table alert-table" style="margin-top: 15px;">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Stock Actual</th>
                    <th>Stock Mínimo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($stmt_alertas) && $stmt_alertas->rowCount() > 0) {
                    while ($row = $stmt_alertas->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>{$row['codigo_serie']}</td>";
                        echo "<td>{$row['nombre']}</td>";
                        echo "<td style='color: #c0392b; font-weight: bold;'>{$row['stock_actual']}</td>";
                        echo "<td>{$row['stock_minimo']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' style='text-align:center; color: #7f8c8d;'>No hay alertas. El stock está saludable.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
