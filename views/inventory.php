<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Almacén - Inventario</title>
    <link rel="stylesheet" href="/api/assets/css/style.css">
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
            <h1>Control de Stock: Equipo de Cómputo</h1>
            <div class="user-info">Administrador</div>
        </header>

        <section class="actions">
            <input type="text" id="searchInput" placeholder="Buscar por código o nombre...">
            <a href="index.php?controller=inventario&action=nuevo" class="btn-primary" style="text-decoration: none;">+ Nuevo Producto</a>
        </section>

        <table class="inventory-table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Stock Actual</th>
                    <th>Stock Mínimo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaProductos">
                <?php
                // Verificamos si hay productos en la base de datos
                if(isset($stmt_productos) && $stmt_productos->rowCount() > 0) {
                    // Recorremos cada producto
                    while ($row = $stmt_productos->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        
                        // Lógica visual básica para el stock mínimo
                        $clase_stock = ($stock_actual <= $stock_minimo) ? 'style="color: red; font-weight: bold;"' : 'class="stock-ok"';
                        
                        echo "<tr>";
                        echo "<td>{$codigo_serie}</td>";
                        echo "<td>{$nombre}</td>";
                        echo "<td>{$categoria}</td>";
                        echo "<td {$clase_stock}>{$stock_actual}</td>";
                        echo "<td>{$stock_minimo}</td>";
                        echo "<td>
                                <a href='index.php?controller=inventario&action=editar&id={$id}' class='btn-edit' style='text-decoration:none;'>Editar</a>
                                <a href='index.php?controller=inventario&action=eliminar&id={$id}' class='btn-delete' style='text-decoration:none;' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este producto?\");'>Eliminar</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center;'>No hay productos registrados en el almacén.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="/api/assets/js/app.js"></script>
</body>
</html>
