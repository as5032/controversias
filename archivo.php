<?php

require_once('xcrud/xcrud.php');
$xcrud = Xcrud::get_instance();
Xcrud_config::$search_on_typing = true;
$xcrud->table("archivo"); //TABLA
$xcrud->columns('id_captura, consecutivo, year, tipo_controversia, clasificador_judicial, clasificacion_archivistica, descripcion, fecha_inicio, fecha_final, 
    estatus_archivo, observaciones, fojas, soporte_documental, valor_documental, conservacion_tramite, conservacion_conservacion, INMUEBLE, MUEBLE, posicion');
//$xcrud->inline_edit_click('double_click');
$xcrud->relation('soporte_documental', 'cat_soporte', 'id', 'soporte');
$xcrud->relation('tipo_controversia', 'cat_juicio', 'id', 't_juicio');
$xcrud->label('year','Año');
$xcrud->label('clasificacion_archivistica','Clasificación archivística');
$xcrud->label('descripcion','Descripción');
$xcrud->label('conservacion_tramite','Conservación/trámite');
$xcrud->label('conservacion_conservacion','Conservación');
$xcrud->label('posicion','Posición');
$xcrud->buttons_position('left'); 
$xcrud->label('year', 'Año');
$xcrud->unset_add();
$xcrud->unset_edit();
$xcrud->unset_remove();
$xcrud->unset_view();
//$xcrud->unset_limitlist();
//$xcrud->unset_numbers();
//$xcrud->unset_pagination();
$xcrud->unset_title();
//$xcrud->unset_sortable();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />



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
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

    <!-- <script src="js/jquery-3.7.0.min.js"></script> -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script> -->

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://unpkg.com/multiple-select@1.6.0/dist/multiple-select.min.js"></script>

</head>

<body>
    <?php
    include('plantilla.php');

    require_once('config.php');
    ?>

    <!--INICIA DATOS A INGRESAR-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 h-100">
                        <div class="card h-100">
                            <div class="card-header" style="font-size: 20px" ;>
                                <strong>Consulta</strong> Archivo
                            </div>
                            <div class="card-body" style="font-size: 18px;">
                                <?php 
                                echo $xcrud->render(); ?>

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
    <!-- Jquery JS-->
    <!-- <script src="vendor/jquery-3.2.1.min.js"></script>  ///  QUITA ESTE PARA XCRUD -->
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
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script> -->
</body>

</html>