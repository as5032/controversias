<?php
require_once('conexion_db.php');
$sql = "SELECT logins.usuario AS usuario, cat_abogado.id AS idabogado,  COUNT(captura.juicio_proced) AS count_registros
FROM captura
LEFT JOIN cat_abogado ON captura.abogado = cat_abogado.id
LEFT JOIN logins ON cat_abogado.n_abogado = logins.nombre_completo
WHERE cat_abogado.id>0
AND captura.estatus <> 16
GROUP BY idabogado";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Error en la consulta: ' . mysqli_error($conn));
}
$totals = [];
$coloresUnicos = [];
$colorVerde = 'rgba(181, 178, 68, 0.5)';
$colorRosa = 'rgba(216, 147, 235, 0.5)';
$colorNaranja = 'rgba(255, 161, 25, 0.5)';
$colorAzul = 'rgba(25, 133, 255, 0.5)';
$colorRojo = 'rgba(211, 13, 46, 0.5)';
$colorVerdeEncendido = 'rgba(52, 239, 30, 0.5)';
$colorAmarillo = 'rgba(222, 240, 40, 0.5)';
$colorAzulado = 'rgba(13, 19, 211, 0.5)';
$colorNegro = 'rgba(9, 4, 3, 0.5)';
$colorGris = 'rgba(207, 207, 207, 0.5)';
$colorCielo = 'rgba(104, 156, 214, 0.5)';

$index = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $Abogados = $row["usuario"];
    if ($Abogados == "esandoval") {
        $coloresUnicos[] = $colorVerde;
    } elseif ($Abogados == "dcruz") {
        $coloresUnicos[] = $colorRosa;
    } elseif ($Abogados == "esandoval") {
        $coloresUnicos[] = $colorNaranja;
    } elseif ($Abogados == "mocampo") {
        $coloresUnicos[] = $colorAzul;
    } elseif ($Abogados == "mgabina") {
        $coloresUnicos[] = $colorRojo;
    } elseif ($Abogados == "obautista") {
        $coloresUnicos[] = $colorVerdeEncendido;
    } elseif ($Abogados == "walburo") {
        $coloresUnicos[] = $colorAmarillo;
    } elseif ($Abogados == "aperez") {
        $coloresUnicos[] = $colorAzulado;
    } elseif ($Abogados == "anavarro") {
        $coloresUnicos[] = $colorGris;
    } elseif ($Abogados == "mfernanda") {
        $coloresUnicos[] = $colorCielo;
    } elseif ($Abogados == "ssocial") {
        $coloresUnicos[] = $colorNegro;
    } elseif ($Abogados == "") {
        $coloresUnicos[] = $colorNegro;
    }
    $registros = $row["count_registros"];
    $combo[] = $row["count_registros"] . " = " . $row["usuario"];
    $totals[] = $registros;
    $index++;
}
mysqli_free_result($result);
?>
<script>
    var ctx = document.getElementById("user-chart").getContext("2d");
    var etiquetas = <?php
                    $etiquetas = [];
                    foreach ($combo as $index => $combo) {
                        $etiquetas[] = $combo;
                    }
                    echo json_encode($etiquetas);
                    ?>;
    var data = {
        labels: <?php echo json_encode($etiquetas); ?>,
        datasets: [{
            data: <?php echo json_encode($totals); ?>,
            backgroundColor: <?php echo json_encode($coloresUnicos); ?>,
            borderWidth: 1
        }]
    };
    var myPieChart = new Chart(ctx, {
        type: 'pie',
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
                    left: 40,
                    right: 40,
                    top: 40,
                    bottom: 40
                }
            },
            onClick: function(event, elements) {
                if (elements.length > 0) {
                    var index = elements[0].index;
                    var value = data.datasets[0].data[index];
                    var registros = etiquetas[index];
                    window.location.href = 'consulta_procedimientos.php?valor=' + registros + '=' + 1;
                }
            }
        }
    });
</script>