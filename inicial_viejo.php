<?php
require_once('config.php');


if (empty($_SESSION["id"])) {
    header("location: index.php");
}

$pagina = 'inicial.php';
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
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
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

<body class="animsition">
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
                                <div class="card-header">
                                    <strong>Menú</strong> Principal
                                </div>
                                <div class="row m-t-25">
                                    <div class="col-lg-4 col-lg-4">
                                        <div class="overview-item overview-item--c1">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <i class="fa-solid fa-users"></i>
                                                    </div>
                                                    <div class="text">
                                                        <span>Asuntos por abogado</span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    <canvas id="user-chart"></canvas>
                                                </div>
                                                <?php
                                                // Configuración de la conexión a MySQL
                                                require_once('conexion_db.php');

                                                // Consulta SQL para obtener los datos de la tabla
                                                $sql = "SELECT
                                                        cat_abogado.n_abogado AS abogado,
                                                        COUNT(captura.juicio_proced) AS count_registros
                                                        FROM 
                                                            captura
                                                        LEFT JOIN cat_abogado ON captura.abogado = cat_abogado.id
                                                        GROUP BY abogado;";
                                                $result = mysqli_query($conn, $sql);

                                                if (!$result) {
                                                    die('Error en la consulta: ' . mysqli_error($conn));
                                                }

                                                // Arrays para almacenar los datos de la consulta
                                                $index = 0;
                                                $abogs = [];
                                                $totals = [];

                                                // Recorrer los resultados y almacenar los datos en los arrays
                                                $index = 0;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $registros = $row["count_registros"];
                                                    $abogs[] = $row["abogado"];
                                                    $totals[] = $registros; // Agrega los días restantes al array totals
                                                    $index++;
                                                }

                                                mysqli_free_result($result);

                                                ?>
                                                <script>
                                                    // Percent Chart
                                                    var ctx = document.getElementById("user-chart");

                                                    // Crear un arreglo de etiquetas que combine el juicio_proced y el abogado
                                                    var etiquetas = <?php
                                                    $etiquetas = [];
                                                    foreach ($abogs as $index => $abogs) {
                                                        $etiquetas[] = $abogs;
                                                    }
                                                    echo json_encode($etiquetas);
                                                    ?>;

                                                    var colores = [
                                                        '#EB623F',
                                                        '#EB9E3F',
                                                        '#EB803F',
                                                        '#EB443F',
                                                        '#EAB646',
                                                        '#EB503F',
                                                        '#EB8C3E',
                                                        '#EBA638'
                                                    ]

                                                    var myChart = new Chart(ctx, {
                                                        type: "doughnut",
                                                        data: {
                                                            labels: etiquetas, // Usa el arreglo de etiquetas
                                                            datasets: [{
                                                                label: "Jucios/Procedimientos asignados",
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
                                                            layout: {
                                                                padding: {
                                                                    left: 40, // Ajusta este valor según tu preferencia
                                                                    right: 40, // Ajusta este valor según tu preferencia
                                                                    top: 40, // Ajusta este valor según tu preferencia
                                                                    bottom: 40 // Ajusta este valor según tu preferencia
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
                                                </script>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-lg-4">
                                        <div class="overview-item overview-item--c2">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <i class="fa-solid fa-envelope-open"></i>
                                                    </div>
                                                    <div class="text">
                                                        <span>Asuntos por estatus</span>
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
                                                    cat_estatus.estatus AS estatus,
                                                    COUNT(captura.juicio_proced) AS count_registros
                                                    FROM 
                                                        captura
                                                    LEFT JOIN cat_estatus ON captura.estatus = cat_estatus.id
                                                    GROUP BY estatus;";

                                            $result = mysqli_query($conn, $sql);

                                            if (!$result) {
                                                die('Error en la consulta: ' . mysqli_error($conn));
                                            }



                                            // Arrays para almacenar los datos de la consulta
                                            $index = 0;
                                            $asunto = [];
                                            $totals = [];

                                            // Recorrer los resultados y almacenar los datos en los arrays
                                            $index = 0;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $registros = $row["count_registros"];
                                                $asunto[] = $row["estatus"];
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
                                                foreach ($asunto as $index => $asunto) {
                                                    $etiquetas[] = $asunto;
                                                }
                                                echo json_encode($etiquetas);
                                                ?>;

                                                var colores = [
                                                    '#A1EB3B',
                                                    '#3BEB5F',
                                                    '#57EB3B',
                                                    '#EAEB52',
                                                    '#38EB9A',
                                                    '#C7EB3B',
                                                    '#7DEB3B',
                                                    '#EBE03B',
                                                    '#EBB43B',
                                                    '#CAEB3B',
                                                    '#EBCA3B',
                                                    '#7FEA52',
                                                    '#EBB734'
                                                ]

                                                var myChart = new Chart(ctx, {
                                                    type: "doughnut",
                                                    data: {
                                                        labels: etiquetas,
                                                        datasets: [{
                                                            label: "Juicio/Procedimiento en estatus",
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
                                                        <span>Asuntos por seguimiento</span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    <canvas id="user-chart3"></canvas>
                                                </div>
                                                <?php
                                                // Configuración de la conexión a MySQL
                                                require_once('conexion_db.php');

                                                // Consulta SQL para obtener los juicios_proced
                                                $sql = "SELECT
                                                        cat_seguimiento.seguimiento AS seguimiento,
                                                        COUNT(captura.juicio_proced) AS count_registros
                                                        FROM 
                                                            captura
                                                        LEFT JOIN cat_seguimiento ON captura.seguimiento = cat_seguimiento.id
                                                        GROUP BY seguimiento;";

                                                $result = mysqli_query($conn, $sql);

                                                if (!$result) {
                                                    die('Error en la consulta: ' . mysqli_error($conn));
                                                }

                                                // Arrays para almacenar los datos de la consulta
                                                $index = 0;
                                                $estatus = [];
                                                $totals = [];

                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $registros = $row["count_registros"];
                                                    $estatus[] = $row["seguimiento"];
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
                                                    foreach ($estatus as $index => $estatus) {
                                                        $etiquetas[] = $estatus;
                                                    }
                                                    echo json_encode($etiquetas);
                                                    ?>;

                                                    var colores = [
                                                        '#3BC1EB',
                                                        '#3B52EB',
                                                        '#3B89EB',
                                                        '#47EBDE',
                                                        '#5D3BEB'
                                                    ]

                                                    var myChart = new Chart(ctx, {
                                                        type: "doughnut",
                                                        data: {
                                                            labels: etiquetas,
                                                            datasets: [{
                                                                label: "Juicio/Procedimiento en estatus",
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
                                    </div>

                                    <div class="col-lg-4 col-lg-4">
                                        <div class="overview-item overview-item--c4">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <i class="fa-regular fa-calendar-days"></i>
                                                    </div>
                                                    <div class="text">
                                                        <span>Asuntos por prioridad</span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    <canvas id="user-chart4"></canvas>
                                                </div>
                                                <?php
                                                // Configuración de la conexión a MySQL
                                                require_once('conexion_db.php');

                                                // Consulta SQL para obtener los juicios_proced
                                                $sql = "SELECT
                                                        cat_prioridad.nivel AS prioridad,
                                                        COUNT(captura.juicio_proced) AS count_registros
                                                        FROM 
                                                            captura
                                                        LEFT JOIN cat_prioridad ON captura.prioridad = cat_prioridad.id
                                                        GROUP BY prioridad;";

                                                $result = mysqli_query($conn, $sql);

                                                if (!$result) {
                                                    die('Error en la consulta: ' . mysqli_error($conn));
                                                }

                                                // Arrays para almacenar los datos de la consulta
                                                $index = 0;
                                                $prioridad = [];
                                                $totals = [];
                                                $colors = [];

                                                // Colores personalizados según los rangos de prioridad
                                                
                                                $colorVerdeFuerte = "#36E066"; // Baja
                                                $colorAmarillo = "#E0BC36"; // Media
                                                $colorRojoClaro = "#E03535"; // Alta
                                                

                                                $index = 0;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $registros = $row["count_registros"];
                                                    $prioridadActual = $row["prioridad"];

                                                    if ($prioridadActual == "ALTA") {
                                                        $colors[] = $colorRojoClaro;
                                                    } elseif ($prioridadActual == "MEDIA") {
                                                        $colors[] = $colorAmarillo;
                                                    } elseif ($prioridadActual == "BAJA") {
                                                        $colors[] = $colorVerdeFuerte;
                                                    }

                                                    $prioridad[] = $prioridadActual;
                                                    $totals[] = $registros;
                                                    $index++;
                                                }

                                                mysqli_free_result($result);
                                                ?>
                                                <script>
                                                    var ctx = document.getElementById("user-chart4");

                                                    // Crear un arreglo de etiquetas que combine el juicio_proced y el abogado
                                                    var etiquetas = <?php
                                                    $etiquetas = [];
                                                    foreach ($prioridad as $index => $prioridad) {
                                                        $etiquetas[] = $prioridad;
                                                    }
                                                    echo json_encode($etiquetas);
                                                    ?>;

                                                    var myChart = new Chart(ctx, {
                                                        type: "doughnut",
                                                        data: {
                                                            labels: etiquetas,
                                                            datasets: [{
                                                                label: "Juicio/Procedimiento con prioridad",
                                                                data: <?php echo json_encode($totals); ?>,
                                                                backgroundColor: <?php echo json_encode($colors); ?>,
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
                                    </div>

                                    <div class="col-lg-4 col-lg-4">
                                        <div class="overview-item overview-item--c4">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <i class="fa-solid fa-users"></i>
                                                    </div>
                                                    <div class="text">
                                                        <span>Asuntos por actor/demandado</span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    <canvas id="user-chart5"></canvas>
                                                </div>
                                                <?php
                                                // Configuración de la conexión a MySQL
                                                require_once('conexion_db.php');

                                                // Consulta SQL para obtener los datos de la tabla
                                                $sql = "SELECT
                                                        cat_actor.actord AS actores,
                                                        COUNT(captura.juicio_proced) AS count_registros
                                                        FROM 
                                                            captura
                                                        LEFT JOIN cat_actor ON captura.actores = cat_actor.id
                                                        GROUP BY actores;";
                                                $result = mysqli_query($conn, $sql);

                                                if (!$result) {
                                                    die('Error en la consulta: ' . mysqli_error($conn));
                                                }

                                                // Arrays para almacenar los datos de la consulta
                                                $index = 0;
                                                $abogs = [];
                                                $totals = [];

                                                // Recorrer los resultados y almacenar los datos en los arrays
                                                $index = 0;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $registros = $row["count_registros"];
                                                    $abogs[] = $row["actores"];
                                                    $totals[] = $registros; // Agrega los días restantes al array totals
                                                    $index++;
                                                }

                                                mysqli_free_result($result);

                                                ?>
                                                <script>
                                                    // Percent Chart
                                                    var ctx = document.getElementById("user-chart5");

                                                    // Crear un arreglo de etiquetas que combine el juicio_proced y el abogado
                                                    var etiquetas = <?php
                                                    $etiquetas = [];
                                                    foreach ($abogs as $index => $abogs) {
                                                        $etiquetas[] = $abogs;
                                                    }
                                                    echo json_encode($etiquetas);
                                                    ?>;

                                                    var colores = [
                                                        '#3C70FA',
                                                        '#FA1D69'
                                                    ]

                                                    var myChart = new Chart(ctx, {
                                                        type: "doughnut",
                                                        data: {
                                                            labels: etiquetas, // Usa el arreglo de etiquetas
                                                            datasets: [{
                                                                label: "Jucios/Procedimientos asignados",
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
                                                            layout: {
                                                                padding: {
                                                                    left: 40, // Ajusta este valor según tu preferencia
                                                                    right: 40, // Ajusta este valor según tu preferencia
                                                                    top: 40, // Ajusta este valor según tu preferencia
                                                                    bottom: 40 // Ajusta este valor según tu preferencia
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
                                                </script>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-lg-4">
                                        <div class="overview-item overview-item--c2">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <i class="fa-solid fa-envelope-open"></i>
                                                    </div>
                                                    <div class="text">
                                                        <span>Asuntos por juicio/procedimiento</span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    <canvas id="user-chart6"></canvas>
                                                </div>
                                            </div>
                                            <?php
                                            // Configuración de la conexión a MySQL
                                            require_once('conexion_db.php');

                                            // Consulta SQL para obtener los datos de la tabla
                                            $sql = "SELECT
                                                    cat_juicio.t_juicio AS tjuicio,
                                                    COUNT(captura.juicio_proced) AS count_registros
                                                    FROM 
                                                        captura
                                                    LEFT JOIN cat_juicio ON captura.juicio_proced = cat_juicio.id
                                                    GROUP BY tjuicio;";

                                            $result = mysqli_query($conn, $sql);

                                            if (!$result) {
                                                die('Error en la consulta: ' . mysqli_error($conn));
                                            }



                                            // Arrays para almacenar los datos de la consulta
                                            $index = 0;
                                            $asunto = [];
                                            $totals = [];

                                            // Recorrer los resultados y almacenar los datos en los arrays
                                            $index = 0;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $registros = $row["count_registros"];
                                                $asunto[] = $row["tjuicio"];
                                                $totals[] = $registros; // Agrega los días restantes al array totals
                                                $index++;
                                            }

                                            mysqli_free_result($result);

                                            mysqli_close($conn);

                                            ?>
                                            <script>
                                                var ctx = document.getElementById("user-chart6");

                                                // Crear un arreglo de etiquetas que combine el juicio_proced y el abogado
                                                var etiquetas = <?php
                                                $etiquetas = [];
                                                foreach ($asunto as $index => $asunto) {
                                                    $etiquetas[] = $asunto;
                                                }
                                                echo json_encode($etiquetas);
                                                ?>;

                                                var colores = [
                                                    '#AF3CFA',
                                                    '#FA823C'
                                                ]

                                                var myChart = new Chart(ctx, {
                                                    type: "doughnut",
                                                    data: {
                                                        labels: etiquetas,
                                                        datasets: [{
                                                            label: "Juicio/Procedimiento en estatus",
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