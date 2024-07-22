<?php
error_reporting(0);
$sql="";
$idd="";
require_once('xcrud/xcrud.php');
require_once('config.php');
if (empty($_SESSION["id"])) {
    header("location: index.php");
}
$grafica="";
$usuarios= $_GET["valor"];
if ($_GET["valor"]) {
    require_once('conexion_db.php');
    list($uno, $texto, $grafica, $cuatro) = explode("=", $usuarios); // dos es la palabra clave y tres la grafica
    $texto = trim($texto);
    $grafica = trim($grafica);
    echo $uno . "<br>" . $texto . "<br>" . $grafica . "<br>" . $cuatro;
    switch ($grafica) { //segun la grafica hara la consulta para obtener el id
        case 1:
            $sql = "SELECT cat_abogado.id AS idabogado FROM captura 
            LEFT JOIN cat_abogado ON captura.abogado = cat_abogado.id 
            LEFT JOIN logins ON cat_abogado.n_abogado = logins.nombre_completo 
            WHERE cat_abogado.abogado_user LIKE CONCAT('%" . $texto . "%') LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $idd = $row["idabogado"];
            mysqli_free_result($result);
            break;
        case 2:
            $sql="SELECT cat_estatus.id 
            FROM captura 
            INNER JOIN cat_estatus ON cat_estatus.id = captura.estatus 
            WHERE cat_estatus.estatus LIKE CONCAT('%', UPPER('" . $texto . "%')) LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $idd = $row["id"]; 
            if($idd==16){ // estatus de concluidos
                header("location: consulta_procedimientos_con.php");
            }
            mysqli_free_result($result);
            break;
        case 3:
            $sql= "SELECT cat_seguimiento.id
            FROM captura
            LEFT JOIN cat_seguimiento ON captura.seguimiento = cat_seguimiento.id
            WHERE cat_seguimiento.seguimiento LIKE CONCAT('%". $texto ."%') LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $idd = $row["id"];
            mysqli_free_result($result);
            break;
        case 4:
            $sql="SELECT cat_prioridad.id FROM `captura` 
            INNER JOIN cat_prioridad ON captura.prioridad=cat_prioridad.id
            WHERE cat_prioridad.nivel LIKE CONCAT('%".$texto."%') LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $idd = $row["id"];
            mysqli_free_result($result);
            break;
        case 5:
            $sql = "SELECT cat_actor.id FROM `captura` 
            INNER JOIN cat_actor ON captura.actores=cat_actor.id
            WHERE cat_actor.actord LIKE CONCAT('%".$texto."%') LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $idd = $row["id"];
            mysqli_free_result($result);
            break;
        case 6:
            $sql = "SELECT cat_juicio.id FROM `captura` 
            INNER JOIN cat_juicio ON captura.juicio_proced=cat_juicio.id
            WHERE cat_juicio.t_juicio LIKE CONCAT('%".$texto."%') LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $idd = $row["id"];
            mysqli_free_result($result);
            break;
        default:           
    }
}
$xcrud = Xcrud::get_instance();
$xcrud->buttons_position('left');
$xcrud->table("captura");
$xcrud->relation('juicio_proced', 'cat_juicio', 'id', 't_juicio');
$xcrud->relation('actores', 'cat_actor', 'id', 'actord');
$xcrud->relation('estatus', 'cat_estatus', 'id', 'estatus', 'cat_estatus.status=1'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud->relation('abogado', 'cat_abogado', 'id', 'n_abogado', 'cat_abogado.estatus=1');
$xcrud->relation('ministro', 'cat_ministro', 'id', 'ministros');
$xcrud->relation('seguimiento', 'cat_seguimiento', 'id', 'seguimiento');
$xcrud->relation('prioridad', 'cat_prioridad', 'id', 'nivel');
$xcrud->button('seguimiento_procedimiento.php?id={idcaptura}', 'Seguimiento', 'glyphicon-screenshot', '', array('target' => '_self'));
$xcrud->change_type('acuse', 'file', '', array('not_rename' => true));
//botones de control
$xcrud->unset_remove();
$xcrud->unset_csv();
$xcrud->unset_add();
$xcrud->hide_button('save_new');
$xcrud->hide_button('save_edit');
//botones de control
    // AQUI SE MARCAN LOS REGISTROS SIN DATO // 
$xcrud->highlight('acuse', '<', " ", '9F2241');
//$xcrud->highlight('acuse', '>', " ", '235B4E');
$xcrud->highlight('prioridad', '<', " ", '9F2241');
//$xcrud->highlight('prioridad', '>', " ", '235B4E');
$xcrud->highlight('asunto', '<', " ", '9F2241');
//$xcrud->highlight('asunto', '>', " ", '235B4E');
$xcrud->highlight('num_int', '<', " ", '9F2241');
//$xcrud->highlight('num_int', '>', " ", '235B4E');
$xcrud->highlight('observaciones', '<', " ", '9F2241');
//$xcrud->highlight('observaciones', '>', " ", '235B4E');
$xcrud->highlight('ministro', '<', 1, '9F2241');
//$xcrud->highlight('ministro', '>', 1, '235B4E');
$xcrud->highlight('accionante', '<', 1, '9F2241');
//$xcrud->highlight('accionante', '>', 1, '235B4E');
$xcrud->highlight('fecha_ses', '<', " ", '9F2241');
//$xcrud->highlight('fecha_ses', '>', " ", '235B4E');
$xcrud->highlight('fecha_ven', '<', " ", '9F2241');
//$xcrud->highlight('fecha_ven', '>', " ", '235B4E');
$xcrud->where("estatus<>16"); // no se deben mostrar aqui los concluidos
switch ($grafica) { //segun la grafica hara la consulta
    case 1:
        $xcrud->where('abogado=',$idd); // segun el $_get
        break;
    case 2:
        $xcrud->where('estatus=',$idd); // segun el $_get
        break;
    case 3:
        $xcrud->where('seguimiento=',$idd); // segun el $_get
        break;
    case 4:
        $xcrud->where('prioridad=',$idd); // segun el $_get
        break;
    case 5:
        $xcrud->where('actores=',$idd); // segun el $_get
        break;
    case 6:
        $xcrud->where('juicio_proced=',$idd); // segun el $_get
        break;
    case 7: //es el semaforo verde
        $xcrud->where("(TIMESTAMPDIFF(DAY, CURDATE(), fecha_ven ) > 5)");
        break;
    case 8: //es el semaforo amarillo
        $xcrud->where("(TIMESTAMPDIFF(DAY,  CURDATE(), fecha_ven) > 2)
                  AND (TIMESTAMPDIFF(DAY,  CURDATE(), fecha_ven) <= 5)");
        break;
    case 9: //es el semaforo rojo
        $xcrud->where("(TIMESTAMPDIFF(DAY,  CURDATE(), fecha_ven) >= 1)
              AND (TIMESTAMPDIFF(DAY,  CURDATE(), fecha_ven) <= 3)
              AND MONTH(fecha_ven) = MONTH(CURDATE())
              AND YEAR(fecha_ven) = YEAR(CURDATE())
              AND fecha_ven is not null");
        break;
    case 10: //es el semaforo verde
        $xcrud->where("(TIMESTAMPDIFF(DAY, CURDATE(), fecha_ses ) > 5)");
        break;
    case 11: //es el semaforo amarillo
        $xcrud->where("(TIMESTAMPDIFF(DAY,  CURDATE(), fecha_ses) > 2)
                  AND (TIMESTAMPDIFF(DAY,  CURDATE(), fecha_ses) <= 5)");
        break;
    case 12: //es el semaforo rojo
        $xcrud->where("(TIMESTAMPDIFF(DAY,  CURDATE(), fecha_ses) >= 1)
              AND (TIMESTAMPDIFF(DAY,  CURDATE(), fecha_ses) <= 3)
              AND MONTH(fecha_ses) = MONTH(CURDATE())
              AND YEAR(fecha_ses) = YEAR(CURDATE())
              AND fecha_ses is not null");
        break;
    default:
}
$xcrud->validation_required('estatus'); //se hacen obligatorios
$xcrud->columns('id_usuario', true);
$xcrud->label('idcaptura', 'Id');
$xcrud->label('juicio_proced', 'Juicio Procedimiento');
$xcrud->label('actores', 'Actor');
$xcrud->label('fecha_cap', 'Fecha de Captura');
$xcrud->label('fecha_ing', 'Fecha de Ingreso');
$xcrud->label('fecha_ven', 'Fecha de Vencimiento');
$xcrud->label('fecha_ses', 'Fecha de Sesión');
$xcrud->label('num_exp', 'Número Expediente');
$xcrud->label('num_int', 'Número Interno');
$xcrud->label('ministro', 'Ministro Instructor');
$xcrud->label('acuse', 'Expediente PDF');
$xcrud->change_type('Expediente PDF', 'file', '', array('not_rename' => false));
$xcrud->set_logging(true); //guarda cada vez que se modifica en tabla logs
$xcrud->after_insert('alogs'); //despues de insertar el campo envia a funtions de /xcrud para añadir el usuario que hizo cambios
$xcrud->after_update('alogs'); //despues de insertar el campo envia a funtions de /xcrud para añadir el usuario que hizo cambios
switch ($_SESSION["tipo_usuario"]) {
    case 1:
        $xcrud->fields('fecha_cap,fecha_ing,fecha_ven,fecha_ses,num_exp,num_int,juicio_proced,actores,accionante,estatus,abogado,ministro,asunto,seguimiento,prioridad,acuse,observaciones', false);
        break;
    case 2:
        $xcrud->fields('fecha_cap,fecha_ing,fecha_ven,fecha_ses,num_exp,num_int,juicio_proced,actores,accionante,estatus,abogado,ministro,asunto,seguimiento,prioridad,acuse,observaciones', false);
        break;

    default:
        $xcrud->fields('fecha_cap,fecha_ing,fecha_ven,fecha_ses,num_exp,num_int,juicio_proced,actores,accionante,estatus,abogado,ministro,asunto,seguimiento,prioridad,acuse,observaciones', false);
        $xcrud->disabled('fecha_cap,fecha_ing,num_exp,num_int,juicio_proced,actores,accionante,abogado,ministro,asunto,prioridad'); 
        break;
}?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <link rel="icon" href="images/icon/libro.ico" type="image/ico" />
    <title>CACCC</title>
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/fontawesome-free-6.4.0/css/all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
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
                    <strong>Consulta</strong> Expedientes
                </div>
                <div class="card-body" style="font-size: 20px;">
                    <?php echo $xcrud->render(); ?>
                </div>
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
    <script src="vendor/select2/select2.min.js">
    </script>
    <script src="js/main.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
</body>
</html>