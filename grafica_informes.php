<?php
require_once('conexion_db.php');
$sql = "SELECT
    cat_juicio.t_juicio AS tjuicio,
    MONTHNAME(fecha_cap) AS month,
    IFNULL(COUNT(captura.juicio_proced), 0) AS count_registros
FROM 
    captura
LEFT JOIN 
    cat_juicio ON captura.juicio_proced = cat_juicio.id
WHERE 
    captura.estatus <> 16
    AND fecha_cap >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)
GROUP BY 
    tjuicio, month
ORDER BY 
    FIELD(MONTH(fecha_cap), 1, 2, 3, 4,5,6,7,8,9,10,11,12);";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Error en la consulta: ' . mysqli_error($conn));
}
$totals = [];
$combo = [];
$dorado =  'rgba(188, 149, 92,  1)';
$vino = 'rgba(105,28,50, 1)';
$totalRegistros = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $juicio = $row["tjuicio"];
    if ($juicio == "ACCION DE INCONSTITUCIONALIDAD") {
        $colors[] = $dorado;
    } elseif ($juicio == "CONTROVERSIA CONSTITUCIONAL") {
        $colors[] = $vino;
    }
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
    $registros = $row["count_registros"];
    $totals[] = $registros; // Agrega los registros al array
    $combo[] = $mes . " = " . $row["count_registros"];
    $totalRegistros += $registros;
}
$porcentajes = array_map(function ($registro) use ($totalRegistros) {
    return round(($registro / $totalRegistros) * 100, 2) . '%';
}, $totals);
$etiquetas = array_map(function ($comboItem, $porcentaje) {
    return $comboItem . ' (' . $porcentaje . ')';
}, $combo, $porcentajes);
?>
<script>
    var ctx = document.getElementById("user-chart");
    var etiquetas = <?php echo json_encode($etiquetas); ?>; // Utiliza las etiquetas generadas
    var myChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: etiquetas,
            datasets: [{
                label: "Juicio/Procedimiento",
                data: <?php echo json_encode($totals); ?>,
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
                    var registros = etiquetas[index];
                    //window.location.href = 'informes_graficas.php?valor=' + registros + '=' + 1;
                }
            }
        }
    });
</script>