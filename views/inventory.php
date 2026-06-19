<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Almacén - Inventario</title>
    
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
            <h1>Control de Stock: Equipo de Cómputo</h1>
        </header>

        <section class="actions">
            <input type="text" id="searchInput" placeholder="Buscar por código o nombre...">
            <a href="index.php?controller=inventario&action=nuevo" class="btn-primary" style="text-decoration: none;">+ Nuevo Producto</a>
        </section>

        <div class="table-responsive">
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
