<?php
require_once('xcrud/xcrud.php');
require_once('config.php');
if (empty($_SESSION["id"])) {
    header("location: index.php");
}
$users = $_SESSION["id"];
$xcrud = Xcrud::get_instance();
$xcrud->buttons_position('left'); //posicion de los botones
$xcrud->table("captura");
$xcrud->relation('juicio_proced', 'cat_juicio', 'id', 't_juicio'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud->relation('estatus','cat_estatus', 'id', 'estatus','','','','','','relacion','juicio_proced'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud->relation('actores', 'cat_actor', 'id', 'actord'); //cuando hay un catalogo para mostrar el contenido no el id
//$xcrud->relation('estatus', 'cat_estatus', 'id', 'estatus', 'cat_estatus.status=1'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud->relation('abogado', 'cat_abogado', 'id', 'n_abogado', 'cat_abogado.estatus=1');
$xcrud->relation('ministro', 'cat_ministro', 'id', 'ministros'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud->relation('seguimiento', 'cat_seguimiento', 'id', 'seguimiento'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud->relation('prioridad', 'cat_prioridad', 'id', 'nivel'); //cuando hay un catalogo para mostrar el contenido no el id
//$xcrud->button('seguimiento_procedimiento.php?id={idcaptura}', 'Seguimiento', 'glyphicon glyphicon-file', '', array('target' => '_blank')); // crea un boton
$xcrud->unset_remove();
$xcrud->unset_edit();
$xcrud->unset_view();
$xcrud->unset_csv();
$xcrud->order_by('idcaptura', 'DESC'); // se agrega a la consulta
$xcrud->change_type('acuse', 'file', '', array('not_rename' => false)); //cambia el nombre del archivo subido
$xcrud->validation_required('fecha_cap'); //se hacen obligatorios
$xcrud->validation_required('fecha_ing'); //se hacen obligatorios
$xcrud->validation_required('num_exp'); //se hacen obligatorios
$xcrud->validation_required('num_int'); //se hacen obligatorios
$xcrud->validation_required('juicio_proced'); //se hacen obligatorios
$xcrud->validation_required('actores'); //se hacen obligatorios
$xcrud->validation_required('accionante'); //se hacen obligatorios
$xcrud->validation_required('estatus'); //se hacen obligatorios
$xcrud->validation_required('abogado'); //se hacen obligatorios
//$xcrud->validation_required('ministro'); //se hacen obligatorios
$xcrud->validation_required('asunto'); //se hacen obligatorios
$xcrud->validation_required('seguimiento'); //se hacen obligatorios
$xcrud->validation_required('prioridad'); //se hacen obligatorios
$xcrud->hide_button('save_return'); //esconde ese boton
$xcrud->hide_button('return');
$xcrud->pass_var('id_usuario', $users); // envia el usuario a la tabla de captura
$xcrud->set_logging(true); //guarda cada vez que se modifica en tabla logs
$xcrud->after_insert('alogs'); //despues de insertar el campo envia a funtions de /xcrud para realizar algo
$xcrud->fields('id_usuario', true); // esconde el id para que en captura no se muestre ni se edite
$xcrud->label('fecha_cap', 'Fecha de Captura');
$xcrud->label('fecha_ing', 'Fecha de Ingreso');
$xcrud->label('fecha_ven', 'Fecha de Vencimiento');
$xcrud->label('fecha_ses', 'Fecha de Sesión');
$xcrud->label('num_int', 'Número Interno');
$xcrud->label('num_exp', 'Número Expediente');
$xcrud->label('ministro', 'Ministro/Instructor');
$xcrud->label('juicio_proced', 'Juicio/Procedimiento');
$xcrud->label('acuse', 'Expediente PDF');
$xcrud->label('actores', 'Actor/Demandado');

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
    <!-- <script src="js/jquery-3.7.0.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script> -->
    <script src="js/bootstrap.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
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
    <style>
        .ars {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 80px 100px 5px;
            min-height: 400vh;
            align-content: top;
            padding: 45px;
        }

        .btn {
            background-color: #28A745 !important;
            /* Cambia el color de fondo del botón a azul */
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
                                <strong>Registrar</strong> Expediente
                            </div>
                            <div class="ars">
                                <?php
                                echo $xcrud->render('create'); //manda a la opcion de anexar automaticamente al inicio
                                ?>
                            </div>
                        </div>
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
    <!-- <script src="vendor/jquery-3.2.1.min.js"></script>-->
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
</body>

</html>