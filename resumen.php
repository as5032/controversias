<?php
require_once('config.php');
require_once('xcrud/xcrud.php');
if (empty($_SESSION["id"])) {
    header("location: index.php");
}
$xcrud = Xcrud::get_instance();
$xcrud->buttons_position('left'); // Posicion de los botones
$xcrud->table("logs2"); // tabla seleccionada
$xcrud->unset_remove();
$xcrud->unset_edit();
$xcrud->unset_add();
$xcrud->label('l_nombre', 'Nombre');
$xcrud->label('l_tiempo', 'Fecha');
$xcrud->label('l_ip', 'Ip');
$xcrud->label('l_usuario', 'Usuario'); // Se modifica la etiqueta de la columna
$xcrud->relation('l_usuario', 'logins', 'id', 'usuario'); // Muestra la relacion con una tabla para no mostrar numericos
$xcrud->where("l_usuario not in (1,2,14)"); // se agrega un where a la consulta por dafault
$xcrud->order_by('l_tiempo', 'desc');
//$xcrud->where("seguimiento=0"); // se agrega un where a la consulta por dafault
//$xcrud->relation('l_usuario', 'logins', 'id', 'usuario'); // Muestra la relacion con una tabla para no mostrar numericos
$xcrud->relation('abogado', 'cat_abogado', 'id', 'abogado_user'); // Muestra la relacion con una tabla para no mostrar numericos
//$xcrud->relation('estatus', 'cat_estatus', 'id', 'estatus'); // Muestra la relacion con una tabla para no mostrar numericos
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
    <!-- <script src="js/jquery-3.7.0.min.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <!-- Vendor CSS-->
    <!-- <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all"> -->
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
                                    Reporte de Accesos
                                </div>
                                <div class="row m-t-25">
                                    <div class="col-lg-3 col-lg-3">
                                        <div class="overview-item overview-item--c1">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <i class="fa-solid fa-users"></i>
                                                    </div>
                                                    <div class="text">
                                                        <span>Captura de Registros</span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    <canvas id="user-chart"></canvas>
                                                </div>
                                                <?php
                                                // Configuración de la conexión a MySQL
                                                require_once('conexion_db.php');
                                                // Consulta SQL para obtener los datos de la tabla
                                                $sql = "SELECT usuario, nombre_completo, DATE(updated) AS fecha, COUNT(*) AS accesos
                                                FROM logs 
                                                INNER JOIN logins ON logins.id =logs.updated_by
                                                WHERE table_name='captura' 
                                                AND ACTION='INSERT' 
                                                AND status<>2
                                                AND MONTH(updated) = MONTH(CURRENT_DATE())
                                                GROUP BY usuario
                                                ORDER BY updated DESC";
                                                $result = mysqli_query($conn, $sql);

                                                if (!$result) {
                                                    die('Error en la consulta: ' . mysqli_error($conn));
                                                }
                                                $index = 0;
                                                $totals = [];
                                                $index = 0;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $registros = $row["accesos"];
                                                    $combo[] = $row["accesos"] . " = " . $row["usuario"]; //aqui como re representa labels
                                                    $totals[] = $registros;  // aqui va el od
                                                    $index++;
                                                }
                                                mysqli_free_result($result);
                                                ?>
                                                <script>
                                                    // Percent Chart
                                                    var ctx = document.getElementById("user-chart");
                                                    var etiquetas = <?php
                                                                    $etiquetas = [];
                                                                    foreach ($combo as $index => $combo) {
                                                                        $etiquetas[] = $combo;
                                                                    }
                                                                    echo json_encode($etiquetas);
                                                                    ?>;
                                                    var colores = [
                                                        'rgba(159, 34, 65, 1)', //guinda
                                                        'rgba(35, 91, 78, 1 )',
                                                        'rgba(221, 201, 163, 1)',
                                                        'rgba(152, 152, 154, 1)',
                                                        'rgba(105, 28, 50,1)',
                                                        'rgba(16, 49, 43, 1)',
                                                        'rgba(188, 149, 92,1)',
                                                        'rgba(111, 114, 113, 1)'
                                                    ]

                                                    var myChart = new Chart(ctx, {
                                                        type: "doughnut",
                                                        data: {
                                                            labels: etiquetas, // Usa el arreglo de etiquetas
                                                            datasets: [{
                                                                label: "Modificaciones", //etiqueta en la presentacion de abogados
                                                                data: <?php echo json_encode($totals); ?>,
                                                                backgroundColor: colores,
                                                                borderColor: "black",
                                                                borderWidth: 1,
                                                                hoverBorderWidth: 4,
                                                            }],
                                                            borderWidth: [
                                                                0, 0
                                                            ],
                                                            hoverBorderColor: [
                                                                'transparent',
                                                                'transparent'
                                                            ]

                                                        },
                                                        options: {
                                                            maintainAspectRatio: false,
                                                            responsive: false,
                                                            cutoutPercentage: 55,
                                                            animation: {
                                                                animateScale: true,
                                                                animateRotate: true
                                                            },
                                                            layout: {
                                                                padding: {
                                                                    left: 20, // Ajusta este valor según tu preferencia
                                                                    right: 20, // Ajusta este valor según tu preferencia
                                                                    top: 0, // Ajusta este valor según tu preferencia
                                                                    bottom: 20 // Ajusta este valor según tu preferencia
                                                                }
                                                            },
                                                            plugins: {
                                                                legend: {
                                                                    display: true,
                                                                    position: 'bottom',
                                                                    labels: {
                                                                        color: 'black', // Color del texto en las etiquetas
                                                                        font: {
                                                                            size: 12,
                                                                            family: 'Montserrat',
                                                                        }
                                                                    }
                                                                },
                                                            }
                                                        }
                                                    });
                                                    <?php
                                                    //print_r($etiquetas);
                                                    ?>
                                                </script>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-lg-4">
                                        <div class="overview-item overview-item--c2">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <i class="fa-regular fa-calendar-days"></i>
                                                    </div>
                                                    <div class="text">
                                                        <span>Accesos por Día</span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    <canvas id="user-chart2"></canvas>
                                                </div>
                                            </div>
                                            <?php
                                            // Configuración de la conexión a MySQL
                                            require_once('conexion_db.php');

                                            // Consulta SQL para obtener los datos de la tabla
                                            $sql = "SELECT 
                                                usuario, 
                                                nombre_completo, 
                                                DATE(l_tiempo) AS fecha, 
                                                COUNT(*) AS accesos
                                            FROM 
                                                logs2
                                            INNER JOIN 
                                                logins ON logins.id = logs2.l_usuario
                                            WHERE 
                                                l_usuario NOT IN (1, 2, 14)
                                                AND MONTH(logs2.l_tiempo) = MONTH(CURDATE())
                                                AND YEAR(logs2.l_tiempo) = YEAR(CURDATE())
                                            GROUP BY 
                                                usuario, nombre_completo, fecha
                                            ORDER BY 
                                                fecha DESC
                                            LIMIT 10";
                                            $result = mysqli_query($conn, $sql);

                                            if (!$result) {
                                                die('Error en la consulta: ' . mysqli_error($conn));
                                            }
                                            // Arrays para almacenar los datos de la consulta
                                            $index = 0;
                                            //$asunto = [];
                                            $totals = [];
                                            $combo = [];
                                            // Recorrer los resultados y almacenar los datos en los arrays
                                            $index = 0;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $registros = $row["accesos"];
                                                $fecha = $row["fecha"]; // aqui se comienza el invertido de la fecha
                                                $Trabajo_fecha = $fecha;
                                                $TAno = substr($Trabajo_fecha, 0, 4); // Se obtiene el año
                                                $TMes = substr($Trabajo_fecha, 5, 2); //Se obtiene el mes
                                                $TDia = substr($Trabajo_fecha, 8, 2); //Se obtiene el Dia
                                                $fecha = $TDia . "/" . $TMes . "/" . $TAno; // aqui se termina
                                                //$combo[] = $fecha . " = " . $row["usuario"];
                                                $combo[] = $registros . " = " . $row["usuario"] . " = " . $fecha;
                                                $totals[] = $registros; // Agrega los días restantes al array totals
                                                $index++;
                                            }
                                            mysqli_free_result($result);
                                            ?>
                                            <script>
                                                var ctx = document.getElementById("user-chart2");

                                                // Crear un arreglo de etiquetas que combine el juicio_proced y el abogado
                                                var etiquetas = <?php
                                                                $etiquetas = [];
                                                                foreach ($combo as $index => $combo) {
                                                                    $etiquetas[] = $combo;
                                                                }
                                                                echo json_encode($etiquetas);
                                                                ?>;

                                                var myChart = new Chart(ctx, {
                                                    type: "bar",
                                                    data: {
                                                        labels: etiquetas,
                                                        datasets: [{
                                                            label: "Cantidad de entradas", //etiqueta en la presentacion de abogados
                                                            data: <?php echo json_encode($totals); ?>,
                                                            backgroundColor: colores,
                                                            borderColor: "black",
                                                            borderWidth: 1,
                                                            hoverBorderWidth: 4,
                                                        }],
                                                        borderWidth: [
                                                            0, 0
                                                        ],
                                                        hoverBorderColor: [
                                                            'transparent',
                                                            'transparent'
                                                        ]
                                                    },
                                                    options: {
                                                        maintainAspectRatio: false,
                                                        responsive: true,
                                                        cutoutPercentage: 55,
                                                        animation: {
                                                            animateScale: true,
                                                            animateRotate: true
                                                        },
                                                        plugins: {
                                                            legend: {
                                                                display: false,
                                                                position: 'bottom',
                                                                labels: {
                                                                    color: 'black', // Color del texto en las etiquetas
                                                                    font: {
                                                                        size: 12,
                                                                        family: 'Montserrat',
                                                                    }
                                                                }
                                                            },
                                                        },
                                                        tooltips: {
                                                            titleFontFamily: "Poppins",
                                                            xPadding: 15,
                                                            yPadding: 10,
                                                            caretPadding: 0,
                                                            bodyFontSize: 16,
                                                        },
                                                        layout: {
                                                            padding: {
                                                                left: 40,
                                                                right: 40,
                                                                top: 40,
                                                                bottom: 40
                                                            }
                                                        },

                                                    }
                                                });
                                            </script>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-lg-4">
                                        <div class="overview-item overview-item--c4">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <i class="fa-solid fa-user-tie"></i>
                                                    </div>
                                                    <div class="text">
                                                        <span>Seguimiento</span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    <canvas id="user-chart3"></canvas>
                                                </div>
                                                <?php
                                                // Configuración de la conexión a MySQL
                                                require_once('conexion_db.php');

                                                // Consulta SQL para obtener los juicios_proced
                                                /*$sql = "SELECT logins.usuario AS tipo_usuario, 
                                                    COUNT(*) AS numero_registros
                                                FROM registro_cambios
                                                INNER JOIN logins ON logins.id = registro_cambios.id_usuario
                                                WHERE id_usuario NOT IN (1, 2, 14)
                                                GROUP BY logins.usuario";*/

                                                $sql= "SELECT logins.usuario, COUNT(*) AS numero_registros
                                                FROM logs
                                                INNER JOIN logins ON logins.id = logs.updated_by
                                                WHERE updated_by NOT IN (1, 2, 14)
                                                AND table_name='captura' 
												AND MONTH(logs.updated) = MONTH(CURRENT_DATE())
                                            	AND YEAR(logs.updated) = YEAR(CURRENT_DATE())
                                                AND action='UPDATE'
                                                GROUP BY logins.usuario";
                                                $result = mysqli_query($conn, $sql);
                                                if (!$result) {
                                                    die('Error en la consulta: ' . mysqli_error($conn));
                                                }

                                                // Arrays para almacenar los datos de la consulta
                                                $index = 0;
                                                $totals = [];
                                                $combo = [];
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $registros = $row["numero_registros"];
                                                    $combo[] = $row["numero_registros"] . " = " . $row["usuario"];
                                                    $totals[] = $registros; // Agrega los días restantes al array totals
                                                    $index++;
                                                }

                                                mysqli_free_result($result);
                                                ?>
                                                <script>
                                                    var ctx = document.getElementById("user-chart3");

                                                    // Crear un arreglo de etiquetas que combine el juicio_proced y el abogado
                                                    var etiquetas = <?php
                                                                    $etiquetas = [];
                                                                    foreach ($combo as $index => $combo) {
                                                                        $etiquetas[] = $combo;
                                                                    }
                                                                    echo json_encode($etiquetas);
                                                                    ?>;

                                                    var myChart = new Chart(ctx, {
                                                        type: "polarArea",
                                                        data: {
                                                            labels: etiquetas,
                                                            datasets: [{
                                                                label: "seguimientos",
                                                                data: <?php echo json_encode($totals); ?>, //etiqueta en la presentacion de abogados
                                                                backgroundColor: colores,
                                                                borderColor: "black",
                                                                borderWidth: 1,
                                                                hoverBorderWidth: 4,
                                                            }],
                                                            borderWidth: [
                                                                0, 0
                                                            ],
                                                            hoverBorderColor: [
                                                                'transparent',
                                                                'transparent'
                                                            ]
                                                        },
                                                        options: {
                                                            maintainAspectRatio: false,
                                                            responsive: true,
                                                            cutoutPercentage: 55,
                                                            animation: {
                                                                animateScale: true,
                                                                animateRotate: true
                                                            },
                                                            plugins: {
                                                                legend: {
                                                                    display: true,
                                                                    position: 'bottom',
                                                                    labels: {
                                                                        color: 'black', // Color del texto en las etiquetas
                                                                        font: {
                                                                            size: 12,
                                                                            family: 'Montserrat',
                                                                        }
                                                                    }
                                                                },
                                                            },
                                                            tooltips: {
                                                                titleFontFamily: "Poppins",
                                                                xPadding: 15,
                                                                yPadding: 10,
                                                                caretPadding: 0,
                                                                bodyFontSize: 16,
                                                            },
                                                            layout: {
                                                                padding: {
                                                                    left: 0,
                                                                    right: 0,
                                                                    top: 0,
                                                                    bottom: 0
                                                                }
                                                            },

                                                        }
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-lg-4">
                                    </div>
                                    <div class="col-lg-4 col-lg-4">
                                    </div>
                                    <div class="col-lg-11 col-lg-11" style="font-size: 14px;">
                                        <?php
                                        echo $xcrud->render();
                                        ?>
                                    </div>
                                    <div class="col-lg-4 col-lg-4">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jquery JS-->
        <!-- <script src="vendor/jquery-3.2.1.min.js"></script>-->
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
</body>

</html>