<?php
require_once('config.php');
if (empty($_SESSION["id"])) {
    header("location: index.php");
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
    <style>
        #mi-div {
            text-align: center;
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
                            <div class="card-header" style="font-size: 25px;">
                                <strong>Consulta</strong> Concluidos
                            </div>
                            <div class="card-body card-block h-100">

                                <div class="tabla-responsiva" style="max-height: 600px; overflow-y: auto;">
                                    <div style="font-size: 17px;">
                                        Mostrar/Ocultar columnas:
                                    </div>
                                    <form action="" method="POST" class="h-100" id="miFormulario" name="miFormulario" enctype="multipart/form-data">
                                        <div style="font-size: 17px;">
                                            <div align="center">
                                                <a href="#" style="text-decoration: underline" onclick="SubmitFormData('fecha_cap');" class="toggle-vis" data-column="1">Fecha de captura</a> -
                                                <a href="#" style="text-decoration: underline" onclick="SubmitFormData('fecha_ing');" class="toggle-vis" data-column="2">Fecha de ingreso</a> -
                                                <a href="#" style="text-decoration: underline" onclick="SubmitFormData('fecha_ven');" class="toggle-vis" data-column="3">Fecha de vencimiento</a> -
                                                <a href="#" style="text-decoration: underline" onclick="SubmitFormData('fecha_ses');" class="toggle-vis" data-column="4">Fecha de sesión</a> -
                                                <a href="#" style="text-decoration: underline" onclick="SubmitFormData('num_exp');" class="toggle-vis" 
                                                data-column="5"># de Expediente</a> -
                                                <a href="#" style="text-decoration: underline" onclick="SubmitFormData('num_int');" class="toggle-vis" 
                                                data-column="6"># Interno</a> -
                                                <a href="#" style="text-decoration: underline" onclick="SubmitFormData('juicio_proced');" class="toggle-vis" data-column="7">Juicio/Procedimiento</a> -
                                                <a href="#" style="text-decoration: underline" onclick="SubmitFormData('actores');" class="toggle-vis" 
                                                data-column="8">Actor/Demandado</a>
                                                <br>
                                                <a href="#" style="text-decoration: underline" onclick="SubmitFormData('accionante');" class="toggle-vis" data-column="9">Accionante</a> -
                                                <a href="#" style="text-decoration: underline" onclick="SubmitFormData('estatus');" class="toggle-vis" data-column="10">Estatus</a> -
                                                <a href="#" style="text-decoration: underline" onclick="SubmitFormData('abogado');" class="toggle-vis" data-column="11">Abogado</a> -
                                                <a href="#" style="text-decoration: underline" onclick="SubmitFormData('ministro');" class="toggle-vis" data-column="12">Ministro/Instructor</a> -
                                                <a href="#" style="text-decoration: underline" onclick="SubmitFormData('asunto');" class="toggle-vis" data-column="13">Asunto</a> -
                                                <a href="#" style="text-decoration: underline" onclick="SubmitFormData('seguimiento');" class="toggle-vis" data-column="14">Seguimiento</a> -
                                                <a href="#" style="text-decoration: underline" onclick="SubmitFormData('prioridad');" class="toggle-vis" data-column="15">Prioridad</a> -
                                                <a href="#" style="text-decoration: underline" onclick="SubmitFormData('acuse');" class="toggle-vis" data-column="16">Expediente PDF</a> -
                                                <a href="#" style="text-decoration: underline" onclick="SubmitFormData('observaciones');" class="toggle-vis" data-column="17">Observaciones</a>
                                            </div>
                                        </div>
                                        <br>
                                </div>
                                <div class="row">
                                    <div class="col-2"></div>
                                    <div class="col-3">
                                    </div>
                                    <div class="col-2">
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                        </div>
                                    </div>
                                </div>
                                <div id="mi-div">
                                    <input type="button" id="submitFormData" onclick="SubmitFormData();" value="Mostrar Tabla" class="btn btn-success btn-lg" />
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="results">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 h-100">
                            <?php //echo "<h2 class='titulo-h2'>Se encontraron " . $cuantos . " registros</h2>"; 
                            ?>
                            <div class="card h-100">
                                <div class="card-body card-block h-100">
                                    <div class="row">
                                        <div class="col-3">
                                        </div>
                                    </div>
                                    <div style="font-size: 14px;">
                                        <?php
                                        //$xcrud->query($qry2);
                                        //echo $xcrud->render();
                                        ?>
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
    <!DOCTYPE html>
    <html>

    <head>
    </head>

    <body>
        <script>
            function SubmitFormData(columnName) {
                var value = $("#" + columnName).text();

                $.post("ajax_procedimientos_con.php", {
                    columnName: columnName,
                    value: value
                }, function(data) {
                    $('#results').html(data);
                    $('#miFormulario')[0].reset();
                });
            }

            function Refrescar() {
                document.miFormulario.action = 'consulta_procedimientos_con.php';
                document.miFormulario.submit();
            }
        </script>
    </body>

    </html>
</body>

</html>