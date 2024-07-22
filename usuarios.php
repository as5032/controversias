<?php
error_reporting(0);
require_once('config.php');
require_once('xcrud/xcrud.php');
if (empty($_SESSION["id"])) {
    header("location: index.php");
}
$xcrud = Xcrud::get_instance();
$xcrud->buttons_position('left'); // Posicion de los botones
$xcrud->table("logins"); // tabla seleccionada
$xcrud->label('id', 'Id');
$xcrud->relation('tipo_usuario', 'cat_roles', 'id_roles', 'rol'); // Muestra la relacion con una tabla para no mostrar numericos
$xcrud->relation('status', 'cat_status', 'id_status', 'status'); // Muestra la relacion con una tabla para no mostrar numericos
$xcrud->set_logging(true);
$xcrud->after_insert('alogs');
$xcrud->after_update('alogs');
$xcrud->after_remove('alogs');
$xcrud->columns('usuario, contra, nombre_completo, tipo_usuario, status'); //es lo que se mostrará al inicio
$xcrud->fields('usuario, nombre_completo, contra, tipo_usuario, status', false); //es lo que se mostrará al editar y añadir
$xcrud->validation_required('usuario, nombre_completo, tipo_usuario, status'); //se hacen obligatorios
$xcrud->set_logging(true); //activa tabla logs
$xcrud->after_insert('alogs'); //despues de insertar el campo envia a funtions de /xcrud para añadir el usuario que hizo cambios
$xcrud->after_update('alogs'); //despues de actualizar el campo envia a funtions de /xcrud para añadir el usuario que hizo cambios
$xcrud->after_remove('alogs'); //despues de borrar el campo envia a funtions de /xcrud para añadir el usuario que hizo cambios
$xcrud->where('tipo_usuario<>1 AND id not in (1,2,14)'); //solo sistemas
$xcrud->hide_button('save_new');
$xcrud->hide_button('save_edit');
$xcrud->order_by('nombre_completo');
$xcrud->change_type('contra', 'password', 'md5');
$xcrud->label('tipo_usuario', 'Permisos');
$xcrud->label('status', 'Estado');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <link rel="icon" href="images/icon/libro.ico" type="image/ico" />
    <title>CACCC</title>
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/fontawesome-free-6.4.0/css/all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" media="screen" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="css/theme.css" rel="stylesheet" media="all">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400&display=swap');

        body {
            font-family: 'Quicksand', sans-serif;
        }

        .page-wrapper {
            background-color: white;
            height: 100vh;
        }

        .page-content--bge5 {
            background: #9F2241;
            height: 60vh;
        }
    </style>
</head>

<body>
    <?php
    include('plantilla.php');
    ?>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div id="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="au-card chart-percent-card">
                            <div class="au-card-inner">
                                <div class="card-header" style="font-size: 20px;">
                                    Administración de usuarios
                                </div>
                                <div class="row m-t-25">

                                    <div class="col-lg-4 col-lg-4">
                                    </div>
                                    <div class="col-lg-4 col-lg-4">
                                    </div>
                                    <div class="col-lg-11 col-lg-11" style="font-size: 14px;">
                                        <?php
                                        echo $xcrud->render();
                                        ?>
                                    </div>
                                    <div class="col-lg-4 col-lg-4">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        <script src="vendor/select2/select2.min.js">
        </script>
        <script src="js/main.js"></script>
</body>

</html>