<?php
// Configuración de la conexión a MySQL
require_once('conexion_db.php');

// Consulta SQL para obtener los datos de la tabla
$sql = 'SELECT cat_juicio.t_juicio AS tjuicio,
COUNT(captura.juicio_proced) AS count_registros
FROM captura
LEFT JOIN cat_juicio ON captura.juicio_proced = cat_juicio.id
WHERE captura.actores = 1
GROUP BY captura.juicio_proced, cat_juicio.t_juicio';

$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Error en la consulta: ' . mysqli_error($conn));
}

// Variables para almacenar los datos
$totals4 = [];
$combo = [];

// Total de registros para calcular porcentaje
$totalRegistros = 0;

// Recorrer los resultados y almacenar los datos
while ($row = mysqli_fetch_assoc($result)) {
    $juicio = $row["tjuicio"];
    if ($juicio == "ACCION DE INCONSTITUCIONALIDAD") {
        $colors[] = $dorado;
    } elseif ($juicio == "CONTROVERSIA CONSTITUCIONAL") {
        $colors[] = $vino;
    }
    $registros = $row["count_registros"];
    $totals4[] = $registros; // Agrega los registros al array
    $combo[] = $row["tjuicio"] . " = " . $row["count_registros"];
    $totalRegistros += $registros;
}

// Calcular los porcentajes
$porcentajes = array_map(function ($registro) use ($totalRegistros) {
    return round(($registro / $totalRegistros) * 100, 2) . '%';
}, $totals4);

// Generar las etiquetas con los porcentajes
$etiquetas4 = array_map(function ($comboItem, $porcentaje) {
    return $comboItem . ' (' . $porcentaje . ')';
}, $combo, $porcentajes);


?>

<script>
    var ctx = document.getElementById("user-chart4");

    var etiquetas4 = <?php echo json_encode($etiquetas4); ?>; // Utiliza las etiquetas generadas

    var myChart = new Chart(ctx, {
        type: "pie",
        data: {
            labels: etiquetas4,
            datasets: [{
                label: "Juicio/Procedimiento",
                data: <?php echo json_encode($totals4); ?>,
                backgroundColor: <?php echo json_encode($colors); ?>,
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
                    display: true,
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
                    var registros = etiquetas4[index];
                    //window.location.href = 'informes_graficas.php?valor=' + registros + '=' + 4;
                }
            }
        }
    });
</script>