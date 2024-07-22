<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Exportar DataTable a CSV</title>
    <!-- Incluye jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Incluye DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <!-- Incluye DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <!-- Incluye DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <!-- Incluye DataTables Buttons JS y sus dependencias -->
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
</head>
<body>
    <h2>Tabla con Exportación a CSV</h2>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Posición</th>
                <th>Oficina</th>
                <th>Edad</th>
                <th>Fecha de inicio</th>
                <th>Salario</th>
            </tr>
        </thead>
        <tbody>
            <!-- Tus datos aquí -->
            <tr>
                <td>1</td>
                <td>Nombre Ejemplo</td>
                <td>Posición Ejemplo</td>
                <td>Oficina Ejemplo</td>
                <td>30</td>
                <td>2016-01-01</td>
                <td>$2000</td>
            </tr>
            <!-- Repite las filas según sea necesario -->
        </tbody>
    </table>

    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'csvHtml5',
                        text: 'Exportar a CSV',
                        className: 'btn btn-primary'
                    }
                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                }
            });
        });
    </script>
</body>
</html>
