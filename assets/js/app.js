document.addEventListener('DOMContentLoaded', function() {
    // Capturamos el input de búsqueda y el cuerpo de la tabla
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('tablaProductos');

    // Verificamos que los elementos existan en la página actual
    if (searchInput && tableBody) {
        
        // Escuchamos cada vez que el usuario presiona y suelta una tecla ('keyup')
        searchInput.addEventListener('keyup', function() {
            // Convertimos lo que el usuario escribió a minúsculas para facilitar la comparación
            const filter = searchInput.value.toLowerCase();
            // Obtenemos todas las filas (tr) dentro del cuerpo de la tabla
            const rows = tableBody.getElementsByTagName('tr');

            // Recorremos cada fila de la tabla
            for (let i = 0; i < rows.length; i++) {
                // Obtenemos la celda del Código (columna 0) y del Nombre (columna 1)
                const celdaCodigo = rows[i].getElementsByTagName('td')[0];
                const celdaNombre = rows[i].getElementsByTagName('td')[1];

                if (celdaCodigo && celdaNombre) {
                    const textoCodigo = celdaCodigo.textContent || celdaCodigo.innerText;
                    const textoNombre = celdaNombre.textContent || celdaNombre.innerText;

                    // Comparamos si el texto de la búsqueda coincide con el código o el nombre
                    if (textoCodigo.toLowerCase().indexOf(filter) > -1 || textoNombre.toLowerCase().indexOf(filter) > -1) {
                        // Si coincide, mostramos la fila
                        rows[i].style.display = "";
                    } else {
                        // Si no coincide, ocultamos la fila
                        rows[i].style.display = "none";
                    }
                }
            }
        });
    }
});