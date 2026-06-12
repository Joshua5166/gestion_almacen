<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Almacén - Inventario</title>
    <style>
        /* Tu CSS Original Integrado Físicamente */
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

        .actions { display: flex; justify-content: space-between; margin-bottom: 20px; }
        input[type="text"] { padding: 10px; width: 300px; border: 1px solid #ccc; border-radius: 5px; }
        .btn-primary { background-color: #2980b9; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; display: inline-block; }
        .btn-primary:hover { background-color: #2471a3; }

        .inventory-table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .inventory-table th, .inventory-table td { padding: 15px; text-align: left; border-bottom: 1px solid #ddd; }
        .inventory-table th { background-color: #f8f9f9; color: #333; }
        .stock-ok { color: #27ae60; font-weight: bold; }
        
        /* Botones de acción estilizados como enlaces con apariencia de botón */
        .btn-edit { background-color: #f39c12; color: white; border: none; padding: 6px 12px; border-radius: 3px; cursor: pointer; text-decoration: none; font-size: 0.85rem; display: inline-block; }
        .btn-edit:hover { background-color: #d35400; }
        .btn-delete { background-color: #c0392b; color: white; border: none; padding: 6px 12px; border-radius: 3px; cursor: pointer; text-decoration: none; font-size: 0.85rem; display: inline-block; }
        .btn-delete:hover { background-color: #a0261b; }
    </style>
</head>
<body>
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
            <h1>Control de Stock: Equipo de Cómputo</h1>
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
                if(isset($stmt_productos) && $stmt_productos->rowCount() > 0) {
                    while ($row = $stmt_productos->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        
                        // Si el stock es menor o igual al mínimo se pone rojo, si no usa tu clase .stock-ok
                        $clase_stock = ($stock_actual <= $stock_minimo) ? 'style="color: #c0392b; font-weight: bold;"' : 'class="stock-ok"';
                        
                        echo "<tr>";
                        echo "<td>{$codigo_serie}</td>";
                        echo "<td>{$nombre}</td>";
                        echo "<td>{$categoria}</td>";
                        echo "<td {$clase_stock}>{$stock_actual}</td>";
                        echo "<td>{$stock_minimo}</td>";
                        echo "<td>
                                <a href='index.php?controller=inventario&action=editar&id={$id}' class='btn-edit'>Editar</a>
                                <a href='index.php?controller=inventario&action=eliminar&id={$id}' class='btn-delete' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este producto?\");'>Eliminar</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center; color: #7f8c8d;'>No hay productos registrados en el almacén.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#tablaProductos tr');
            
            rows.forEach(row => {
                let codigo = row.cells[0] ? row.cells[0].textContent.toLowerCase() : '';
                let nombre = row.cells[1] ? row.cells[1].textContent.toLowerCase() : '';
                if (codigo.includes(filter) || nombre.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
