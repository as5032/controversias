<?php
require_once('config.php');
if (empty($_SESSION["id"])) {
    header("location: index.php");
}
require_once('config.php');
require_once('xcrud/xcrud.php');
$xcrud = Xcrud::get_instance();
$xcrud->buttons_position('left'); //posicion de los botones
$xcrud->table("logs");
$xcrud->relation('updated_by', 'logins', 'id', 'usuario');
$xcrud->unset_add();
$xcrud->set_logging(true); //guarda cada vez que se modifica en tabla logs
$xcrud->after_insert('alogs'); //despues de insertar el campo envia a funtions de /xcrud para realizar algo
$xcrud->after_update('alogs'); //despues de insertar el campo envia a funtions de /xcrud para realizar algo
$xcrud->after_remove('alogs'); //despues de insertar el campo envia a funtions de /xcrud para realizar algo
$xcrud->label('table_name', 'Tabla');
$xcrud->label('action', 'Acción');
$xcrud->label('updated_by', 'Hecho por');
$xcrud->label('updated', 'Fecha');
$xcrud->label('record_id', 'Id del Registro');
$xcrud->label('data', 'Dato');
$xcrud->label('old_record', 'Dato Anterior');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" media="screen" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function regresar() {
            window.location.href = "consulta_procedimientos.php";
        }
    </script>
    <style>
        .control-label {
            font-weight: bold;
        }
    </style>
    <link rel="icon" href="images/icon/libro.ico" type="image/ico" />
    <title>CACCC</title>
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/fontawesome-free-6.4.0/css/all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="css/theme.css" rel="stylesheet" media="all">
</head>
<body>
    <?php include('plantilla.php'); ?>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 h-100">
                        <div class="card h-100">
                            <div class="card-header" style="font-size: 20px;">
                                <strong>Tabla </strong>Registro de Uso
                            </div>
                            <div class="card-body card-block h-100" style="font-size: 20px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 h-100">
                        <div class="card h-100">
                            <div class="card-header" style="font-size: 20px;">
                                <strong>Detalles</strong>
                            </div>
                            <div class="card-footer">
                                <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#largeModal">
                                    <i class="fas fa-plus"></i> Agregar observación
                                </button> -->
                            </div>
                            <div class="card-body card-block" style="font-size: 20px;">
                                <?php
                                echo $xcrud->render();
                                ?>
                            </div>
                            <div class="card-footer">
                                <button type="reset" class="btn btn-danger btn-lg" onclick="regresar()">
                                    <i class="fas fa-arrow-left"></i> Regresar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br /><br /><br />
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
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
    <script src="vendor/select2/select2.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>