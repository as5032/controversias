<?php
error_reporting(0);
require_once('xcrud/xcrud.php');
require_once('config.php');
if (empty($_SESSION["id"])) {
    header("location: index.php");
}
$grafica="";
$usuarios= $_GET["valor"];



if ($_GET["valor"]) 
{
    require_once('conexion_db.php');
    //    $usuario = substr($_GET["valor"], 5, 10);
    list($uno, $texto, $grafica, $cuatro) = explode("=", $usuarios); // dos es la palabra clave y tres la grafica
    $texto = trim($texto);
    $grafica = trim($grafica);
    //echo $uno . "<br>" . $texto . "<br>" . $grafica . "<br>" . $cuatro;
    switch ($grafica) { //segun la grafica hara la consulta
        case 1:
            $sql = "SELECT cat_abogado.id AS idabogado
        FROM captura
        LEFT JOIN cat_abogado ON captura.abogado = cat_abogado.id
        LEFT JOIN logins ON cat_abogado.n_abogado = logins.nombre_completo
        WHERE logins.usuario LIKE CONCAT('%" . $texto . "%') LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $idd = $row["idabogado"];
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
            break;
        case 3:
            $sql= "SELECT cat_seguimiento.id
            FROM captura
            LEFT JOIN cat_seguimiento ON captura.seguimiento = cat_seguimiento.id
            WHERE cat_seguimiento.seguimiento LIKE CONCAT('%". $texto ."%') LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $idd = $row["id"];
            break;
        case 4:
            $sql="SELECT cat_prioridad.id FROM `captura` 
            INNER JOIN cat_prioridad ON captura.prioridad=cat_prioridad.id
            WHERE cat_prioridad.nivel LIKE CONCAT('%".$texto."%') LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $idd = $row["id"];
            break;
        case 5:
            $sql = "SELECT cat_actor.id FROM `captura` 
            INNER JOIN cat_actor ON captura.actores=cat_actor.id
            WHERE cat_actor.actord LIKE CONCAT('%".$texto."%') LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $idd = $row["id"];
            break;
        case 6:
            $sql = "SELECT cat_juicio.id FROM `captura` 
            INNER JOIN cat_juicio ON captura.juicio_proced=cat_juicio.id
            WHERE cat_juicio.t_juicio LIKE CONCAT('%".$texto."%') LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $idd = $row["id"];
            //echo $sql . "<br>id-- > " . $idd;
            break;
        default:
            
    }
    echo $sql."=) <br> $idd"; 
    mysqli_free_result($result);
}

Xcrud_config::$search_on_typing = true;
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
//$xcrud->where("estatus <> 16"); // no se deben mostrar aqui los concluidos


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
    case 6:
        $xcrud->where('juicio_proced=',$idd); // segun el $_get
        break;
    default:
}

$xcrud->where('abogado = '.$idd)->where('status <> 16');
//$xcrud->where('status <>  16');

$xcrud->validation_required('estatus'); //se hacen obligatorios
$xcrud->columns('id_usuario', true);
$xcrud->label('juicio_proced', 'Juicio Procedimiento');
$xcrud->label('actores', 'Actor');
$xcrud->label('fecha_cap', 'Fecha de Captura');
$xcrud->label('fecha_ing', 'Fecha de Ingreso');
$xcrud->label('fecha_ven', 'Fecha de Vencimiento');
$xcrud->label('fecha_ses', 'Fecha de Sesión');
$xcrud->label('num_exp', 'Número Expediente');
$xcrud->label('num_int', 'Número Interno');
$xcrud->label('ministro', 'Ministro Instructor');
$xcrud->change_type('acuse', 'file', '', array('not_rename' => false)); //cambia el nombre del archivo subido
$xcrud->set_logging(true); //guarda cada vez que se modifica en tabla logs
$xcrud->after_insert('alogs'); //despues de insertar el campo envia a funtions de /xcrud para añadir el usuario que hizo cambios
$xcrud->after_update('alogs'); //despues de insertar el campo envia a funtions de /xcrud para añadir el usuario que hizo cambios
switch ($_SESSION["tipo_usuario"]) {
    case 1:
        $xcrud->fields('id_usuario', true); // esconde el id para que en captura no se muestre ni se edite    
        $xcrud->fields('fecha_ses', true);
        break;
    case 2:
        $xcrud->fields('id_usuario', true); // esconde el id para que en captura no se muestre ni se edite    
        $xcrud->fields('fecha_ses', true);
        break;

    default:
        $xcrud->fields('id_usuario', true); // esconde el id para que en captura no se muestre ni se edite    
        $xcrud->fields('idcaptura', true);
        $xcrud->fields('fecha_cap', true);
        $xcrud->fields('fecha_ing', true);
        $xcrud->fields('fecha_ven', true);
        $xcrud->fields('fecha_ses', true);
        $xcrud->fields('num_exp', true);
        $xcrud->fields('num_int', true);
        $xcrud->fields('juicio_proced', true);
        $xcrud->fields('actores', true);
        $xcrud->fields('accionante', true);
        $xcrud->fields('abogado', true);
        $xcrud->fields('asunto', true);
        $xcrud->fields('seguimiento', true);
        $xcrud->fields('prioridad', true);
        $xcrud->fields('observaciones', true);
        break;
}
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
    <!-- <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.6.0/dist/multiple-select.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" /> -->
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
    <!-- Vendor CSS
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all"> -->
    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
    <script src="js/jquery-3.7.0.min.js"></script>
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
    ?>
    <!--INICIA DATOS A INGRESAR-->
    <div class="main-content">
        <div class="container-fluid">
            <div class="card h-200">
                <div class="card-header" style="font-size: 20px;">
                    <strong>Consulta</strong> Expedientes
                </div>
                <div class="card-body" style="font-size: 20px;">
                    <?php
                    echo $xcrud->render();
                    ?>
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
    <script src="vendor/select2/select2.min.js">
    </script>
    <!-- Main JS-->
    <script src="js/main.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
</body>
</html>