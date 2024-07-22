<?php
error_reporting(0);
require_once('config.php');
if (empty($_SESSION["id"])) {
    header("location: index.php");
}
require_once('conexion_db.php');
$conteoVerde = 0;
$sqlVerde = "SELECT count(*) as conteoVerde FROM captura
               WHERE (TIMESTAMPDIFF(DAY, CURDATE(), fecha_ven ) > 5) AND estatus<>16";

$resultVerde = $conn->query($sqlVerde);
while ($rowVerde = mysqli_fetch_array($resultVerde)) {
    $conteoVerde = $rowVerde['conteoVerde'];
}
$conteoAmarillo = 0;
$sqlAmarillo = "SELECT count(*) as conteoAmarillo FROM captura
                  WHERE (TIMESTAMPDIFF(DAY,  CURDATE(), fecha_ven) > 2)
                  AND (TIMESTAMPDIFF(DAY,  CURDATE(), fecha_ven) <= 5) AND estatus<>16";

$resultAmarillo = $conn->query($sqlAmarillo);
while ($rowAmarillo = mysqli_fetch_array($resultAmarillo)) {
    $conteoAmarillo = $rowAmarillo['conteoAmarillo'];
}
$conteoRojo = 0;
$sqlRojo = "SELECT count(*) conteoRojo
              FROM captura
              WHERE (TIMESTAMPDIFF(DAY,  CURDATE(), fecha_ven) >= 1)
              AND (TIMESTAMPDIFF(DAY,  CURDATE(), fecha_ven) <= 3)
              AND MONTH(fecha_ven) = MONTH(CURDATE())
              AND YEAR(fecha_ven) = YEAR(CURDATE())
              AND fecha_ven is not null
              AND captura.estatus<>16;
";

$resultRojo = $conn->query($sqlRojo);
while ($rowRojo = mysqli_fetch_array($resultRojo)) {
    $conteoRojo = $rowRojo['conteoRojo'];
}

//************************************************************************************************************************************* */

$conteoVerdeS = 0;
$sqlVerdeS = "SELECT count(*) as conteoVerde FROM captura
               WHERE (TIMESTAMPDIFF(DAY, CURDATE(), fecha_ses ) > 5) AND estatus<>16";

$resultVerdeS = $conn->query($sqlVerdeS);
while ($rowVerdeS = mysqli_fetch_array($resultVerdeS)) {
    $conteoVerdeS = $rowVerdeS['conteoVerde'];
}
$conteoAmarilloS = 0;
$sqlAmarilloS = "SELECT count(*) as conteoAmarillo FROM captura
                  WHERE (TIMESTAMPDIFF(DAY,  CURDATE(), fecha_ses) > 2)
                  AND (TIMESTAMPDIFF(DAY,  CURDATE(), fecha_ses) <= 5) AND estatus<>16";

$resultAmarilloS = $conn->query($sqlAmarilloS);
while ($rowAmarilloS = mysqli_fetch_array($resultAmarilloS)) {
    $conteoAmarilloS = $rowAmarilloS['conteoAmarillo'];
}
$conteoRojoS = 0;
$sqlRojoS = "SELECT count(*) conteoRojo
              FROM captura
              WHERE (TIMESTAMPDIFF(DAY,  CURDATE(), fecha_ses) >= 1)
              AND (TIMESTAMPDIFF(DAY,  CURDATE(), fecha_ses) <= 3)
              AND MONTH(fecha_ses) = MONTH(CURDATE())
              AND YEAR(fecha_ses) = YEAR(CURDATE())
              AND fecha_ses is not null
              AND captura.estatus<>16";

