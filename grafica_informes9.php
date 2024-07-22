<?php
// Configuración de la conexión a MySQL
require('conexion_db.php');

// Consulta SQL para obtener los datos de la tabla
$sql2 = "SELECT *, MONTHNAME(fecha) AS month FROM `normas` WHERE 1;";

$result2 = mysqli_query($conn, $sql2);

if (!$result2) {
    die('Error en la consulta: ' . mysqli_error($conn));
}

// Variables para almacenar los datos
$totals9 = [];
$combo = [];
// Total de registros para calcular porcentaje
$totalRegistros = 0;
$color2 = [ //COLORES unicos para esta grafica
    'rgba(159, 34, 65, 1)', //GUINDA
    'rgba(35, 91, 78, 1 )',
    'rgba(159, 34, 65, 1)', //rojo
    'rgba(231, 17, 13, 1)', //che
    'rgba(99, 57, 116, 1)', //rosa
    'rgba( 185, 182, 9, 1)', //amarillo2
    'rgba(156, 100, 12,  1)', //cafe
    'rgba(17, 120, 100, 1)', //verde
    'rgba(158,87,179, 1)', //rosabajo
    'rgba(28,87,176, 1)', //azulfuerte
    'rgba(222,240,40, 1)', //amarillo
    'rgba(33, 97, 140, 1)', //azul
    'rgba(255,161,25, 1)', //naranja
    'rgba(247, 249, 249, 1)' //blanco
];
// Recorrer los resultados y almacenar los datos
while ($row = mysqli_fetch_assoc($result2)) {
    $mes = $row["month"];
    if ($mes == "January") {
        $mes = "Enero";
    } elseif ($mes == "February") {
        $mes = "Febrero";
    } elseif ($mes == "March") {
        $mes = "Marzo";
    } elseif ($mes == "April") {
        $mes = "Abril";
    } elseif ($mes == "May") {
        $mes = "Mayo";
    } elseif ($mes == "June") {
        $mes = "Junio";
    } elseif ($mes == "July") {
        $mes = "Julio";
    } elseif ($mes == "August") {
        $mes = "Agosto";
    } elseif ($mes == "September") {
        $mes = "Septiembre";
    } elseif ($mes == "October") {
        $mes = "Octubre";
    } elseif ($mes == "November") {
        $mes = "Noviembre";
    } elseif ($mes == "December") {
        $mes = "Diciembre";
    }
    $registros = $row["cantidad"];
    $totals9[] = $registros; // Agrega los registros al array
    $combo[] = $mes;
    $totalRegistros += $registros;
}

// Calcular los porcentajes
$porcentajes = array_map(function ($registro) use ($totalRegistros) {
    return round(($registro / $totalRegistros) * 100, 2) . '%';
}, $totals9);

// Generar las etiquetas con los porcentajes
$etiquetas9 = array_map(function ($comboItem, $porcentaje) {
    return $comboItem . ' (' . $porcentaje . ')';
}, $combo, $porcentajes);


?>

<script>
    var ctx = document.getElementById("user-chart9");

    var etiquetas9 = <?php echo json_encode($etiquetas9); ?>; // Utiliza las etiquetas generadas

    var myChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: etiquetas9,
            datasets: [{
                label: "Juicio/Procedimiento",
                data: <?php echo json_encode($totals9); ?>,
                backgroundColor: <?php echo json_encode($color2); ?>,
                borderColor: "grey",
                borderWidth: 1,
                hoverBorderWidth: 4,
            }],
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
                        color: 'black',
                        font: {
                            size: 12,
                            family: 'Montserrat',
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            var value = context.formattedValue;
                            if (value) {
                                label += value;
                            }
                            return label;
                        }
                    }
                }
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
                    top: 40,
                    bottom: 40
                }
            },
            onClick: function(event, elements) {
                if (elements.length > 0) {
                    var index = elements[0].index;
                    var value = data.datasets[0].data[index];
                    var registros = etiquetas9[index];
                    //window.location.href = 'informes_graficas.php?valor=' + registros + '=' + 9;
                }
            }
        }
    });
</script>