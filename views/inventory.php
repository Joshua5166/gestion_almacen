<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gestión de Almacén</title>
    
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
            <li><a href="index.php?controller=dashboard&action=index" class="active">Dashboard</a></li>
            <li><a href="index.php?controller=inventario&action=index">Inventario</a></li>
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
            <h1>Resumen del Almacén</h1>
        </header>

        <div class="cards-container">
            <div class="card">
                <h3>Valorización Total del Stock</h3>
               <div class="valor">$<?php echo number_format($valorTotal ?? 0, 2); ?> MXN</div>
            </div>
            <div class="card">
                <h3>Estado General</h3>
                <div class="valor" style="color: #27ae60;">Operativo</div>
            </div>
        </div>

        <h2>Alertas de Stock Bajo</h2>
        <div class="table-responsive" style="margin-top: 15px;">
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
    </div>
</body>
</html>
