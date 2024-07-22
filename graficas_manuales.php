<?php
error_reporting(0);
require_once('xcrud/xcrud.php');
require_once('config.php');
if (empty($_SESSION["id"])) {
    header("location: index.php");
}
$xcrud1 = xcrud::get_instance();
$xcrud1->buttons_position('left');
$xcrud1->table("actividades");
$xcrud1->unset_csv();
$xcrud1->unset_print();

$xcrud2 = xcrud::get_instance();
$xcrud2->buttons_position('left');
$xcrud2->table("normas");
$xcrud2->unset_csv();
$xcrud2->unset_print();

$xcrud3 = xcrud::get_instance();
$xcrud3->buttons_position('left');
$xcrud3->table("etiquetas");
$xcrud3->unset_csv();
$xcrud3->unset_print();
$xcrud3->label('texto1_1','Gráfica1 Texto Arriba');
$xcrud3->label('texto1_2', 'Gráfica1 Texto Abajo');
$xcrud3->label('texto2_1', 'Gráfica2 Texto Arriba');
$xcrud3->label('texto2_2', 'Gráfica2 Texto Abajo');
$xcrud3->label('texto3_1', 'Gráfica3 Texto Arriba');
$xcrud3->label('texto3_2', 'Gráfica3 Texto Abajo');
$xcrud3->label('texto4_1', 'Gráfica4 Texto Arriba');
$xcrud3->label('texto4_2', 'Gráfica4 Texto Abajo');
$xcrud3->label('texto5_1', 'Gráfica5 Texto Arriba');
$xcrud3->label('texto5_2', 'Gráfica5 Texto Abajo');
$xcrud3->label('texto6_1', 'Gráfica6 Texto Arriba');
$xcrud3->label('texto6_2', 'Gráfica6 Texto Abajo');
$xcrud3->label('texto7_1', 'Gráfica7 Texto Arriba');
$xcrud3->label('texto7_2', 'Gráfica7 Texto Abajo');
$xcrud3->label('texto8_1', 'Gráfica8 Texto Arriba');
$xcrud3->label('texto8_2', 'Gráfica8 Texto Abajo');
$xcrud3->label('texto9_1', 'Gráfica9 Texto Arriba');
$xcrud3->label('texto9_2', 'Gráfica9 Texto Abajo');
$xcrud3->unset_remove();
$xcrud3->unset_add();
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
    <link href="css/theme.css" rel="stylesheet" media="all">
    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/multiple-select@1.6.0/dist/multiple-select.min.js"></script>
</head>

<body>
    <?php
    include('plantilla.php');
    ?>
    <div class="main-content">
        <div class="container-fluid">
            <div class="card h-200">
                <div class="card-header" style="font-size: 20px;">
                    <strong>Gráficas</strong> Manuales
                </div>
                <div class="card-body" style="font-size: 20px;">
                    <?php
                    echo $xcrud1->render();
                    echo $xcrud2->render();
                    echo $xcrud3->render();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
    <!-- Jquery JS-->
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
    <script src="vendor/select2/select2.min.js">
    </script>
    <script src="js/main.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
</body>
</html>