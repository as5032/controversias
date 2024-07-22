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
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" />
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="images/icon/logo-mini2.png" alt="CRUD" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li>
                            <a href="inicial.php">
                                <i class="fa-solid fa-door-open"></i>Menú Principal</a>
                        </li>
                        <li>
                            <a href="registrar_procedimientos.php">
                                <i class="fa-solid fa-clipboard-user"></i>Registro de
                                Expediente</a>
                        </li>
                        <li>
                            <a href="consulta_procedimientos.php">
                                <i class="fas fa-clipboard-check"></i>Consulta de
                                Expedientes</a>
                        </li>
                        <li>
                            <a href="consulta_procedimientos_con.php">
                                <i class="fas fa-clipboard-check"></i>Consulta de
                                Expedientes concluidos</a>
                        </li>
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Informes</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li class="active">
                                    <a href="informes_exp.php">Informes por abogado</a>
                                </li>
                                <li>
                                    <a href="informes_esta.php">Informes por estatus</a>
                                </li>
                                <li>
                                    <a href="informes_seg.php">Informes por seguimiento</a>
                                </li>
                                <li>
                                    <a href="informes_prio.php">Informes por prioridad</a>
                                </li>
                                <li>
                                    <a href="informes_actor.php">Informes por actor/demandado</a>
                                </li>
                                <li>
                                    <a href="informes_juicio.php">Informes por juicios</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->
        <!-- MENU SIDEBAR-->
        <aside class=" menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="images/icon/logo-mini2.png" alt="CRUD Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="inicial.php">
                                <i class="fa-solid fa-door-open"></i>Menú Principal</a>
                        </li>
                        <li>
                            <a href="registrar_procedimientos.php">
                                <i class="fa-solid fa-clipboard-user"></i>Registro de
                                Expediente</a>
                        </li>
                        <li>
                            <a href="consulta_procedimientos.php">
                                <i class="fa-solid fa-book-open"></i></i>Consulta de
                                Expedientes</a>
                        </li>
                        <li>
                            <a href="consulta_procedimientos_con.php">
                                <i class="fas fa-clipboard-check"></i>Consulta de
                                Expedientes concluidos</a>
                        </li>
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Informes</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="informes_exp.php">Informes por abogado</a>
                                </li>
                                <li>
                                    <a href="informes_esta.php">Informes por estatus</a>
                                </li>
                                <li>
                                    <a href="informes_seg.php">Informes por seguimiento</a>
                                </li>
                                <liclass="active">
                                    <a href="informes_prio.php">Informes por prioridad</a>
                                </li>
                                <li>
                                    <a href="informes_actor.php">Informes por actor/demandado</a>
                                </li>
                                <li>
                                    <a href="informes_juicio.php">Informes por juicios</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->
        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image d-flex align-items-center">
                                            <img src="images/icon/user.png" class="img-circle profile_img">
                                        </div>
                                        <div class="content">
                                            <?php
                                            echo '<span style="font-size: 16px; color: #bc955c;">Bienvenid@,</span>';
                                            ?>
                                            <h2 style="font-size: 16px;">
                                                <?php echo $_SESSION["nombre"]; ?>
                                            </h2>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img img src="images/icon/user.png"
                                                            class="img-circle profile_img">
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <h2 style="font-size: 16px;">
                                                            <?php echo $_SESSION["nombre"]; ?>
                                                        </h2>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="cerrar_sesion.php">
                                                    <i class="zmdi zmdi-power"></i>Salir</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

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
                                        <form action="" method="POST" class="h-100" id="miFormulario"
                                            enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="select-dddmultiple"
                                                            class="control-label mb-1">Prioridad<span
                                                                class="required-field">*</span></label>
                                                        <select id="select-multiple" name="Prioridad[]" multiple required>
                                                            <option value="" disabled selected>Seleccione una o más opciones</option>
                                                            <?php
                                                            // Incluye tu archivo de conexión a la base de datos
                                                            require_once 'conexion_db.php';

                                                            // Consulta SQL para obtener datos de la tabla cat_abogado
                                                            $sql = "SELECT * FROM cat_prioridad";

                                                            $resultado = $conn->query($sql);

                                                            if ($resultado->num_rows > 0) {
                                                                // Si hay resultados, itera a través de ellos
                                                                while ($fila = $resultado->fetch_assoc()) {
                                                                    // Accede a los campos de la fila
                                                                    $id = $fila['id'];
                                                                    $nombre = $fila['nivel'];

                                                                    // Imprime las opciones permitiendo la selección múltiple
                                                                    echo '<option value="' . $fila['id'] . '">' . $fila['nivel'] . '</option>';
                                                                }
                                                            } else {
                                                                echo "No se encontraron registros en la tabla cat_prioridad.";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="date-input" class="control-label mb-1">Rango de
                                                            fecha</label>
                                                        <input type="checkbox" id="habilitarFechas">
                                                        <input type="date" id="FechaIn" name="FechaIn"
                                                            class="form-control" style="font-size: 16px;" disabled>
                                                        <label for="date-input" class="control-label mb-1">a</label>
                                                        <input type="date" id="FechaVen" name="FechaVen"
                                                            class="form-control" style="font-size: 16px;" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success btn-lg" name="Find">
                                                <i class="fas fa-search"></i> Buscar
                                            </button>
                                            <button type="reset" class="btn btn-danger btn-lg" onclick="borrarDatos()">
                                                <i class="fa fa-ban"></i> Limpiar
                                            </button>
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
                                <form action="" method="POST" class="h-100" id="miFormulario"
                                    enctype="multipart/form-data">
                                    <div class="row m-t-30">
                                        <div class="col-md-12">
                                            <!-- DATA TABLE-->
                                            <div class="table-responsive m-b-40">
                                                <table class="table table-borderless table-data3">
                                                    <thead>
                                                        <tr>
                                                            <th>Prioridad</th>
                                                            <th>Cantidad de Expedientes</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (isset($_POST['Find'])) {
                                                            require_once 'conexion_db.php';

                                                            $sql = "SELECT 
                                                                cat_prioridad.nivel AS prioridad_nombre,
                                                                COUNT(*) AS total_prioridad
                                                            FROM 
                                                                captura
                                                            LEFT JOIN cat_prioridad ON captura.prioridad = cat_prioridad.id
                                                            WHERE 1 = 1";

                                                            if (!empty($_POST['Prioridad'])) {
                                                                $prioridad_seleccionados = $_POST['Prioridad'];
                                                                $prioridad_filtro = implode(",", $prioridad_seleccionados);
                                                                $sql .= " AND captura.prioridad IN ($prioridad_filtro)";
                                                            }

                                                            if (!empty($_POST['FechaIn']) && !empty($_POST['FechaVen'])) {
                                                                $fecha_inicio = $_POST['FechaIn'];
                                                                $fecha_final = $_POST['FechaVen'];
                                                                $sql .= " AND captura.fecha_cap BETWEEN '$fecha_inicio' AND '$fecha_final'";
                                                            }

                                                            $sql .= " GROUP BY cat_prioridad.nivel";

                                                            $resultado = $conn->query($sql);

                                                            if ($resultado->num_rows > 0) {
                                                                while ($fila = $resultado->fetch_assoc()) {
                                                                    $prioridad = $fila['prioridad_nombre'];
                                                                    $total_prioridad = $fila['total_prioridad'];
                                                                    echo '<tr>
                                                                    <td>' . $prioridad . '</td>
                                                                    <td class="denied">' . $total_prioridad . '</td>
                                                                </tr>';
                                                                $showPrintButton = true;
                                                                }
                                                            } else {
                                                                echo '<tr><td colspan="4">No se encontraron datos para los registros seleccionados.</td></tr>';
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- END DATA TABLE-->
                                            <?php if (isset($showPrintButton) && $showPrintButton === true): ?>
                                                <!-- Botón de impresión -->
                                                <div class="section__content section__content--p40">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-lg-12 h-100">
                                                                <button type="button"
                                                                    class="btn btn-outline-primary btn-lg">
                                                                    <i class="fas fa-print"></i> Imprimir
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
            $(document).ready(function () {
                $('#select-multiple').selectize({
                    maxItems: null, // Permite múltiples selecciones
                    create: false, // No permite la creación de nuevas opciones
                    theme: 'default'
                });
            });

            function borrarDatos() {
                var textboxes = document.querySelectorAll("input[type='file'], input[type='date'], input[type='text'], input[type='checkbox']");
                textboxes.forEach(function (textbox) {
                    textbox.value = "";
                });

                // Desactivar los campos de fecha
                document.getElementById("FechaIn").disabled = true;
                document.getElementById("FechaVen").disabled = true;

                // Borrar valores del Selectize
                var selectize = $('#select-multiple')[0].selectize;
                selectize.clear();
            }

            document.getElementById("habilitarFechas").addEventListener("change", function () {
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
            fechaVenInput.addEventListener('change', function () {
                const fechaIn = new Date(fechaInInput.value);
                const fechaVen = new Date(this.value);

                // Compara las fechas
                if (fechaVen < fechaIn) {
                    alert('La fecha final no puede ser anterior a la fecha inicial de la busqueda.');
                    this.value = ''; // Borra el valor de la fecha de vencimiento
                }
            });
        </script>




</body>

</html>