$resultRojoS = $conn->query($sqlRojoS);
while ($rowRojoS = mysqli_fetch_array($resultRojoS)) {
    $conteoRojoS = $rowRojoS['conteoRojo'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
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
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" media="screen" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>


    <!-- Vendor CSS-->
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400&display=swap');

        body {
            font-family: 'Quicksand', sans-serif;
        }

        .page-wrapper {
            background-color: white;
            height: 100vh;
        }

        .page-content--bge5 {
            background: #9F2241;
            height: 60vh;
        }
    </style>

</head>

<body>
    <?php
    include('plantilla.php');
    ?>

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div id="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="au-card chart-percent-card">
                            <div class="au-card-inner">
                                <div class="card-header" style="font-size: 20px;">
                                    <strong>Alertas</strong> Por Fecha de Vencimiento
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th style="background:#A9DFBF;">
                                                    <center> Más de 5 días </center>
                                                    </td>
                                                <th style="background:#F9E79F;">
                                                    <center> Menos de 5 días</center>
                                                    </td>
                                                <th style="background:#F1948A;">
                                                    <center> Menos de 3 días </center>
                                                    </td>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <td style="background:#A9DFBF;">
                                                <center><a href="consulta_procedimientos.php?valor=65%20=%20=7"> <?php echo $conteoVerde; ?></a></center>
                                            </td>
                                            <td style="background:#F9E79F;">
                                                <center><a href="consulta_procedimientos.php?valor=65%20=%20=8"> <?php echo $conteoAmarillo; ?></a></center>
                                            </td>
                                            <th style="background:#F1948A;">
                                                <center><a href="consulta_procedimientos.php?valor=65%20=%20=9"> <?php echo $conteoRojo; ?></a></center>
                                                </td>
                                        </tr>
                                        <thead>
                                            <td><strong>Alertas</strong> por Fecha de Sesión</td>
                                            <tr>
                                                <th style="background:#A9DFBF;">
                                                    <center> Más de 5 días </center>
                                                    </td>
                                                <th style="background:#F9E79F;">
                                                    <center> Menos de 5 días</center>
                                                    </td>
                                                <th style="background:#F1948A;">
                                                    <center> Menos de 3 días </center>
                                                    </td>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <td style="background:#A9DFBF;">
                                                <center><a href="consulta_procedimientos.php?valor=65%20=%20=10"> <?php echo $conteoVerdeS; ?></a></center>
                                            </td>
                                            <td style="background:#F9E79F;">
                                                <center><a href="consulta_procedimientos.php?valor=65%20=%20=11"> <?php echo $conteoAmarilloS; ?></a></center>
                                            </td>
                                            <th style="background:#F1948A;">
                                                <center><a href="consulta_procedimientos.php?valor=65%20=%20=12"> <?php echo $conteoRojoS; ?></a></center>
                                                </td>
                                        </tr>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="row m-t-25">
                                    <div class="col-lg-4 col-lg-4">
                                        <div class="overview-item overview-item--c2">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <!--<i class="fa-solid fa-envelope-open"></i> -->
                                                        <i class="fa-solid fa-users"></i>
                                                    </div>
                                                    <div class="text">
                                                        <span>Asuntos por Abogados</span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    <canvas id="user-chart"></canvas>
                                                </div>
                                                <?php require_once("grafica1.php"); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-lg-4">
                                        <div class="overview-item overview-item--c2">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <!-- <i class="fa-solid fa-envelope-open"></i> -->
                                                        <i class="fa-solid fa-ranking-star"></i>
                                                    </div>
                                                    <div class="text">
                                                        <span>Asuntos por estatus</span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    <canvas id="user-chart2"></canvas>
                                                    <?php require_once("grafica2.php"); ?>
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
                                                        <i class="fa-solid fa-truck-arrow-right"></i>
                                                    </div>
                                                    <div class="text">
                                                        <span>Asuntos por seguimiento</span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    <canvas id="user-chart3"></canvas>
                                                    <?php require_once("grafica3.php"); ?>
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
                                                        <i class="fa-solid fa-person-military-to-person"></i>
                                                    </div>
                                                    <div class="text">
                                                        <span>Asuntos por prioridad</span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    <canvas id="user-chart4"></canvas>
                                                    <?php require_once("grafica4.php"); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <!-- ASUNTOS POR ACTOR/DEMANDADO-->
                                    <div class="col-lg-4 col-lg-4">
                                        <div class="overview-item overview-item--c4">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <!-- <i class="fa-solid fa-users"></i>-->
                                                        <i class="fa-solid fa-user-tie"></i>
                                                    </div>
                                                    <div class="text">
                                                        <span>Asuntos por actor/demandado</span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    <canvas id="user-chart5"></canvas>
                                                    <?php require_once("grafica5.php"); ?>
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
                                                        <i class="fa-solid fa-oil-well"></i>
                                                        <!-- <i class="fa-solid fa-hammer"></i> -->
                                                    </div>
                                                    <div class="text">
                                                        <span>Asuntos por juicio/procedimiento</span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    <canvas id="user-chart6"></canvas>
                                                    <?php require_once("grafica6.php"); ?>
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
    </div>
    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <!-- <script src="vendor/animsition/animsition.min.js"></script> -->
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