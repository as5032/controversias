<?php
require_once('conexion_db.php');
$sql = "SELECT *, MONTHNAME(fecha) AS month FROM `actividades` WHERE 1;";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Error en la consulta: ' . mysqli_error($conn));
}
$totals8 = [];
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
    'rgba(156, 153, 13, 1)', //amarillo
    'rgba(33, 97, 140, 1)', //azul
    'rgba(255,161,25, 1)', //naranja
    'rgba(247, 249, 249, 1)' //blanco
];
$index = 0;
$totalRegistros = 0;
$combo8 = [];
while ($row = mysqli_fetch_assoc($result)) {
    $registros = $row["cantidad"];
    $totals8[] = $registros;
    $combo8[] = $row["cantidad"] . " = " . $row["concepto"];
    $totalRegistros += $registros;
    $index++;
}
$porcentajes = array_map(function ($registro) use ($totalRegistros) {
    return round(($registro / $totalRegistros) * 100, 2) . '%';
}, $totals8);
$etiquetas8 = array_map(function ($comboItem, $porcentaje) {
    return $comboItem . ' (' . $porcentaje . ')';
}, $combo8, $porcentajes);
mysqli_free_result($result);
?>
<script>
    var ctx = document.getElementById("user-chart8").getContext("2d");
    var etiquetas8 = <?php echo json_encode($etiquetas8); ?>;
    var data = {
        labels: etiquetas8,
        datasets: [{
            data: <?php echo json_encode($totals8); ?>,
            backgroundColor: <?php echo json_encode($color2); ?>,
            borderWidth: 1
        }]
    };
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: {
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
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                }
            },
            onClick: function(event, elements) {
                if (elements.length > 0) {
                    var index = elements[0].index;
                    var value = data.datasets[0].data[index];
                    var registros = etiquetas8[index];
                    //window.location.href = 'consulta_procedimientos.php?valor=' + registros + '=' + 8;
                }
            }
        }
    });
</script>