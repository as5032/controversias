<?php
require_once('xcrud/xcrud.php');
$xcrud = Xcrud::get_instance();
$xcrud->table("captura");
$xcrud->buttons_position('left');
$xcrud->columns('id_usuario', true);
require_once('config.php');
if (empty($_SESSION["id"])) {
    header("location: index.php");
}
error_reporting(0);
$FechaIn = $_POST["FechaIn"];
$FechaVen = $_POST["FechaVen"];
$actor = $_POST["actor"];
$juicio = $_POST["juicio"];
$abogado = $_POST["abogado"];
$ministro = $_POST["ministro"];
$estatus = $_POST["estatus"];
$prioridad = $_POST["prioridad"];
$seguimiento = $_POST["seguimiento"];
$bandera = 0;
$query = "";
/*foreach ($_POST as $campo => $valor) {
    echo "-->" . $campo . " = " . $valor;
}*/
require_once('conexion_db.php');
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
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" media="screen" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

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
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-labels"></script>
    <style>
        #mi-div {
            text-align: center;
        }

        #mis-div {
            text-align: center;
            font-size: 20px;
            /* Puedes ajustar el tamaño según sea necesario */
            color: black;
        }


        .titulo-h2 {
            color: #333;
            /* Color del texto */
            font-size: 15px;
            /* Tamaño de la fuente */
            font-weight: bold;
            /* Grosor de la fuente */
            margin-bottom: 10px;
            /* Margen inferior */
            /* Otros estilos que desees agregar */
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
                                <strong>Consultas</strong> 
                            </div>
                            <div class="card-body card-block h-100">
                                <form action="consultas.php" method="POST" class="h-100" id="miFormulario" name="miFormulario" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-2"></div>
                                        <div class="col-3">
                                            <? require_once 'conexion_db.php'; ?>
                                            <div class="form-group">
                                                <input name="FechaIn" type="date" class="form-control" id="FechaIn" style="font-size: 16px" ; value=<?php echo $FechaIn ?>>
                                            </div>
                                            <label for="select-dddmultiple" class="control-label mb-1">Actor/Demandado</label>
                                            <?php

                                            $cs1 = mysqli_query($conn, "SELECT * FROM cat_actor");  ?>
                                            <div>
                                                <select name="actor" id="actor">
                                                    <option value="">Seleccione</option>
                                                    <?php while ($Resultado1 = mysqli_fetch_array($cs1)) { ?>
                                                        <option value="<?php echo $Resultado1['id'] ?>" <?php if ($actor == $Resultado1['id']) { ?>selected="selected" <?php  } ?>><?php echo $Resultado1['actord'] ?></option>
                                                    <?php   } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2"></div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <input name="FechaVen" type="date" class="form-control" id="FechaVen" style="font-size: 16px" ; value=<?php echo $FechaVen ?>>
                                            </div>
                                            <label for="select-dddmultiple" class="control-label mb-1">Juicio/Procedimiento</label>
                                            <?php
                                            require_once 'conexion_db.php';
                                            $cs2 = mysqli_query($conn, "SELECT * FROM cat_juicio");  ?>
                                            <div>
                                                <select name="juicio" id="juicio">
                                                    <option value="">Seleccione</option>
                                                    <?php while ($Resultado2 = mysqli_fetch_array($cs2)) { ?>
                                                        <option value="<?php echo $Resultado2['id'] ?>" <?php if ($juicio == $Resultado2['id']) { ?>selected="selected" <?php  } ?>><?php echo $Resultado2['t_juicio'] ?></option>
                                                    <?php   } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2"></div>
                                        <div class="col-3">
                                            <label for="select-dddmultiple" class="control-label mb-1">Abogado</label>
                                            <?php
                                            require_once 'conexion_db.php';
                                            $cs3 = mysqli_query($conn, "SELECT * FROM cat_abogado");  ?>
                                            <div>
                                                <select name="abogado" id="abogado">
                                                    <option value="">Seleccione</option>
                                                    <?php while ($Resultado3 = mysqli_fetch_array($cs3)) { ?>
                                                        <option value="<?php echo $Resultado3['id'] ?>" <?php if ($abogado == $Resultado3['id']) { ?>selected="selected" <?php  } ?>><?php echo $Resultado3['n_abogado'] ?></option>
                                                    <?php   } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <label for="select-dddmultiple" class="control-label mb-1">Ministro</label>
                                            <?php
                                            $cs4 = mysqli_query($conn, "SELECT * FROM cat_ministro");  ?>
                                            <div>
                                                <select name="ministro" id="ministro">
                                                    <option value="">Seleccione</option>
                                                    <?php while ($Resultado4 = mysqli_fetch_array($cs4)) { ?>
                                                        <option value="<?php echo $Resultado4['id'] ?>" <?php if ($ministro == $Resultado4['id']) { ?>selected="selected" <?php  } ?>><?php echo $Resultado4['ministros'] ?></option>
                                                    <?php   } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <label for="select-dddmultiple" class="control-label mb-1">Estatus</label>
                                            <?php
                                            $cs5 = mysqli_query($conn, "SELECT * FROM cat_estatus");  ?>
                                            <div>
                                                <select name="estatus" id="estatus">
                                                    <option value="">Seleccione</option>
                                                    <?php while ($Resultado5 = mysqli_fetch_array($cs5)) { ?>
                                                        <option value="<?php echo $Resultado5['id'] ?>" <?php if ($estatus == $Resultado5['id']) { ?>selected="selected" <?php  } ?>><?php echo $Resultado5['estatus'] ?></option>
                                                    <?php   } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2"></div>
                                        <div class="col-3">
                                            <label for="select-dddmultiple" class="control-label mb-1">Prioridad</label>
                                            <?php
                                            $cs6 = mysqli_query($conn, "SELECT * FROM cat_prioridad");  ?>
                                            <div>
                                                <select name="prioridad" id="prioridad">
                                                    <option value="">Seleccione</option>
                                                    <?php while ($Resultado6 = mysqli_fetch_array($cs6)) { ?>
                                                        <option value="<?php echo $Resultado6['id'] ?>" <?php if ($prioridad == $Resultado6['id']) { ?>selected="selected" <?php  } ?>><?php echo $Resultado6['nivel'] ?></option>
                                                    <?php   } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2"></div>
                                        <div class="col-3">
                                            <label for="select-dddmultiple" class="control-label mb-1">Seguimiento</label>
                                            <?php
                                            $cs8 = mysqli_query($conn, "SELECT * FROM cat_seguimiento");  ?>
                                            <div>
                                                <select name="seguimiento" id="seguimiento">
                                                    <option value="">Seleccione</option>
                                                    <?php while ($Resultado8 = mysqli_fetch_array($cs8)) { ?>
                                                        <option value="<?php echo $Resultado8['id'] ?>" <?php if ($seguimiento == $Resultado8['id']) { ?>selected="selected" <?php  } ?>><?php echo $Resultado8['seguimiento'] ?></option>
                                                    <?php   } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div id="mi-div">
                                        <input type="submit" id="submitFormData" value="Mostrar Tabla" class="btn btn-success" name="button1" />
                                    </div>
                                </form>
                                <?php
                                if (isset($_POST["button1"])) {
                                    if (!empty($actor)) {
                                        $bandera = 1;
                                        $query .= "captura.actores='$actor' AND ";
                                    }
                                    if (!empty($juicio)) {
                                        $bandera = 1;
                                        $query .= "captura.juicio_proced='$juicio' AND ";
                                    }
                                    if (!empty($abogado)) {
                                        $bandera = 1;
                                        $query .= "captura.abogado='$abogado' AND ";
                                    }
                                    if (!empty($ministro)) {
                                        $bandera = 1;
                                        $query .= "captura.ministro='$ministro' AND ";
                                    }
                                    if (!empty($estatus)) {
                                        $bandera = 1;
                                        $query .= "captura.estatus='$estatus' AND ";
                                    }
                                    if (!empty($prioridad)) {
                                        $bandera = 1;
                                        $query .= "captura.prioridad='$prioridad' AND ";
                                    }
                                    if (!empty($seguimiento)) {
                                        $bandera = 1;
                                        $query .= "captura.seguimiento='$seguimiento'  AND ";
                                    }
                                    if (!empty($FechaIn)) {
                                        $bandera = 1;
                                        $query .= "fecha_cap BETWEEN '$FechaIn' AND ";
                                    }
                                    if (!empty($FechaVen)) {
                                        $bandera = 1;
                                        $query .= "'$FechaVen' AND ";
                                    }
                                    if ($bandera == 0) { ?>

                            </div>
                    <?php

                                    } else {
                                        $query_1 = "SELECT idcaptura AS Id, fecha_cap AS Fecha_Captura, fecha_ses AS Fecha_Sesión, num_exp AS Número_Expediente, num_int AS Número_Interno, accionante, observaciones, cat_estatus.estatus AS Estatus, cat_abogado.n_abogado AS Abogado, cat_ministro.ministros AS Ministro_Instructor, cat_prioridad.nivel AS Prioridad, cat_seguimiento.seguimiento AS Seguimiento, cat_juicio.t_juicio AS Juicio_Procedimiento, cat_actor.actord AS Actor_Demandado 
                                                FROM captura 
                                                INNER JOIN cat_estatus 
                                                ON captura.estatus=cat_estatus.id 
                                                INNER JOIN cat_abogado ON captura.abogado=cat_abogado.id 
                                                INNER JOIN cat_ministro ON captura.ministro=cat_ministro.id 
                                                INNER JOIN cat_prioridad ON captura.prioridad=cat_prioridad.id 
                                                INNER JOIN cat_seguimiento ON captura.seguimiento=cat_seguimiento.id 
                                                INNER JOIN cat_juicio ON captura.juicio_proced=cat_juicio.id 
                                                INNER JOIN cat_actor ON captura.actores=cat_actor.id
                                                WHERE ";
                                        $query_1 .= $query;
                                        $n = strlen($query_1);
                                        $query1 = substr($query_1, 0, $n - 4);
                                        //echo $query1;
                                        $xcrud->query($query1);
                                        echo $xcrud->render();
                                    } // IF BANDERA
                                }
                    ?>
                        </div>
                    </div>
                    <?php
                    if ($bandera == 0) {
                    ?>
                        <div id="mis-div">
                            <h4><strong>Seleccione uno o varias opciones para filtrar sus resultados</strong></h4>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div id="results">
        <!-- AQUI SE INTRODUCEN LOS DATOS-->
    </div>
    <!--TERMINA DATOS A INGRESAR-->
    <br /><br /><br />
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>

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
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

</body>

</html>