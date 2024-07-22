<?php
require_once('config.php');
if (empty($_SESSION["id"])) {
    header("location: index.php");
}
$id_captura = $_GET['id'];
require_once('xcrud/xcrud.php');
$xcrud1 = Xcrud::get_instance();
$xcrud1->unset_remove();
$xcrud1->table("captura");
$xcrud1->relation('juicio_proced', 'cat_juicio', 'id', 't_juicio'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud1->relation('estatus', 'cat_estatus', 'id', 'estatus', '', '', '', '', '', 'relacion', 'juicio_proced'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud1->relation('actores', 'cat_actor', 'id', 'actord'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud1->relation('abogado', 'cat_abogado', 'id', 'n_abogado', 'cat_abogado.estatus=1');
$xcrud1->relation('ministro', 'cat_ministro', 'id', 'ministros'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud1->relation('seguimiento', 'cat_seguimiento', 'id', 'seguimiento'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud1->relation('prioridad', 'cat_prioridad', 'id', 'nivel'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud1->label('fecha_cap', 'Fecha de Captura');
$xcrud1->label('fecha_ing', 'Fecha de Ingreso');
$xcrud1->label('fecha_ven', 'Fecha de Vencimiento');
$xcrud1->label('fecha_ses', 'Fecha de Sesión');
$xcrud1->label('num_int', 'Número Interno');
$xcrud1->label('num_exp', 'Número Expediente');
$xcrud1->label('ministro', 'Ministro/Instructor');
$xcrud1->label('juicio_proced', 'Juicio/Procedimiento');
$xcrud1->label('acuse', 'Expediente PDF');
$xcrud1->label('actores', 'Actor/Demandado');
$xcrud1->label('accionante', 'Accionante');
$xcrud1->label('abogado', 'Abogado');
$xcrud1->label('asunto', 'Asunto');
$xcrud1->label('prioridad', 'Prioridad');
$xcrud1->label('observaciones', 'Observaciones');
$xcrud1->label('estatus', 'Estatus');
$xcrud1->label('seguimiento', 'Seguimiento');
$xcrud1->fields('id_usuario', true); // esconde el campo para que en captura no se muestre ni se edite
$xcrud1->change_type('acuse', 'file', '', array('not_rename' => false)); //despliega los archivos subidos
$xcrud1->hide_button('return');
$xcrud1->hide_button('save_return');
$xcrud1->set_logging(true); //guarda cada vez que se modifica en tabla logs
$xcrud1->after_insert('alogs'); //despues de insertar el campo envia a funtions de /xcrud para añadir el usuario que hizo cambios
$xcrud1->fields('id_captura', true); //evita que se edite este campo
$xcrud2 = Xcrud::get_instance();
$xcrud2->buttons_position('left'); //posicion de los botones
$xcrud2->table("registro_cambios");
$xcrud2->columns("fecha, id_usuario, mensaje, documento"); // solo muestra las columnas descritas
$xcrud2->label('id_usuario', 'Usuario');
$xcrud2->unset_remove();
$xcrud2->unset_csv();
//$xcrud2->unset_view();
$xcrud2->unset_edit();
$xcrud2->validation_required('mensaje'); //se hacen obligatorios
$xcrud2->relation('id_usuario', 'logins', 'id', 'usuario'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud2->fields('fecha', true); //evita que se edite este campo
$xcrud2->fields('id_usuario', true); //evita que se edite este campo
$xcrud2->fields('id_registro_afectado', true); //evita que se edite este campo
$xcrud2->fields('valor_anterior', true); //evita que se edite este campo
$xcrud2->fields('valor_nuevo', true); //evita que se edite este campo
$xcrud2->fields('campo_afectado', true); //evita que se edite este campo
$xcrud2->change_type('documento', 'file', '', array('not_rename' => false)); //despliega los archivos subidos
$xcrud2->label('mensaje', 'Observaciones');
$xcrud2->where('id_registro_afectado = ' . $id_captura);
$xcrud2->order_by('fecha', 'desc');
$xcrud2->set_logging(true); //guarda cada vez que se modifica en tabla logs
$xcrud2->after_insert('alogs'); //despues de insertar el campo envia a funtions de /xcrud para realizar algo
$xcrud2->after_update('alogs'); //despues de insertar el campo envia a funtions de /xcrud para realizar algo
$xcrud2->pass_var('id_usuario', $_SESSION["id"]); // pasa valores directo sin pasar por el formulario
$xcrud2->pass_var('id_registro_afectado', $id_captura); // pasa valores directo sin pasar por el formulario
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
            window.location.href = "inicial.php";
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
    <?php
    include('plantilla.php');
    ?>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 h-100">
                        <div class="card h-100">
                            <div class="card-header" style="font-size: 20px;">
                                <strong>Seguimiento</strong> Expediente
                            </div>
                            <div class="card-body card-block h-100" style="font-size: 20px;">
                                <?php
                                echo $xcrud1->render('view', $id_captura); // despliega la informacion directamente en view
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
                                echo $xcrud2->render();
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
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form name="id" action="registrar_cambios.php?id=<?php echo $id_captura; ?>" method="POST" class="h-100" id="cambios-registros" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel" style="color: black">
                            Observaciones/Documentos
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?php echo $id_captura; ?>">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="textarea-input" class="control-label mb-1">Observaciones</label>
                                    <textarea name="Comentario" id="textarea-input" rows="8" placeholder="Agregue comentarios..." class="form-control" style="resize: none; font-size: 16px;" oninput="this.value = this.value.toUpperCase()"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9">
                                <div class="form-group">
                                    <label for="file-input" class="control-label mb-1">Documento</label>
                                    <input type="file" name="Documento" id="file-input" class="form-control-file" style="font-size: 16px;" accept=".pdf, .jpg, .jpeg, .png">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-lg" name="registro">
                            <i class="fa fa-dot-circle-o"></i>
                            Guardar
                        </button>
                    </div>
                </form>
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
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            new DataTable('#example', {
                info: true,
                paging: true,
                lengthMenu: [
                    [25, 30, 50, -1],
                    [25, 30, 50, 'All']
                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                }
            });
        });
    </script>
</body>

</html>