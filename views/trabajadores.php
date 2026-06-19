<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantilla de Trabajadores - Gestión de Almacén</title>
    <?php require_once ROOT_PATH . 'views/header_css.php'; ?>
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
            <li><a href="index.php?controller=inventario&action=index">Inventario</a></li>
            <li><a href="index.php?controller=trabajadores&action=index" class="active">Trabajadores</a></li>
            <li><a href="index.php?controller=reportes&action=index">Reportes</a></li>
            <li style="margin-top: 40px;"><a href="index.php?controller=auth&action=logout" style="color: #e74c3c; font-weight: bold;">Cerrar Sesión</a></li>
        </ul>
    </div>

    <div class="main-content">
        <header>
            <h1>Plantilla de Trabajadores</h1>
        </header>

        <section class="actions">
            <div style="display: flex; gap: 10px; flex: 1; flex-wrap: wrap;">
                <input type="text" id="searchTrabajador" placeholder="Buscar por nombre o nómina..." style="max-width: 250px;">
                <select id="filterArea" style="max-width: 200px;">
                    <option value="">Todas las áreas</option>
                    <option value="Sistemas">Sistemas</option>
                    <option value="Almacén">Almacén</option>
                    <option value="Administración">Administración</option>
                    <option value="Producción">Producción</option>
                </select>
            </div>
            <a href="index.php?controller=trabajadores&action=nuevo" class="btn-primary" style="text-decoration: none;">+ Nuevo Trabajador</a>
        </section>

        <div class="table-responsive">
            <table class="inventory-table">
                <thead>
                    <tr>
                        <th>Nómina</th>
                        <th>Nombre Completo</th>
                        <th>Área de Trabajo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tablaTrabajadores">
                    <?php
                    if(isset($stmt_trabajadores) && $stmt_trabajadores->rowCount() > 0) {
                        while ($row = $stmt_trabajadores->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td><strong>{$row['nomina']}</strong></td>";
                            echo "<td>{$row['nombre']}</td>";
                            echo "<td>{$row['area']}</td>";
                            echo "<td>
                                    <a href='index.php?controller=trabajadores&action=editar&id={$row['nomina']}' class='btn-edit'>Editar</a>
                                    <a href='index.php?controller=trabajadores&action=eliminar&id={$row['nomina']}' class='btn-delete' onclick='return confirm(\"¿Deseas dar de baja a este trabajador?\");'>Baja</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' style='text-align:center; color: #7f8c8d;'>No hay trabajadores registrados.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Lógica del Buscador en tiempo real y Filtro por Área unificados
        const searchInput = document.getElementById('searchTrabajador');
        const areaSelect = document.getElementById('filterArea');

        function filtrarTabla() {
            let textFilter = searchInput.value.toLowerCase();
            let areaFilter = areaSelect.value.toLowerCase();
            let rows = document.querySelectorAll('#tablaTrabajadores tr');

            rows.forEach(row => {
                if(row.cells.length < 3) return; // Saltarse fila vacía
                let nomina = row.cells[0].textContent.toLowerCase();
                let nombre = row.cells[1].textContent.toLowerCase();
                let area = row.cells[2].textContent.toLowerCase();

                let coincideTexto = nomina.includes(textFilter) || nombre.includes(textFilter);
                let coincideArea = areaFilter === "" || area === areaFilter;

                if (coincideTexto && coincideArea) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        searchInput.addEventListener('keyup', filtrarTabla);
        areaSelect.addEventListener('change', filtrarTabla);
    </script>
</body>
</html>
