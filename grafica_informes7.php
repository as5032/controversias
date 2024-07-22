<?php
require_once('conexion_db.php');
$sql = "SELECT
    m.month AS month,
    IFNULL(COUNT(captura.idcaptura), 0) AS count_registros
FROM
    (
        SELECT 'January' AS month, 1 AS month_number
        UNION SELECT 'February', 2
        UNION SELECT 'March', 3
        UNION SELECT 'April', 4
        UNION SELECT 'May', 5
        UNION SELECT 'June', 6
        UNION SELECT 'July', 7
        UNION SELECT 'August', 8
        UNION SELECT 'September', 9
        UNION SELECT 'October', 10
        UNION SELECT 'November', 11
        UNION SELECT 'December', 12
    ) m
LEFT JOIN
    captura ON MONTHNAME(captura.fecha_cap) = m.month
           AND captura.estatus = 23
           AND captura.fecha_cap BETWEEN MAKEDATE(YEAR(CURDATE()), 1) AND CURDATE()
WHERE
    m.month_number <= MONTH(CURDATE())
GROUP BY
    m.month, m.month_number
ORDER BY
    m.month_number";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Error en la consulta: ' . mysqli_error($conn));
}
$totals7 = [];
$combo = [];
$totalRegistros = 0;
while ($row = mysqli_fetch_assoc($result)) {
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
    $totals7[] = $registros; // Agrega los registros al array
    $combo[] = $mes . " = " . $row["count_registros"];
    $totalRegistros += $registros;
}
$porcentajes = array_map(function ($registro) use ($totalRegistros) {
    return round(($registro / $totalRegistros) * 100, 2) . '%';
}, $totals7);
$etiquetas7 = array_map(function ($comboItem, $porcentaje) {
    return $comboItem . ' (' . $porcentaje . ')';
}, $combo, $porcentajes);
mysqli_free_result($result);
mysqli_close($conn);
?>
<script>
    var ctx = document.getElementById("user-chart7");
    var etiquetas7 = <?php echo json_encode($etiquetas7); ?>; // Utiliza las etiquetas generadas
    var myChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: etiquetas7,
            datasets: [{
                label: "Juicio/Procedimiento",
                data: <?php echo json_encode($totals7); ?>,
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
                    var registros = etiquetas7[index];
                    //window.location.href = 'informes_graficas.php?valor=' + registros + '=' + 7;
                }
            }
        }
    });
</script>