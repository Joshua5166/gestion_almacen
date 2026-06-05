<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Gestión de Almacén</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .cards-container { display: flex; gap: 20px; margin-bottom: 30px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); flex: 1; text-align: center; }
        .card h3 { color: #7f8c8d; font-size: 1rem; margin-bottom: 10px; }
        .card .valor { font-size: 2rem; color: #2c3e50; font-weight: bold; }
        .alert-table th { background-color: #e74c3c; color: white; }
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
                if($stmt_alertas->rowCount() > 0) {
                    while ($row = $stmt_alertas->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>{$row['codigo_serie']}</td>";
                        echo "<td>{$row['nombre']}</td>";
                        echo "<td style='color: red; font-weight: bold;'>{$row['stock_actual']}</td>";
                        echo "<td>{$row['stock_minimo']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' style='text-align:center;'>No hay alertas. El stock está saludable.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>