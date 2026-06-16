<style>
    /* 1. VARIABLES Y RESET */
    :root {
        --bg-main: #f4f7f6;
        --sidebar-color: #2c3e50;
        --sidebar-hover: #34495e;
        --text-dark: #333333;
        --text-light: #bdc3c7;
        --primary: #2980b9;
        --primary-hover: #2471a3;
        --success: #27ae60;
        --success-hover: #219150;
        --danger: #c0392b;
        --danger-hover: #a0261b;
        --warning: #f39c12;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    
    body { display: flex; height: 100vh; background-color: var(--bg-main); overflow: hidden; }

    /* 2. MENU HAMBURGUESA PARA MÓVIL (Checkbox Hack sin JS) */
    #menu-toggle { display: none; }
    .menu-bar-movil {
        display: none;
        background-color: var(--sidebar-color);
        color: white;
        padding: 15px;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }
    .menu-icon { font-size: 1.5rem; cursor: pointer; padding: 5px 10px; background: var(--sidebar-hover); border-radius: 4px; }

    /* 3. SIDEBAR (Escritorio por defecto) */
    .sidebar { 
        width: 250px; 
        background-color: var(--sidebar-color); 
        color: white; 
        padding: 20px; 
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
    }
    .sidebar h2 { margin-bottom: 30px; font-size: 1.5rem; text-align: center; color: white; }
    .sidebar ul { list-style: none; flex: 1; }
    .sidebar ul li a { color: var(--text-light); text-decoration: none; display: block; padding: 12px; border-radius: 5px; margin-bottom: 5px; transition: 0.2s; }
    .sidebar ul li a:hover, .sidebar ul li a.active { background-color: var(--sidebar-hover); color: white; }

    /* 4. CONTENIDO PRINCIPAL */
    .main-content { flex: 1; padding: 30px; overflow-y: auto; background-color: var(--bg-main); }
    header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 1px solid #ddd; padding-bottom: 15px; }
    h1 { color: var(--text-dark); font-size: 1.8rem; }
    h2 { color: var(--text-dark); margin-bottom: 15px; }

    /* 5. CONTROLES Y TABLAS ACCIONES */
    .actions { display: flex; justify-content: space-between; margin-bottom: 20px; gap: 15px; align-items: center; flex-wrap: wrap; }
    input[type="text"], input[type="number"], select { padding: 10px; width: 100%; max-width: 300px; border: 1px solid #ccc; border-radius: 5px; outline: none; background: white; font-size: 0.95rem; }
    input[type="text"]:focus, input[type="number"]:focus, select:focus { border-color: var(--primary); }

    /* Botones */
    .btn-primary { background-color: var(--primary); color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; text-decoration: none; font-weight: bold; text-align: center; display: inline-block; }
    .btn-primary:hover { background-color: var(--primary-hover); }
    .btn-edit { background-color: var(--warning); color: white; border: none; padding: 6px 12px; border-radius: 3px; cursor: pointer; text-decoration: none; font-size: 0.85rem; display: inline-block; font-weight: bold; }
    .btn-edit:hover { background-color: #d35400; }
    .btn-delete { background-color: var(--danger); color: white; border: none; padding: 6px 12px; border-radius: 3px; cursor: pointer; text-decoration: none; font-size: 0.85rem; display: inline-block; font-weight: bold; }
    .btn-delete:hover { background-color: var(--danger-hover); }
    .btn-success { background-color: var(--success); color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 1rem; font-weight: bold; display: inline-block; }
    .btn-success:hover { background-color: var(--success-hover); }
    .btn-cancel { background-color: #7f8c8d; color: white; text-decoration: none; padding: 10px 20px; border-radius: 5px; font-size: 1rem; display: inline-block; margin-left: 10px; font-weight: bold; }
    .btn-cancel:hover { background-color: #6c7a7b; }

    /* Tablas Moduladas */
    .table-responsive { width: 100%; overflow-x: auto; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-radius: 5px; }
    .inventory-table { width: 100%; border-collapse: collapse; background: white; min-width: 600px; }
    .inventory-table th, .inventory-table td { padding: 15px; text-align: left; border-bottom: 1px solid #ddd; }
    .inventory-table th { background-color: #f8f9f9; color: var(--text-dark); font-weight: 600; }
    .alert-table th { background-color: var(--danger); color: white; }
    .inventory-table tbody tr:hover { background-color: #fcfcfc; }
    .stock-ok { color: var(--success); font-weight: bold; }

    /* Formulario Contenedor */
    .form-container { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); max-width: 600px; margin-top: 20px; }
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; font-weight: bold; margin-bottom: 5px; color: var(--text-dark); font-size: 0.95rem; }
    .form-group input, .form-group select { max-width: 100%; }

    /* Tarjetas del Dashboard */
    .cards-container { display: flex; gap: 20px; margin-bottom: 30px; flex-wrap: wrap; }
    .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); flex: 1; min-width: 200px; text-align: center; }
    .card h3 { color: #7f8c8d; font-size: 1rem; margin-bottom: 10px; }
    .card .valor { font-size: 2rem; color: var(--sidebar-color); font-weight: bold; }

    /* 6. MEDIA QUERIES (Soporte Responsive para Teléfonos) */
    @media (max-width: 768px) {
        body { flex-direction: column; }
        
        .menu-bar-movil { display: flex; }
        
        /* Ocultamos la barra lateral moviéndola a la izquierda */
        .sidebar {
            position: fixed;
            top: 55px;
            left: -250px;
            width: 250px;
            height: calc(100vh - 55px);
            z-index: 999;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        
        /* Cuando el checkbox oculto está activo, desplegamos la barra lateral */
        #menu-toggle:checked ~ .sidebar { left: 0; }
        
        .main-content { padding: 20px; margin-top: 55px; }
        header { flex-direction: column; align-items: flex-start; gap: 10px; }
        .actions { flex-direction: column; align-items: stretch; }
        input[type="text"] { max-width: 100%; }
        .cards-container { flex-direction: column; }
    }
</style>
