<?php
//$texto="";
require_once('xcrud/xcrud.php');
error_reporting(0);
$xcrud = Xcrud::get_instance();
$xcrud->buttons_position('left'); //posicion de los botones
$xcrud->table("captura");
$xcrud->relation('juicio_proced', 'cat_juicio', 'id', 't_juicio'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud->relation('actores', 'cat_actor', 'id', 'actord'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud->relation('estatus', 'cat_estatus', 'id', 'estatus'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud->relation('abogado', 'cat_abogado', 'id', 'n_abogado'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud->relation('ministro', 'cat_ministro', 'id', 'ministros'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud->relation('seguimiento', 'cat_seguimiento', 'id', 'seguimiento'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud->relation('prioridad', 'cat_prioridad', 'id', 'nivel'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud->label('juicio_proced', 'Juicio/Procedimiento');
$xcrud->label('idcaptura', 'Id');
$xcrud->label('actores', 'Actor/Demandado');
$xcrud->label('fecha_cap', 'Fecha Captura');
$xcrud->label('fecha_ing', 'Fecha Ingreso');
$xcrud->label('fecha_ven', 'Fecha Vencimiento');
$xcrud->label('fecha_ses', 'Fecha Sesión');
$xcrud->label('num_exp', 'Número Expediente');
$xcrud->label('num_int', 'Número Interno');
$xcrud->label('ministro', 'Ministro/Instructor');
$xcrud->label('acuse', 'Expediente PDF');
$xcrud->change_type('acuse', 'file', '', array('not_rename' => false)); //cambia el nombre del archivo subido
$xcrud->unset_remove();
$xcrud->unset_add();
//$xcrud->unset_csv();
$xcrud->unset_edit();
$xcrud->unset_view();
$xcrud->hide_button('save_new');
$xcrud->hide_button('save_edit');
$xcrud->where('estatus <> 16');
$xcrud->set_logging(true); //guarda cada vez que se modifica en tabla logs
$xcrud->fields('fecha_cap,fecha_ing,fecha_ven,fecha_ses,num_exp,num_int,juicio_proced,actores,accionante,estatus,abogado,ministro,asunto,seguimiento,prioridad,acuse,observaciones', false);

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
    $xcrud->columns($Mostrar);

    // Establecer la sesión de columnas si no existe
    if (!isset($_SESSION["columnas"])) {
        $_SESSION["columnas"] = "";
    }
}
switch ($opciones){
    case ($opciones=="2018"):
        $texto = "2018";
        break;
    case ($opciones=="2019"):
        $texto = "2019";
        break;
    case ($opciones=="2020"):
        $texto = "2020";
        break;
    case ($opciones=="2021"):
        $texto = "2021";
        break;
    case ($opciones=="2022"):
        $texto = "2022";
        break;
    case ($opciones=="2023"):
        $texto = "2023";
        break;
    case ($opciones=="2024"):
        $texto = "2024";
        break;        
    default:
}
//$xcrud->where("fecha_cap LIKE '%$texto%'");
if ($opciones){
    $xcrud->where("num_exp LIKE '%$texto%'");
    //print_r($_SESSION["columnas"]);
}
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
                <div class="card h-100" style="font-size: 18px;">
                    <div class="card-body card-block h-100">
                        <div class="row">
                        <?php  echo "<h2 class='titulo-h2'>Estas viendo " . $texto . " de Número de expediente</h2>"; ?>
                            <div class="col-3">
                            </div>
                        </div>
                        <?php
                        echo $xcrud->render();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>