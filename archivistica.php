<?php
session_start();
    if (empty($_SESSION["id"])) {
        header("location: index.php");
    }
require_once('xcrud/xcrud.php');
$xcrud1 = Xcrud::get_instance();
$xcrud1->table("captura"); //TABLA
$xcrud2 = Xcrud::get_instance();
$xcrud2->table("archivo"); //TABLA
$xcrud1->relation('juicio_proced', 'cat_juicio', 'id', 't_juicio');
$xcrud1->relation('actores', 'cat_actor', 'id', 'actord');
$xcrud1->relation('estatus', 'cat_estatus', 'id', 'estatus', 'cat_estatus.status=1'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud1->relation('abogado', 'cat_abogado', 'id', 'n_abogado', 'cat_abogado.estatus=1');
$xcrud1->relation('ministro', 'cat_ministro', 'id', 'ministros');
$xcrud1->relation('seguimiento', 'cat_seguimiento', 'id', 'seguimiento');
$xcrud1->relation('prioridad', 'cat_prioridad', 'id', 'nivel');
$xcrud1->buttons_position('left'); 
$xcrud1->label('juicio_proced', 'Juicio Procedimiento');
$xcrud1->label('actores', 'Actor');
$xcrud1->label('fecha_cap', 'Fecha de Captura');
$xcrud1->label('fecha_ing', 'Fecha de Ingreso');
$xcrud1->label('fecha_ven', 'Fecha de Vencimiento');
$xcrud1->label('fecha_ses', 'Fecha de Sesión');
$xcrud1->label('num_exp', 'Número Expediente');
$xcrud1->label('num_int', 'Número Interno');
$xcrud1->label('ministro', 'Ministro Instructor');
$xcrud2->relation('tipo_controversia', 'cat_juicio', 'id', 't_juicio');
$xcrud1->fields('idcaptura,num_exp,num_int,juicio_proced,actores,accionante,estatus,abogado,ministro,asunto,seguimiento,prioridad,acuse,observaciones');
$xcrud1->disabled('idcaptura,num_exp,num_int,juicio_proced,actores,accionante,estatus,abogado,ministro,asunto,seguimiento,prioridad,acuse,observaciones'); 
$xcrud1->hide_button('save_new');
$xcrud1->hide_button('save_edit');
$xcrud1->hide_button('save_return');
$xcrud1->hide_button('return');
//$xcrud1->unset_remove();
$xcrud1->unset_title();
$xcrud2->buttons_position('left'); 
$xcrud2->hide_button('save_new');
$xcrud2->hide_button('save_edit');
//$xcrud2->hide_button('return');
$xcrud2->where('id_captura=',$_GET["id"]);
$xcrud2->set_logging(true); //guarda cada vez que se modifica en tabla logs
$xcrud2->fields('clasificador_judicial,fecha_final,estatus_archivo,fojas,soporte_documental,valor_documental,conservacion_tramite,conservacion_conservacion,INMUEBLE,MUEBLE,posicion,observaciones,descripcion,year');
$xcrud2->validation_required('clasificador_judicial,fecha_final,estatus_archivo,fojas,soporte_documental,valor_documental,conservacion_tramite,conservacion_conservacion,INMUEBLE,MUEBLE,posicion,observaciones,descripcion,year'); //se hacen obligatorios
$xcrud2->disabled('consecutivo,exp_judicial,clasificacion_archivistica,fecha_inicio,tipo_controversia');
$xcrud2->label('descripcion', 'Descripción');
$xcrud2->label('conservacion_tramite', 'Conservación/Trámite');
$xcrud2->label('conservacion_conservacion', 'Conservación');
$xcrud2->label('posicion', 'Posición');
$xcrud2->label('year', 'Año');
$ars=$_GET["id"];
require_once('conexion_db.php');
$sql = "SELECT * FROM captura WHERE idcaptura = $ars";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $exp = $row["num_exp"];
    $int = $row["num_int"];
    $asu = $row["asunto"];
    $fecha = $row["fech_cap"];
    $juicio = $row["juicio_proced"];
    mysqli_free_result($result);
$xcrud2->pass_var('id_captura',$_GET["id"]); // pasa valores directo sin pasar por el formulario
$xcrud2->pass_var('exp_judicial',$exp); // pasa valores directo sin pasar por el formulario
$xcrud2->pass_var('clasificacion_archivistica',$int); // pasa valores directo sin pasar por el formulario
$xcrud2->pass_var('descripcion',$asu); // pasa valores directo sin pasar por el formulario
$xcrud2->pass_var('fecha_inicio',$fecha); // pasa valores directo sin pasar por el formulario
$xcrud2->pass_var('tipo_controversia',$juicio); // pasa valores directo sin pasar por el formulario
$xcrud2->after_insert('alogs'); //despues de insertar el campo envia a funtions de /xcrud para realizar algo
$xcrud2->after_remove('alogs'); //despues de insertar el campo envia a funtions de /xcrud para realizar algo
$xcrud2->after_update('alogs'); //despues de insertar el campo envia a funtions de /xcrud para realizar algo

    // AQUI SE MARCAN LOS REGISTROS SIN DATO // 
/*    $xcrud1->highlight('acuse', '<', " ", 'F97171');
    $xcrud1->highlight('acuse', '>', " ", '#8DED79');
    $xcrud1->highlight('prioridad', '<', " ", 'F97171');
    $xcrud1->highlight('prioridad', '>', " ", '#8DED79');
    $xcrud1->highlight('asunto', '<', " ", 'F97171');
    $xcrud1->highlight('asunto', '>', " ", '#8DED79');
    $xcrud1->highlight('num_int', '<', " ", 'F97171');
    $xcrud1->highlight('num_int', '>', " ", '#8DED79');
    $xcrud1->highlight('observaciones', '<', " ", 'F97171');
    $xcrud1->highlight('observaciones', '>', " ", '#8DED79');
    $xcrud1->highlight('ministro', '<', 1, 'F97171');
    $xcrud1->highlight('ministro', '>', 1, '#8DED79');
    $xcrud1->highlight('accionante', '<', 1, 'F97171');
    $xcrud1->highlight('accionante', '>', 1, '#8DED79');
    */

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
    <script>
        function regresar() {
            // Redireccionar al formulario específico
            window.location.href = "consulta_procedimientos_con.php";
        }
    </script>


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
                                <strong>Consulta</strong> Archivistica
                            </div>
                            <div class="card-body" style="font-size: 18px;">
                                <?php 
                                echo $xcrud1->render('view',$_GET["id"]);
                                echo $xcrud2->render();
                                //echo $xcrud2->render('view',$_GET["id"]);
                                //echo $xcrud2->render('view',$_GET["id"]);?>
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