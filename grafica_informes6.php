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
    WHERE captura.estatus=16
    AND captura.fecha_ing BETWEEN '2021-11-01' AND CURDATE()
    GROUP BY tjuicio";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Error en la consulta: ' . mysqli_error($conn));
}

// Variables para almacenar los datos
$totals6 = [];
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
    $totals6[] = $registros; // Agrega los registros al array
    $combo[] = $row["tjuicio"] . " = " . $row["count_registros"];
    $totalRegistros += $registros;
}

// Calcular los porcentajes
$porcentajes = array_map(function ($registro) use ($totalRegistros) {
    return round(($registro / $totalRegistros) * 100, 2) . '%';
}, $totals6);

// Generar las etiquetas con los porcentajes
$etiquetas6 = array_map(function ($comboItem, $porcentaje) {
    return $comboItem . ' (' . $porcentaje . ')';
}, $combo, $porcentajes);

?>

<script>
    var ctx = document.getElementById("user-chart6");

    var etiquetas6 = <?php echo json_encode($etiquetas6); ?>; // Utiliza las etiquetas generadas

    var myChart = new Chart(ctx, {
        type: "pie",
        data: {
            labels: etiquetas6,
            datasets: [{
                label: "Juicio/Procedimiento",
                data: <?php echo json_encode($totals6); ?>,
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
                    var registros = etiquetas6[index];
                    //window.location.href = 'informes_graficas.php?valor=' + registros + '=' + 6;
                }
            }
        }
    });
</script>