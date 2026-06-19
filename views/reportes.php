<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes Dinámicos - Gestión de Almacén</title>
    
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
            <li><a href="index.php?controller=inventario&action=index">Inventario</a></li>
            <li><a href="index.php?controller=trabajadores&action=index">Trabajadores</a></li>
            <li><a href="index.php?controller=reportes&action=index" class="active">Reportes</a></li>
            <li style="margin-top: 40px;">
                <a href="index.php?controller=auth&action=logout" style="color: #e74c3c; font-weight: bold;">
                    Cerrar Sesión
                </a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <header>
            <h1>Reporte de Existencias en Tiempo Real</h1>
        </header>

        <section class="actions">
            <button class="btn-primary" onclick="cargarReporte()">Actualizar Datos vía API</button>
        </section>

        <div class="table-responsive">
            <table class="inventory-table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Stock</th>
                        <th>Precio Unit.</th>
                        <th>Subtotal (Inversión)</th>
                    </tr>
                </thead>
                <tbody id="tablaReporte">
                    <tr><td colspan="6" style="text-align: center;">Haz clic en "Actualizar Datos" para consumir la API.</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function cargarReporte() {
            const tbody = document.getElementById('tablaReporte');
            tbody.innerHTML = '<tr><td colspan="6" style="text-align: center;">Cargando datos desde la API...</td></tr>';

            fetch('index.php?controller=reportes&action=apiStock')
                .then(response => {
                    if (!response.ok) throw new Error('Error en la respuesta del servidor');
                    return response.json();
                })
                .then(data => {
                    tbody.innerHTML = ''; 
                    
                    if(!data || data.error || data.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="6" style="text-align: center;">No hay productos registrados o acceso denegado.</td></tr>';
                        return;
                    }

                    data.forEach(producto => {
                        const stock = parseInt(producto.stock_actual);
                        const precio = parseFloat(producto.precio);
                        const subtotal = stock * precio;
                        
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${producto.codigo_serie}</td>
                            <td>${producto.nombre}</td>
                            <td>${producto.categoria}</td>
                            <td><strong>${stock}</strong></td>
                            <td>$${precio.toFixed(2)}</td>
                            <td style="color: #27ae60; font-weight: bold;">$${subtotal.toFixed(2)}</td>
                        `;
                        tbody.appendChild(tr);
                    });
                })
                .catch(error => {
                    console.error('Error al consumir la API:', error);
                    tbody.innerHTML = '<tr><td colspan="6" style="color: red; text-align: center;">Error al cargar los datos de la API.</td></tr>';
                });
        }

        document.addEventListener('DOMContentLoaded', cargarReporte);
    </script>
</body>
</html>
