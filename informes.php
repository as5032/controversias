<?php
require_once('config.php');
if (empty($_SESSION["id"])) {
    header("location: index.php");
}
require('conexion_db.php');
$qry1 = "SELECT * from etiquetas WHERE 1";
$result = mysqli_query($conn, $qry1);
while ($row = mysqli_fetch_assoc($result)) {
    $texto1_grafica1 = $row["texto1_1"];
    $texto2_grafica1 = $row["texto1_2"];
    $texto1_grafica2 = $row["texto2_1"];
    $texto2_grafica2 = $row["texto2_2"];
    $texto1_grafica3 = $row["texto3_1"];
    $texto2_grafica3 = $row["texto3_2"];
    $texto1_grafica4 = $row["texto4_1"];
    $texto2_grafica4 = $row["texto4_2"];
    $texto1_grafica5 = $row["texto5_1"];
    $texto2_grafica5 = $row["texto5_2"];
    $texto1_grafica6 = $row["texto6_1"];
    $texto2_grafica6 = $row["texto6_2"];
    $texto1_grafica7 = $row["texto7_1"];
    $texto2_grafica7 = $row["texto7_2"];
    $texto1_grafica8 = $row["texto8_1"];
    $texto2_grafica8 = $row["texto8_2"];
    $texto1_grafica9 = $row["texto9_1"];
    $texto2_grafica9 = $row["texto9_2"];
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

        .text {
            font-size: 13px;
            /* Tamaño de fuente más grande */
            font-weight: bold;
            /* Texto en negrita */
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
                                <strong>Consulta</strong> Informes
                            </div>
                            <div class="card-body card-block h-100">
                                <form action="" method="POST" class="h-100" id="miFormulario" name="miFormulario" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-2"></div>
                                        <div class="col-3">

                                            <div class="form-group">
                                                <label for="date-input" class="control-label mb-1">Rango de fecha</label>
                                                <input type="checkbox" id="habilitarFechas">
                                                <input type="date" id="FechaIn" name="FechaIn" class="form-control" style="font-size: 16px;" disabled>
                                            </div>
                                            <label for="select-dddmultiple" class="control-label mb-1">Actor/Demandado</label>
                                            <?php // Incluye tu archivo de conexión a la base de datos
                                            $cs2 = mysqli_query($conn, "SELECT * FROM cat_actor");  ?>
                                            <div>
                                                <select name="actord" id="actord">
                                                    <option value="">seleccione</option>
                                                    <?php while ($Resultado2 = mysqli_fetch_array($cs2)) { ?>
                                                        <option value="<?php echo $Resultado2['id'] ?>"><?php echo $Resultado2['actord'];
                                                                                                    } ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">

                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <br>
                                                <input type="date" id="FechaVen" name="FechaVen" class="form-control" style="font-size: 16px;" disabled>
                                            </div>
                                            <label for="select-dddmultiple" class="control-label mb-1">Juicio/Procedimiento</label>
                                            <?php // Incluye tu archivo de conexión a la base de datos
                                            $cs1 = mysqli_query($conn, "SELECT * FROM cat_juicio");  ?>
                                            <div>
                                                <select name="t_juicio" id="t_juicio">
                                                    <option value="">seleccione</option>
                                                    <?php while ($Resultado1 = mysqli_fetch_array($cs1)) { ?>
                                                        <option value="<?php echo $Resultado1['id'] ?>"><?php echo $Resultado1['t_juicio'];
                                                                                                    } ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="mi-div">
                                        <input type="button" id="submitFormData" onClick="SubmitFormData();" value="Buscar" class="btn btn-success btn-lg" />
                                    </div>
                                </form>
                                <!-- /.card-body -->
                                <div class="row m-t-25">
                                    <div class="col-lg-4 col-lg-4">
                                        <div class="overview-item overview-item--c2">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <!-- <i class="fa-solid fa-envelope-open"></i> -->
                                                        <!-- <i class="fa-solid fa-ranking-star"></i> -->
                                                    </div>
                                                    <div class="text">
                                                        <span>
                                                            <center><span><?php echo $texto1_grafica1 ?></span></center><!-- TEXTO DEL GRAFICO 1 *************************** -->
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    <canvas id="user-chart"></canvas>
                                                    <?php require_once("grafica_informes.php"); ?>
                                                    <div class="text">
                                                        <center><span><?php echo $texto2_grafica1 ?></span></center><!-- TEXTO DEL GRAFICO 1 *************************** -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-lg-4">
                                        <div class="overview-item overview-item--c2">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <!-- <i class="fa-solid fa-envelope-open"></i> -->
                                                        <!-- <i class="fa-solid fa-ranking-star"></i> -->
                                                    </div>
                                                    <div class="text">
                                                        <span>
                                                            <center><span><?php echo $texto1_grafica2 ?></span></center><!-- TEXTO DEL GRAFICO 2 *********************************************************************** -->
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    <canvas id="user-chart2"></canvas>
                                                    <?php require_once("grafica_informes2.php"); ?>
                                                    <div class="text">
                                                        <center><span><?php echo $texto2_grafica2 ?></span></center><!-- TEXTO DEL GRAFICO 3 -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-lg-4">
                                        <div class="overview-item overview-item--c4">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <!-- <i class="fa-solid fa-user-tie"></i> -->
                                                        <!-- <i class="fa-solid fa-truck-arrow-right"></i> -->
                                                    </div>
                                                    <div class="text">
                                                        <span>
                                                            <center><span><?php echo $texto1_grafica3 ?></span></center><!-- TEXTO DEL GRAFICO 3 *********************************************************************** -->
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    <canvas id="user-chart3"></canvas>
                                                    <?php require_once("grafica_informes3.php"); ?>
                                                    <div class="text">
                                                        <center><span><?php echo $texto2_grafica3 ?></span></center><!-- TEXTO DEL GRAFICO 3 *********************************************************************** -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-lg-4">
                                        <div class="overview-item overview-item--c4">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <!-- <i class="fa-regular fa-calendar-days"></i> -->
                                                        <!-- <i class="fa-solid fa-person-military-to-person"></i> -->
                                                    </div>
                                                    <div class="text">
                                                        <span>
                                                            <center><span><?php echo $texto1_grafica4 ?></span></center><!-- TEXTO DEL GRAFICO 3 *********************************************************************** -->
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    <canvas id="user-chart4"></canvas>
                                                    <?php require_once("grafica_informes4.php"); ?>
                                                    <div class="text">
                                                        <center><span><?php echo $texto2_grafica4 ?></span></center><!-- TEXTO DEL GRAFICO 3 *********************************************************************** -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ASUNTOS POR ACTOR/DEMANDADO-->
                                    <div class="col-lg-4 col-lg-4">
                                        <div class="overview-item overview-item--c4">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <!-- <i class="fa-solid fa-users"></i>-->
                                                        <!-- <i class="fa-solid fa-user-tie"></i> -->
                                                    </div>
                                                    <div class="text">
                                                        <span>
                                                            <center><span><?php echo $texto1_grafica5 ?></span></center><!-- TEXTO DEL GRAFICO 3 *********************************************************************** -->
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    <canvas id="user-chart5"></canvas>
                                                    <?php require_once("grafica_informes5.php"); ?>
                                                    <div class="text">
                                                        <center><span><?php echo $texto2_grafica5 ?></span></center><!-- TEXTO DEL GRAFICO 3 *********************************************************************** -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ASUNTOS POR JUICIO/PROCEDIMIENTO-->
                                    <div class="col-lg-4 col-lg-4">
                                        <div class="overview-item overview-item--c2">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <!-- <i class="fa-solid fa-envelope-open"></i> -->

                                                        <!-- <i class="fa-solid fa-hammer"></i> -->
                                                    </div>
                                                    <div class="text">
                                                        <span>
                                                            <center><span><?php echo $texto1_grafica6 ?></span></center><!-- TEXTO DEL GRAFICO 3 *********************************************************************** -->
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    <canvas id="user-chart6"></canvas>
                                                    <?php require_once("grafica_informes6.php"); ?>
                                                    <div class="text">
                                                        <center><span><?php echo $texto2_grafica6 ?></span></center><!-- TEXTO DEL GRAFICO 3 *********************************************************************** -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ASUNTOS POR JUICIO/PROCEDIMIENTO-->
                                    <div class="col-lg-4 col-lg-4">
                                        <div class="overview-item overview-item--c2">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <!-- <i class="fa-solid fa-envelope-open"></i> -->

                                                        <!-- <i class="fa-solid fa-hammer"></i> -->
                                                    </div>
                                                    <div class="text">
                                                        <span>
                                                            <center><span><?php echo $texto1_grafica7 ?></span></center><!-- TEXTO DEL GRAFICO 3 *********************************************************************** -->
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    <canvas id="user-chart7"></canvas>
                                                    <?php require_once("grafica_informes7.php"); ?>
                                                    <div class="text">
                                                        <span>
                                                            <center><span><?php echo $texto2_grafica7 ?></span></center><!-- TEXTO DEL GRAFICO 3 *********************************************************************** -->
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-lg-4">
                                        <div class="overview-item overview-item--c2">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <!-- <i class="fa-solid fa-envelope-open"></i> -->
                                                        <!-- <i class="fa-solid fa-hammer"></i> -->
                                                    </div>
                                                    <div class="text">
                                                        <span>
                                                            <center><span><?php echo $texto1_grafica8 ?></span></center><!-- TEXTO DEL GRAFICO 3 *********************************************************************** -->
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    <canvas id="user-chart8"></canvas>
                                                    <?php
                                                    require('conexion_db.php');
                                                    $qry1 = "SELECT * from actividades WHERE 1";
                                                    $tabla = mysqli_query($conn, $qry1);
                                                    $cuantos = mysqli_num_rows($tabla);
                                                    if ($cuantos > 0) {
                                                        require_once("grafica_informes8.php"); ?>
                                                        <div class="text">
                                                            <span>
                                                                <center><span><?php echo $texto2_grafica8 ?></span></center><!-- TEXTO DEL GRAFICO 3 *********************************************************************** -->
                                                            </span>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-lg-4">
                                        <div class="overview-item overview-item--c2">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <!-- <i class="fa-solid fa-envelope-open"></i> -->

                                                        <!-- <i class="fa-solid fa-hammer"></i> -->
                                                    </div>
                                                    <div class="text">
                                                        <span>
                                                            <center><span><?php echo $texto1_grafica9 ?></span></center><!-- TEXTO DEL GRAFICO 3 *********************************************************************** -->
                                                        </span>
                                                    </div>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="overview-chart">
                                                <canvas id="user-chart9"></canvas>
                                                <?php
                                                $qry2 = "SELECT * from normas WHERE 1";
                                                $tabla2 = mysqli_query($conn, $qry2);
                                                $cuantos2 = mysqli_num_rows($tabla2);
                                                if ($cuantos2 > 0) {
                                                    require_once("grafica_informes9.php");
                                                } ?>
                                                <div class="text">
                                                    <span>
                                                        <center><span><?php echo $texto2_grafica9 ?></span></center><!-- TEXTO DEL GRAFICO 3 *********************************************************************** -->
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        mysqli_free_result($tabla);
        mysqli_free_result($tabla2);
        mysqli_close($conn);
        ?>
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
    <script>
        document.getElementById("habilitarFechas").addEventListener("change", function() {
            var fechaCap = document.querySelector('input[name="FechaIn"]');
            var fechaIn = document.querySelector('input[name="FechaVen"]');
            if (this.checked) {
                fechaCap.disabled = false;
                fechaIn.disabled = false;
            } else {
                fechaCap.disabled = true;
                fechaIn.disabled = true;
            }
        });
        // Obtén las referencias a los elementos de fecha
        const fechaInInput = document.querySelector('input[name="FechaIn"]');
        const fechaVenInput = document.querySelector('input[name="FechaVen"]');
        // Agrega un evento para validar cuando cambie la fecha de vencimiento
        fechaVenInput.addEventListener('change', function() {
            const fechaIn = new Date(fechaInInput.value);
            const fechaVen = new Date(this.value);
            // Compara las fechas
            if (fechaVen < fechaIn) {
                alert('La fecha final no puede ser anterior a la fecha inicial de la busqueda.');
                this.value = ''; // Borra el valor de la fecha de vencimiento
            }
        });

        function SubmitFormData() {
            var FechaIn = $("#FechaIn").val();
            var FechaVen = $("#FechaVen").val();
            var t_juicio = $("#t_juicio").val();
            var actord = $("#actord").val();
            $.post("ajax_informes.php", {
                    FechaIn: FechaIn,
                    FechaVen: FechaVen,
                    t_juicio: t_juicio,
                    actord: actord
                },
                function(data) {
                    $('#results').html(data);
                    $('#miFormulario')[0].reset();
                });
        }
    </script>
</body>

</html>