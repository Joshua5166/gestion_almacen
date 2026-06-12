<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Gestión de Almacén</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        /* Estructura Base para evitar el colapso sin CSS */
        body { display: flex; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; background-color: #f4f6f9; color: #333; }
        
        /* Sidebar Estilizada */
        .sidebar { width: 250px; background-color: #2c3e50; color: white; min-height: 100vh; padding: 20px; box-sizing: border-box; }
        .sidebar h2 { font-size: 1.4rem; border-bottom: 2px solid #34495e; padding-bottom: 15px; margin-top: 0; text-align: center; }
        .sidebar ul { list-style: none; padding: 0; margin: 20px 0; }
        .sidebar ul li { margin-bottom: 15px; }
        .sidebar ul li a { color: #ecf0f1; text-decoration: none; display: block; padding: 10px 15px; border-radius: 4px; transition: background 0.3s; }
        .sidebar ul li a:hover { background-color: #34495e; }
        
        /* Contenido Principal */
        .main-content { flex: 1; padding: 40px; box-sizing: border-box; }
        header h1 { margin-top: 0; color: #2c3e50; font-size: 1.8rem; border-bottom: 2px solid #bdc3c7; padding-bottom: 10px; }
        
        /* Contenedores de Tarjetas (Cards) */
        .cards-container { display: flex; gap: 20px; margin-bottom: 30px; margin-top: 20px; }
        .card { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); flex: 1; text-align: center; border-top: 4px solid #3498db; }
        .card:last-child { border-top-color: #27ae60; }
        .card h3 { color: #7f8c8d; font-size: 0.95rem; margin: 0 0 10px 0; text-transform: uppercase; letter-spacing: 0.5px; }
        .card .valor { font-size: 2rem; color: #2c3e50; font-weight: bold; }
        
        /* Tablas de Inventario */
        .inventory-table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-top: 15px; }
        .inventory-table th, .inventory-table td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #edf2f7; }
        .inventory-table th { font-weight: 600; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; }
        .alert-table th { background-color: #e74c3c; color: white; }
        .inventory-table tbody tr:hover { background-color: #f8fafc; }
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
            <li style="margin-top: 40px;">
                <a href="index.php?controller=auth&action=logout" style="color: #e74c3c; font-weight: bold; border: 1px solid #e74c3c; text-align: center;">
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

        <h2 style="color: #2c3e50; font-size: 1.4rem; margin-top: 40px;">Alertas de Stock Bajo</h2>
        <table class="inventory-table alert-table">
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
                if($stmt_alertas->rowCount() > 0) {
                    while ($row = $stmt_alertas->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>{$row['codigo_serie']}</td>";
                        echo "<td>{$row['nombre']}</td>";
                        echo "<td style='color: #e74c3c; font-weight: bold;'>{$row['stock_actual']}</td>";
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
