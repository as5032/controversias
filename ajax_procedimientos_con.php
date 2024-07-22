<?php
require_once('xcrud/xcrud.php');
$xcrud1 = Xcrud::get_instance();
$xcrud1->buttons_position('left'); //posicion de los botones
$xcrud1->table("captura");
$xcrud1->relation('juicio_proced', 'cat_juicio', 'id', 't_juicio'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud1->relation('actores', 'cat_actor', 'id', 'actord'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud1->relation('estatus', 'cat_estatus', 'id', 'estatus'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud1->relation('abogado', 'cat_abogado', 'id', 'n_abogado'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud1->relation('ministro', 'cat_ministro', 'id', 'ministros'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud1->relation('seguimiento', 'cat_seguimiento', 'id', 'seguimiento'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud1->relation('prioridad', 'cat_prioridad', 'id', 'nivel'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud1->label('juicio_proced', 'Juicio/Procedimiento');
$xcrud1->label('idcaptura', 'Id');
$xcrud1->label('actores', 'Actor/Demandado');
$xcrud1->label('fecha_cap', 'Fecha Captura');
$xcrud1->label('fecha_ing', 'Fecha Ingreso');
$xcrud1->label('fecha_ven', 'Fecha Vencimiento');
$xcrud1->label('fecha_ses', 'Fecha Sesión');
$xcrud1->label('num_exp', 'Número Expediente');
$xcrud1->label('num_int', 'Número Interno');
$xcrud1->label('ministro', 'Ministro/Instructor');
$xcrud1->label('acuse', 'Expediente PDF');
$xcrud1->change_type('acuse', 'file', '', array('not_rename' => false)); //cambia el nombre del archivo subido
$xcrud1->button('seguimiento_procedimiento.php?id={idcaptura}', 'Seguimiento', '<i class="fa-solid fa-bars"></i>', '', array('target' => '_self'));
$xcrud1->button('archivistica.php?id={idcaptura}', 'Archivistica', '<i class="btn btn-danger btn-lg"></i>', '', array('target' => '_self'));
//class="btn btn-danger btn-lg"
//botones de control
$xcrud1->unset_remove();
$xcrud1->unset_add();
$xcrud1->unset_csv();
//$xcrud1->unset_view();
$xcrud1->hide_button('save_new');
$xcrud1->hide_button('save_edit');
$xcrud1->where('estatus = 16');
$xcrud1->set_logging(true); //guarda cada vez que se modifica en tabla logs
$xcrud1->after_update('alogs'); //despues de insertar el campo envia a funtions de /xcrud para añadir el usuario que hizo cambios
//columnas editar
//$xcrud1->fields('acuse, observaciones', false, '1'); //evita que se edite este campo
$xcrud1->fields('idcaptura, fecha_cap, fecha_ing, fecha_ven, fecha_ses, num_exp, num_int, juicio_proced, actores, accionante, abogado, asunto, seguimiento, prioridad, acuse, estatus, ministro, acuse, observaciones',false); 
$xcrud1->disabled('idcaptura, fecha_cap, fecha_ing, fecha_ven, fecha_ses, num_exp, num_int, juicio_proced, actores, accionante, abogado, asunto, seguimiento, prioridad,  estatus, estatus, ministro'); 
$xcrud1->validation_required('observaciones'); //se hacen obligatorios
//$xcrud1->columns('id_usuario', true);
/*foreach ($_POST as $campo => $valor) {
    echo "-->" . $campo . " = " . $valor;
}*/
if (isset($_POST["columnName"])) { //si presiono un boton
    $opciones = $_POST["columnName"]; //asigna a opciones el boton seleccionado
    $columnas_quitadas = isset($_SESSION["columnas"]) ? explode("/", $_SESSION["columnas"]) : [];
    if (($key = array_search($opciones, $columnas_quitadas)) !== false) {
        unset($columnas_quitadas[$key]);
    } else {
        $columnas_quitadas[] = $opciones;
    }
    $_SESSION["columnas"] = implode("/", $columnas_quitadas);
    $columnas_mostradas = empty($_SESSION["columnas"]) ? "" : str_replace("/", ",", $_SESSION["columnas"]);
    $Mostrar = "fecha_cap, fecha_ing, fecha_ven, fecha_ses, num_exp, num_int, juicio_proced, actores, accionante, estatus, 
        abogado, ministro, asunto, seguimiento, prioridad, acuse, observaciones, id_usuario"; //puedes quitar de aqui alguna coluna para que no se muestre la primera vez ni se quite
    // Construir las columnas a quitar de variable mostrar
    $columnas_a_quitar = array_diff([
        "idcaptura",
        "fecha_cap", // puedes quitar alguno para que no desaparezca
        "fecha_ing",
        "fecha_ven",
        "fecha_ses",
        "num_exp",
        "num_int",
        "juicio_proced",
        "actores",
        "accionante",
        "estatus",
        "abogado",
        "ministro",
        "asunto",
        "seguimiento",
        "prioridad",
        "acuse",
        "observaciones",
        "id_usuario", // para poder quitar este ultimo elemento falta codigo ya que no se pone la ultima coma
    ], explode(",", $columnas_mostradas));
    // Quitar las columnas de la consulta SQL
    foreach ($columnas_a_quitar as $columna) {
        $Mostrar = str_replace("$columna,", '', $Mostrar);
        $Mostrar = str_replace(",$columna", '', $Mostrar);
    }
    $xcrud1->columns($Mostrar);

    // Establecer la sesión de columnas si no existe
    if (!isset($_SESSION["columnas"])) {
        $_SESSION["columnas"] = "";
    }
}
//print_r($_SESSION["columnas"]);
?>
<style>
    #mi-div {
        text-align: center;
    }

    .titulo-h2 {
        color: #333;
        font-size: 15px;
        font-weight: bold;
        margin-bottom: 10px;
    }
</style>
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 h-100">
                <?php // echo "<h2 class='titulo-h2'>Se encontraron " . $cuantos . " registros</h2>"; 
                ?>
                <div class="card h-100" style="font-size: 20px;">
                    <div class="card-body card-block h-100">
                        <div class="row">
                            <div class="col-3">
                            </div>
                        </div>
                        <?php
                        echo $xcrud1->render();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>