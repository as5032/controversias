<?php

require_once('config.php');

if (empty($_SESSION["id"])) {
    header("location: index.php");
}

$pagina = 'inicial.php';

require_once('conexion_db.php');

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <!-- Bootstrap de CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" media="screen" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="images/icon/libro.ico" type="image/ico" />

    <!-- Title Page-->
    <title>CACCC</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/fontawesome-free-6.4.0/css/all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">


    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>

    <style>
        .tabla-responsiva {
            overflow-x: auto;
            /* Agrega una barra de desplazamiento horizontal si es necesario */
            max-width: 100%;
            /* Evita que la tabla se extienda más allá del ancho del contenedor */
        }

        #example {
            font-size: 14px;
            /* Cambia el valor según tu preferencia */
        }

        .editar-button {
            background-color: #FF8215 !important;
        }

        /* Estilos para el botón de eliminación (fondo rojo) */
        .consulta-button {
            background-color: #3F87EB !important;
        }

        .editar-button i,
        .consulta-button i {
            color: white !important;
            /* Color blanco para los íconos */
        }
    </style>
</head>

<body class="animsition">
    <?php
    include('plantilla.php');
    ?>
    <!--INICIA DATOS A INGRESAR-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 h-100">
                        <div class="card h-100">
                            <div class="card-header">
                                <strong>Consulta</strong> Informes
                            </div>
                            <div class="card-body card-block h-100">
                                <form action="" method="POST" class="h-100" id="miFormulario" name="miFormulario" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="date-input" class="control-label mb-1">Rango de
                                                    fecha</label>
                                                <input type="checkbox" id="habilitarFechas">
                                                <input type="date" id="FechaIn" name="FechaIn" class="form-control" style="font-size: 16px;" disabled>
                                                <label for="date-input" class="control-label mb-1">a</label>
                                                <input type="date" id="FechaVen" name="FechaVen" class="form-control" style="font-size: 16px;" disabled>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="select-dddmultiple" class="control-label mb-1">Juicio/Procedimiento</label>
                                                <select id="select-multiple4" name="Juicio[]" multiple>
                                                    <option value="" disabled selected>Seleccione una o más
                                                        opciones</option>
                                                    <?php
                                                    // Incluye tu archivo de conexión a la base de datos
                                                    require_once 'conexion_db.php';

                                                    // Consulta SQL para obtener datos de la tabla cat_abogado
                                                    $sql = "SELECT * FROM cat_juicio";

                                                    $resultado = $conn->query($sql);

                                                    if ($resultado->num_rows > 0) {
                                                        // Si hay resultados, itera a través de ellos
                                                        while ($fila = $resultado->fetch_assoc()) {
                                                            // Accede a los campos de la fila
                                                            $id = $fila['id'];
                                                            $nombre = $fila['t_juicio'];

                                                            // Imprime las opciones permitiendo la selección múltiple
                                                            echo '<option value="' . $fila['id'] . '">' . $fila['t_juicio'] . '</option>';
                                                        }
                                                    } else {
                                                        echo "No se encontraron registros en la tabla cat_juicio.";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="select-dddmultiple" class="control-label mb-1">Actor/Demandado</label>
                                                <select id="select-multiple6" name="Actor[]" multiple>
                                                    <option value="" disabled selected>Seleccione una o más
                                                        opciones</option>
                                                    <?php
                                                    // Incluye tu archivo de conexión a la base de datos
                                                    require_once 'conexion_db.php';

                                                    // Consulta SQL para obtener datos de la tabla cat_abogado
                                                    $sql = "SELECT * FROM cat_actor";

                                                    $resultado = $conn->query($sql);

                                                    if ($resultado->num_rows > 0) {
                                                        // Si hay resultados, itera a través de ellos
                                                        while ($fila = $resultado->fetch_assoc()) {
                                                            // Accede a los campos de la fila
                                                            $id = $fila['id'];
                                                            $nombre = $fila['actord'];

                                                            // Imprime las opciones permitiendo la selección múltiple
                                                            echo '<option value="' . $fila['id'] . '">' . $fila['actord'] . '</option>';
                                                        }
                                                    } else {
                                                        echo "No se encontraron registros en la tabla cat_actor.";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        
                                    </div>
                                    <br>
                                    <input type="button" id="submitFormData" onclick="SubmitFormData();" value="Submit" />
                                    
                                    <div>
                                        <label for="text" style="font-size: 14px;">Por favor, seleccione uno o
                                            más filtros para su busqueda</label>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 h-100">
                        <form action=" " method="POST" class="h-100" id="miFormulario2" enctype="multipart/form-data">
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <!-- DATA TABLE-->
                                    <div class="table-responsive m-b-40">
                                        <table class="table table-borderless table-data3">
                                            <thead>
                                                <tr>
                                                    <th>Juicio</th>
                                                    <th>Actor/demandado</th>
                                                    <th>Total de expedientes</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include("consulta_excel.php");
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- END DATA TABLE-->
                                    <?php if (isset($showPrintButton) && $showPrintButton === true) : ?>
                                        <!-- Botón de impresión -->
                                        <div class="section__content section__content--p40">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-lg-12 h-100">
                                                        <button type="button" class="btn btn-outline-primary btn-lg" id="exportarExcel">
                                                            <i class="fas fa-print"></i> Exportar a Excel
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="results"> </div>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row" style="display: none;">
                    <div class="col-lg-12 h-100">
                        <form action=" " method="POST" class="h-100" id="miFormulario3" enctype="multipart/form-data">
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <!-- DATA TABLE-->
                                    <div class="table-responsive m-b-40">
                                        <table class="table table-borderless table-data2">
                                            <thead>
                                                <tr>
                                                    <th># de Expediente</th>
                                                    <th>Acción/Controversia</th>
                                                    <th>Actor/Demandado</th>
                                                    <th>Accionante</th>
                                                    <th>Estatus</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include("consulta_excel_print.php");
                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                    <!-- END DATA TABLE-->
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>

    <!--TERMINA DATOS A INGRESAR-->
    <br /><br /><br />
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>

    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#select-multiple').selectize({
                maxItems: null, // Permite múltiples selecciones
                create: false, // No permite la creación de nuevas opciones
                theme: 'default'
            });
            $('#select-multiple2').selectize({
                maxItems: null, // Permite múltiples selecciones
                create: false, // No permite la creación de nuevas opciones
                theme: 'default'
            });
            $('#select-multiple3').selectize({
                maxItems: null, // Permite múltiples selecciones
                create: false, // No permite la creación de nuevas opciones
                theme: 'default'
            });
            $('#select-multiple4').selectize({
                maxItems: null, // Permite múltiples selecciones
                create: false, // No permite la creación de nuevas opciones
                theme: 'default'
            });
            $('#select-multiple5').selectize({
                maxItems: null, // Permite múltiples selecciones
                create: false, // No permite la creación de nuevas opciones
                theme: 'default'
            });
            $('#select-multiple6').selectize({
                maxItems: null, // Permite múltiples selecciones
                create: false, // No permite la creación de nuevas opciones
                theme: 'default'
            });
            $('#select-multiple7').selectize({
                maxItems: null, // Permite múltiples selecciones
                create: false, // No permite la creación de nuevas opciones
                theme: 'default'
            });
        });

       

        document.getElementById("habilitarFechas").addEventListener("change", function() {
            var fechaCap = document.querySelector('input[name="FechaIn"]');
            var fechaIn = document.querySelector('input[name="FechaVen"]');
            if (this.checked) {
                fechaCap.disabled = false;
                fechaIn.disabled = false;
            } else {
                fechaCap.disabled = true;
                fechaIn.disabled = true;
            }
        });

        // Obtén las referencias a los elementos de fecha
        const fechaInInput = document.querySelector('input[name="FechaIn"]');
        const fechaVenInput = document.querySelector('input[name="FechaVen"]');

        // Agrega un evento para validar cuando cambie la fecha de vencimiento
        fechaVenInput.addEventListener('change', function() {
            const fechaIn = new Date(fechaInInput.value);
            const fechaVen = new Date(this.value);

            // Compara las fechas
            if (fechaVen < fechaIn) {
                alert('La fecha final no puede ser anterior a la fecha inicial de la busqueda.');
                this.value = ''; // Borra el valor de la fecha de vencimiento
            }
        });

        
   function SubmitFormData() 
   {
	 var FechaIn = $("#FechaIn").val();
	 var FechaVen = $("#FechaVen").val();
     
     $.post("ajaxRango.php", { FechaIn: FechaIn, FechaVen: FechaVen },
        function(data) {
            $('#results').html(data);
            $('#miFormulario')[0].reset();
        });
   }


       
    </script>
</body>

</html>