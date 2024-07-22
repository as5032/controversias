<?php
require_once('config.php');
if (empty($_SESSION["id"])) {
    header("location: index.php");
}
require_once('config.php');
require_once('xcrud/xcrud.php');
$xcrud1 = Xcrud::get_instance();
$xcrud1->buttons_position('left'); //posicion de los botones
$xcrud1->table("logs");
$xcrud1->relation('updated_by', 'logins', 'id', 'usuario');
//$xcrud->relation('abogado', 'cat_abogado', 'id', 'n_abogado');
//$xcrud1->column_cut(150); // columnas separadas
//$xcrud1->column_width('data', '65%');
/*$xcrud1->columns("fecha, id_usuario, mensaje, documento"); // solo muestra las columnas descritas
$xcrud1->label('id_usuario', 'Usuario');*/
//$xcrud1->unset_remove();
//$xcrud1->unset_csv();
//$xcrud1->unset_view();
//$xcrud1->unset_edit();
/*$xcrud1->validation_required('mensaje'); //se hacen obligatorios
$xcrud1->relation('id_usuario', 'logins', 'id', 'usuario'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud1->fields('fecha', true); //evita que se edite este campo
$xcrud1->fields('id_usuario', true); //evita que se edite este campo
$xcrud1->fields('id_registro_afectado', true); //evita que se edite este campo
$xcrud1->fields('valor_anterior', true); //evita que se edite este campo
$xcrud1->fields('valor_nuevo', true); //evita que se edite este campo
$xcrud1->fields('campo_afectado', true); //evita que se edite este campo
$xcrud1->change_type('documento', 'file', '', array('not_rename' => false)); //despliega los archivos subidos
$xcrud1->label('mensaje', 'Observaciones');
$xcrud1->where('id_registro_afectado = ' . $id_captura);*/
$xcrud1->set_logging(true); //guarda cada vez que se modifica en tabla logs
$xcrud1->after_insert('alogs'); //despues de insertar el campo envia a funtions de /xcrud para realizar algo
$xcrud1->after_update('alogs'); //despues de insertar el campo envia a funtions de /xcrud para realizar algo
$xcrud1->after_remove('alogs'); //despues de insertar el campo envia a funtions de /xcrud para realizar algo
//$xcrud1->pass_var('id_usuario', $_SESSION["id"]); // pasa valores directo sin pasar por el formulario
//$xcrud1->pass_var('id_registro_afectado', $id_captura); // pasa valores directo sin pasar por el formulario*/

//$xcrud2->after_update('alogs'); //despues de insertar el campo envia a funtions de /xcrud para añadir el usuario que hizo cambios

//$_SESSION["id_captura_logs"] = $id_captura; /// se creo para logs pero el 23/04/2024 ya no se usa
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
            // Redireccionar al formulario específico
            window.location.href = "consulta_procedimientos.php";
        }
    </script>

    <style>
        .control-label {
            /* font-style: italic;*/
            font-weight: bold;
        }
    </style>


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
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
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
                                <strong>Seguimiento</strong> Expediente <?php // echo $id_captura; 
                                                                        ?>
                            </div>
                            <div class="card-body card-block h-100" style="font-size: 20px;">
                                <?php

                                //$xcrud2->fields_inline('fecha_cap,fecha_ing,fecha_ven,fecha_ses,num_int'); //set the fields to allow inline editing
                                //echo $xcrud2->render();
                                //echo $xcrud2->render(); // despliega la informacion directamente en view

                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 h-100">
                        <div class="card h-100">
                            <div class="card-header" style="font-size: 20px;">
                                <strong>Detalles</strong> Expediente
                            </div>
                            <div class="card-footer">
                                <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#largeModal">
                                    <i class="fas fa-plus"></i> Agregar observación
                                </button> -->
                            </div>
                            <div class="card-body card-block" style="font-size: 20px;">

                                <?php
                                echo $xcrud1->render();
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
    <!--TERMINA DATOS A INGRESAR-->
    <br /><br /><br />
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
    <!-- Jquery JS-->
    <!-- <script src="vendor/jquery-3.2.1.min.js"></script> -->
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
    <script src="vendor/select2/select2.min.js"></script>



    <!-- Main JS-->
    <script src="js/main.js"></script>
</body>

</html>