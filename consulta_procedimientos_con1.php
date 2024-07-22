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
        <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.6.0/dist/multiple-select.min.css">
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" media="screen" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
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
        <!-- <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all"> -->
        <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
        <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
        <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
        <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
        <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
        <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

        <!-- Main CSS-->
        <link href="css/theme.css" rel="stylesheet" media="all">

        <script src="js/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://unpkg.com/multiple-select@1.6.0/dist/multiple-select.min.js"></script>

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

    <body>
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
                                <div class="card-header" style="font-size: 20px;">
                                        <strong>Consulta</strong> Expedientes concluidos
                                    </div>
                                    <div class="card-body">

                                        <div class="tabla-responsiva" style="max-height: 600px; overflow-y: auto;">
                                            <div style="font-size: 17px;">
                                                Mostrar/Ocultar columnas:
                                            </div>
                                            <div style="font-size: 14px;">
                                                <a href="#" style="text-decoration: underline" class="toggle-vis" data-column="0">Id</a> -
                                                <a href="#" style="text-decoration: underline" class="toggle-vis" data-column="1">Fecha de captura</a> -
                                                <a href="#" style="text-decoration: underline" class="toggle-vis" data-column="2">Fecha de ingreso</a> -
                                                <a href="#" style="text-decoration: underline" class="toggle-vis" data-column="3">Fecha de vencimiento</a> -
                                                <a href="#" style="text-decoration: underline" class="toggle-vis" data-column="4"># de Expediente</a> -
                                                <a href="#" style="text-decoration: underline" class="toggle-vis" data-column="5"># Interno</a> -
                                                <a href="#" style="text-decoration: underline" class="toggle-vis" data-column="6">Juicio/Procedimiento</a> -
                                                <a href="#" style="text-decoration: underline" class="toggle-vis" data-column="7">Actor/Demandado</a>
                                            </div>
                                            <div style="font-size: 14px;">
                                                <a href="#" style="text-decoration: underline" class="toggle-vis" data-column="8">Accionante</a> -
                                                <a href="#" style="text-decoration: underline" class="toggle-vis" data-column="9">Estatus</a> -
                                                <a href="#" style="text-decoration: underline" class="toggle-vis" data-column="10">Abogado</a> -
                                                <a href="#" style="text-decoration: underline" class="toggle-vis" data-column="11">Ministro Instructor</a> -
                                                <a href="#" style="text-decoration: underline" class="toggle-vis" data-column="12">Asunto</a> -
                                                <a href="#" style="text-decoration: underline" class="toggle-vis" data-column="13">Seguimiento</a> -
                                                <a href="#" style="text-decoration: underline" class="toggle-vis" data-column="14">Prioridad</a> -
                                                <a href="#" style="text-decoration: underline" class="toggle-vis" data-column="15">Observaciones</a>
                                            </div>
                                            <br>
                                            <table id="example" class="table table-striped table-bordered hover" style="width:50%">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Fecha de captura</th>
                                                        <th>Fecha de ingreso</th>
                                                        <th>Fecha de vencimiento</th>
                                                        <th># de Expediente</th>
                                                        <th># Interno</th>
                                                        <th>Juicio/Procedimiento</th>
                                                        <th>Actor/Demandado</th>
                                                        <th>Accionante</th>
                                                        <th>Estatus</th>
                                                        <th>Abogado</th>
                                                        <th>Ministro instructor</th>
                                                        <th>Asunto</th>
                                                        <th>Seguimiento</th>
                                                        <th>Prioridad</th>
                                                        <th>Observaciones</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    require_once('conexion_db.php');

                                                    $query = "SELECT
                                                    captura.idcaptura,
                                                    captura.fecha_cap,
                                                    captura.fecha_ing,
                                                    captura.fecha_ven,
                                                    captura.num_exp,
                                                    captura.num_int,
                                                    cat_juicio.t_juicio AS juicio,
                                                    cat_actor.actord AS actor,
                                                    captura.accionante,
                                                    cat_estatus.estatus AS estatus,
                                                    cat_abogado.n_abogado AS abogado,
                                                    cat_ministro.ministros AS ministro,
                                                    captura.asunto,
                                                    cat_seguimiento.seguimiento AS seguimiento,
                                                    cat_prioridad.nivel AS prioridad,
                                                    captura.observaciones
                                                FROM
                                                    captura
                                                LEFT JOIN cat_estatus ON captura.estatus = cat_estatus.id
                                                LEFT JOIN cat_abogado ON captura.abogado = cat_abogado.id
                                                LEFT JOIN cat_juicio ON captura.juicio_proced = cat_juicio.id
                                                LEFT JOIN cat_actor ON captura.actores = cat_actor.id
                                                LEFT JOIN cat_seguimiento ON captura.seguimiento = cat_seguimiento.id
                                                LEFT JOIN cat_prioridad ON captura.prioridad = cat_prioridad.id
                                                LEFT JOIN cat_ministro ON captura.ministro = cat_ministro.id
                                                WHERE
												cat_estatus.estatus = 'CONCLUIDO';";
                                                    $result = mysqli_query($conn, $query);

                                                    // Verificamos la ejecución de la consulta
                                                    if (!$result) {
                                                        die("Error al ejecutar la consulta: " . mysqli_error($conn));
                                                    }

                                                    // Iteración de resultados
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<tr>";
                                                        echo "<th>" . $row['idcaptura'] . "</th>";
                                                        echo "<th>" . $row['fecha_cap'] . "</th>";
                                                        echo "<th>" . $row['fecha_ing'] . "</th>";
                                                        echo "<th>" . $row['fecha_ven'] . "</th>";
                                                        echo "<th>" . $row['num_exp'] . "</th>";
                                                        echo "<th>" . $row['num_int'] . "</th>";
                                                        echo "<th>" . $row['juicio'] . "</th>";
                                                        echo "<th>" . $row['actor'] . "</th>";
                                                        echo "<th>" . $row['accionante'] . "</th>";
                                                        echo "<th>" . $row['estatus'] . "</th>";
                                                        echo "<th>" . $row['abogado'] . "</th>";
                                                        echo "<th>" . $row['ministro'] . "</th>";
                                                        echo "<th>" . $row['asunto'] . "</th>";
                                                        echo "<th>" . $row['seguimiento'] . "</th>";
                                                        echo "<th>" . $row['prioridad'] . "</th>";
                                                        echo "<th>" . $row['observaciones'] . "</th>";
                                                        echo "<th>";
                                                                                                        echo '<div class="table-data-feature">';
                                                if ($_SESSION['tipo_usuario'] != '4') {
                                                    echo '<button class="item editar-button" data-toggle="tooltip" data-placement="top" title="Actualizar" onclick="editar(' . $row['idcaptura'] . ')">';
                                                    echo '<i class="zmdi zmdi-edit"></i>';
                                                    echo '</button>';
                                                }
                                                                                                        echo '<button class="item consulta-button" data-toggle="tooltip" data-placement="top" title="Seguimiento" onclick="consultar(' . $row['idcaptura'] . ')">';
                                                echo '<i class="far fa-file-alt"></i>';
                                                echo '</button>';
                                                        echo '</div>';
                                                        echo "</th>";
                                                        echo "</tr>";
                                                    }

                                                    // Liberamos los recursos
                                                    mysqli_free_result($result);
                                                    mysqli_close($conn);
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <br>
                                        <button id="limpiar-columnas" class="btn btn-danger btn-lg">
                                            <i class="fas fa-sync-alt"></i> Restablecer</button>
                                    </div>
                                </div>
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
        <!-- <script src="vendor/animsition/animsition.min.js"></script> -->
        <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
        </script>
        <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
        <script src="vendor/counter-up/jquery.counterup.min.js">
        </script>
        <script src="vendor/circle-progress/circle-progress.min.js"></script>
        <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="vendor/chartjs/Chart.bundle.min.js"></script>
        <script src="vendor/select2/select2.min.js">
        </script>

        <!-- Main JS-->
        <script src="js/main.js"></script>

        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

        <script>
            $(document).ready(function() {
                var table = $('table#example').DataTable({
                    info: true,
                    paging: true,
                    lengthMenu: [
                        [25, 50, 100, -1],
                        [25, 50, 100, 'All']
                    ],
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                    }
                });

                var columnStates = [];

                // Almacenar el estado inicial de las columnas
                table.columns().every(function() {
                    columnStates.push(this.visible());
                });

                document.querySelectorAll('a.toggle-vis').forEach((el) => {
                    el.addEventListener('click', function(e) {
                        e.preventDefault();

                        let columnIdx = e.target.getAttribute('data-column');
                        let column = table.column(columnIdx);
                        // Control para asegurar que al menos una columna esté visible
                        var visibleColumns = table.columns().visible().toArray();
                        if (visibleColumns.every(isVisible => !isVisible)) {
                            alert("No puedes ocultar todas las columnas.");
                        } else {
                            // Toggle the visibility
                            column.visible(!column.visible());
                        }
                    });
                });

                $('#limpiar-columnas').on('click', function() {
                    table.columns().every(function(index) {
                        this.visible(columnStates[index]);
                    });
                });
            });

            function editar(id, Fechacap, Fechaing, Fechaven, Numexp, Juicioproced, Actores, Accionante, Estatus, Abogado, Asunto, Seguimiento, Prioridad, Acuse, Observaciones) {
                // Redireccionar al formulario de edición con los valores del registro
                window.location.href = "editar_procedimientos.php?id=" + id;
            }

            function consultar(id, Fechacap, Fechaing, Fechaven, Numexp, Juicioproced, Actores, Accionante, Estatus, Abogado, Asunto, Seguimiento, Prioridad, Acuse, Observaciones) {
                // Redireccionar al formulario de edición con los valores del registro
                window.location.href = "seguimiento_procedimiento.php?id=" + id;
            }
        </script>
    </body>

    </html>