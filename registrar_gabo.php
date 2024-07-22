<?php
require_once('xcrud/xcrud.php');
require_once('config.php');
if (empty($_SESSION["id"])) {
    header("location: index.php");
}
$users = $_SESSION["usuarioars"];
$xcrud = Xcrud::get_instance();
$xcrud->buttons_position('left');
$xcrud->table("captura");
$xcrud->relation('juicio_proced', 'cat_juicio', 'id', 't_juicio');
$xcrud->relation('actores', 'cat_actor', 'id', 'actord');
$xcrud->relation('estatus', 'cat_estatus', 'id', 'estatus');
$xcrud->relation('abogado', 'cat_abogado', 'id', 'n_abogado');
$xcrud->relation('ministro', 'cat_ministro', 'id', 'ministros');
$xcrud->relation('seguimiento', 'cat_seguimiento', 'id', 'seguimiento');
$xcrud->relation('prioridad', 'cat_prioridad', 'id', 'nivel');
//$xcrud->button('seguimiento_procedimiento.php?id={idcaptura}', 'Seguimiento', 'glyphicon glyphicon-file', '', array('target' => '_blank'));
$xcrud->unset_remove();
$xcrud->unset_edit();
$xcrud->unset_view();
$xcrud->unset_csv();
$xcrud->order_by('idcaptura', 'DESC');
$xcrud->change_type('acuse', 'file', '', array('not_rename' => false));
$xcrud->validation_required('fecha_cap');
$xcrud->validation_required('fecha_ing');
$xcrud->validation_required('num_exp');
$xcrud->validation_required('num_int');
$xcrud->validation_required('juicio_proced');
$xcrud->validation_required('actores');
$xcrud->validation_required('accionante');
$xcrud->validation_required('estatus');
$xcrud->validation_required('abogado');
$xcrud->validation_required('ministro');
$xcrud->validation_required('asunto');
$xcrud->validation_required('seguimiento');
$xcrud->validation_required('prioridad'); 
$xcrud->hide_button('save_return');
$xcrud->hide_button('return');
$xcrud->set_logging(true);
$xcrud->after_insert('alogs');
$xcrud->fields('id_usuario', true);

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
            grid-template-rows: 80px 80px 80px;
            min-height: 400vh;
            align-content: top;
            padding: 20px;
    }
    .btn {
        background-color: #28A745 !important; /* Cambia el color de fondo del botón a azul */
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
                            <div class="card-header">
                                <strong>Registrar</strong> Expediente
                            </div>
                            <div class="ars">
                                <?php
                                echo $xcrud->render('create');
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