<?php
session_start();
require_once('xcrud/xcrud.php');
error_reporting(0);
$xcrud = Xcrud::get_instance();
$xcrud->table("captura");
$xcrud->relation('juicio_proced', 'cat_juicio', 'id', 't_juicio'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud->relation('actores', 'cat_actor', 'id', 'actord'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud->relation('estatus', 'cat_estatus', 'id', 'estatus'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud->relation('abogado', 'cat_abogado', 'id', 'n_abogado'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud->relation('ministro', 'cat_ministro', 'id', 'ministros'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud->relation('seguimiento', 'cat_seguimiento', 'id', 'seguimiento'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud->relation('prioridad', 'cat_prioridad', 'id', 'nivel'); //cuando hay un catalogo para mostrar el contenido no el id

$xcrud->change_type('acuse', 'file', '', array('not_rename'=>true));
$xcrud->unset_remove();
$xcrud->unset_add();
$xcrud->unset_edit();
$xcrud->unset_csv();
$xcrud->change_type('acuse', 'file', '', array('not_rename' => true));
$xcrud->label('juicio_proced','Juicio Procedimiento');
$xcrud->label('actores','Actor');
$xcrud->label('fecha_cap','Fecha Captura');
$xcrud->label('fecha_ing','Fecha Ingreso');
$xcrud->label('fecha_ven','Fecha Vencimiento');
$xcrud->label('num_exp','Número Expediente');
$xcrud->label('num_int','Número Interno');
$xcrud->label('ministro','Ministro Instructor');
/*foreach ($_POST as $campo => $valor) {
    echo "-->" . $campo . " = " . $valor;
}*/

/*if (isset($_POST["columnName"])) { //si presiono un boton
    $opciones = $_POST["columnName"]; //asigna a opciones el boton seleccionado
    $columnas_quitadas = isset($_SESSION["columnas"]) ? explode("/", $_SESSION["columnas"]) : []; 
    if (($key = array_search($opciones, $columnas_quitadas)) !== false) {
        unset($columnas_quitadas[$key]);
    } else {
        $columnas_quitadas[] = $opciones;
    }
    $_SESSION["columnas"] = implode("/", $columnas_quitadas);
    $columnas_mostradas = empty($_SESSION["columnas"]) ? "" : str_replace("/", ",", $_SESSION["columnas"]);
    $qry2 = "SELECT 
    idcaptura AS Id, 
    fecha_cap AS Fecha_captura, 
    fecha_ing AS Fecha_ingreso, 
    fecha_ven AS Fecha_vencimiento, 
    num_exp AS Número_expediente, 
    num_int AS Número_interno, 
    cat_juicio.t_juicio AS Juicio_Procedimiento, 
    cat_actor.actord AS Actor_demandado, 
    accionante, 
    cat_estatus.estatus, 
    cat_abogado.n_abogado AS Abogado, 
    cat_ministro.ministros AS Ministro_instructor, 
    asunto, 
    cat_seguimiento.seguimiento, 
    cat_prioridad.nivel AS Prioridad, 
    acuse, 
    observaciones
FROM 
    captura
INNER JOIN 
    cat_estatus ON captura.estatus = cat_estatus.id
INNER JOIN 
    cat_abogado ON captura.abogado = cat_abogado.id
INNER JOIN 
    cat_ministro ON captura.ministro = cat_ministro.id
INNER JOIN 
    cat_prioridad ON captura.prioridad = cat_prioridad.id
INNER JOIN 
    cat_seguimiento ON captura.seguimiento = cat_seguimiento.id
INNER JOIN 
    cat_juicio ON captura.juicio_proced = cat_juicio.id
INNER JOIN 
    cat_actor ON captura.actores = cat_actor.id 
WHERE 
    captura.estatus = 16";
    // Construir las columnas a quitar de la consulta SQL
    $columnas_a_quitar = array_diff([
        "idcaptura AS Id",
        "fecha_cap AS Fecha_captura",
        "fecha_ing AS Fecha_ingreso",
        "fecha_ven AS Fecha_vencimiento",
        "num_exp AS Número_expediente",
        "num_int AS Número_interno",
        "cat_juicio.t_juicio AS Juicio_Procedimiento",
        "cat_actor.actord AS Actor_demandado",
        "accionante",
        "cat_estatus.estatus",
        "cat_abogado.n_abogado AS Abogado",
        "cat_ministro.ministros AS Ministro_instructor",
        "asunto",
        "cat_seguimiento.seguimiento",
        "cat_prioridad.nivel AS Prioridad",
        "acuse",
        "observaciones"
    ], explode(",", $columnas_mostradas));

    // Quitar las columnas de la consulta SQL
    foreach ($columnas_a_quitar as $columna) {
        $qry2 = str_replace("$columna,", '', $qry2);
        $qry2 = str_replace(",$columna", '', $qry2);
    }


    // Establecer la sesión de columnas si no existe
    if (!isset($_SESSION["columnas"])) {
        $_SESSION["columnas"] = "";
    }

}else{
    $qry2 = "SELECT 
    idcaptura AS Id, 
    fecha_cap AS Fecha_captura, 
    fecha_ing AS Fecha_ingreso, 
    fecha_ven AS Fecha_vencimiento, 
    num_exp AS Número_expediente, 
    num_int AS Número_interno, 
    cat_juicio.t_juicio AS Juicio_Procedimiento, 
    cat_actor.actord AS Actor_demandado, 
    accionante, 
    cat_estatus.estatus, 
    cat_abogado.n_abogado AS Abogado, 
    cat_ministro.ministros AS Ministro_instructor, 
    asunto, 
    cat_seguimiento.seguimiento, 
    cat_prioridad.nivel AS Prioridad, 
    acuse, 
    observaciones
FROM 
    captura
INNER JOIN 
    cat_estatus ON captura.estatus = cat_estatus.id
INNER JOIN 
    cat_abogado ON captura.abogado = cat_abogado.id
INNER JOIN 
    cat_ministro ON captura.ministro = cat_ministro.id
INNER JOIN 
    cat_prioridad ON captura.prioridad = cat_prioridad.id
INNER JOIN 
    cat_seguimiento ON captura.seguimiento = cat_seguimiento.id
INNER JOIN 
    cat_juicio ON captura.juicio_proced = cat_juicio.id
INNER JOIN 
    cat_actor ON captura.actores = cat_actor.id 
WHERE 
    captura.estatus = 16";
    $_SESSION["columnas"]="SELECT 
    idcaptura AS Id, 
    fecha_cap AS Fecha_captura, 
    fecha_ing AS Fecha_ingreso, 
    fecha_ven AS Fecha_vencimiento, 
    num_exp AS Número_expediente, 
    num_int AS Número_interno, 
    cat_juicio.t_juicio AS Juicio_Procedimiento, 
    cat_actor.actord AS Actor_demandado, 
    accionante, 
    cat_estatus.estatus, 
    cat_abogado.n_abogado AS Abogado, 
    cat_ministro.ministros AS Ministro_instructor, 
    asunto, 
    cat_seguimiento.seguimiento, 
    cat_prioridad.nivel AS Prioridad, 
    acuse, 
    observaciones
FROM 
    captura
INNER JOIN 
    cat_estatus ON captura.estatus = cat_estatus.id
INNER JOIN 
    cat_abogado ON captura.abogado = cat_abogado.id
INNER JOIN 
    cat_ministro ON captura.ministro = cat_ministro.id
INNER JOIN 
    cat_prioridad ON captura.prioridad = cat_prioridad.id
INNER JOIN 
    cat_seguimiento ON captura.seguimiento = cat_seguimiento.id
INNER JOIN 
    cat_juicio ON captura.juicio_proced = cat_juicio.id
INNER JOIN 
    cat_actor ON captura.actores = cat_actor.id 
WHERE 
    captura.estatus = 16";
    
} */
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
                <?php // echo "<h2 class='titulo-h2'>Se encontraron " . $cuantos . " registros</h2>"; ?>
                <div class="card h-100">
                    <div class="card-body card-block h-100">
                        <div class="row">
                            <div class="col-3">
                            </div>
                        </div>
                        <?php
                        $xcrud->query($qry2);
                        echo $xcrud->render();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>