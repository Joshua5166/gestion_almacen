<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes Dinámicos - Gestión de Almacén</title>
    <style>
        /* Tu CSS Estructural Original Integrado Físicamente */
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
        .btn-primary { background-color: #2980b9; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-weight: bold; }
        .btn-primary:hover { background-color: #2471a3; }

        .inventory-table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .inventory-table th, .inventory-table td { padding: 15px; text-align: left; border-bottom: 1px solid #ddd; }
        .inventory-table th { background-color: #f8f9f9; color: #333; font-weight: 600; text-transform: uppercase; font-size: 0.85rem; }
        .inventory-table tbody tr:hover { background-color: #fcfcfc; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Panel de Control</h2>
        <ul>
            <li><a href="index.php?controller=dashboard&action=index">Dashboard</a></li>
            <li><a href="index.php?controller=inventario&action=index">Inventario</a></li>
            <li><a href="#" onclick="alert('El módulo de Movimientos está en construcción.'); return false;" style="color: #7f8c8d;">Movimientos</a></li>
            <li><a href="index.php?controller=reportes&action=index" class="active">Reportes</a></li>
            <li style="margin-top: 40px;"><a href="index.php?controller=auth&action=logout" style="color: #e74c3c; font-weight: bold;">Cerrar Sesión</a></li>
        </ul>
    </div>

    <div class="main-content">
        <header>
            <h1>Reporte de Existencias en Tiempo Real</h1>
        </header>

        <section class="actions">
            <button class="btn-primary" onclick="cargarReporte()">Actualizar Datos vía API</button>
        </section>

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

    <script>
        function cargarReporte() {
            const tbody = document.getElementById('tablaReporte');
            tbody.innerHTML = '<tr><td colspan="6" style="text-align: center;">Cargando datos desde la API...</td></tr>';

            fetch('index.php?controller=reportes&action=apiStock')
                .then(response => response.json())
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
