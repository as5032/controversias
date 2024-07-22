<?php
require_once('conexion_db.php');
$sql = "SELECT logins.usuario AS usuario, cat_abogado.id AS idabogado,  COUNT(captura.juicio_proced) AS count_registros, cat_abogado.abogado_user
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
$colorVino = 'rgba(159, 34, 65, 1)';
$colorRosa = 'rgba(158,87,179, 1)';
$colorAzul = 'rgba(33, 97, 140, 1)';
$colorVerde = 'rgba(17, 120, 100, 1)';
$colorMorado = 'rgba(99, 57, 116, 1)';
$colorAmarillo = 'rgba( 185, 182, 9, 1)';
$colorGris = 'rgba (145, 172, 172 , 1)';
$colorDorado = 'rgba(156, 100, 12,  1)';
$colorOro = 'rgba(156, 153, 13, 1)';
$colorNaranja2 = 'rgba(220, 118, 51, 1 )';

$colorNaranja = 'rgba(255,161,25, 1)';
$colorBlanco = 'rgba(247, 249, 249, 1)';
$index = 0;
while ($row = mysqli_fetch_assoc($result)) { // PARA ESPECIFICAR UN COLOR EN ESTE CASO ALOS ABOGADOS
    $Abogados = $row["abogado_user"];
    if ($Abogados == "esandoval") {
        $coloresUnicos[] = $colorVino;
    } elseif ($Abogados == "dcruz") { //2
        $coloresUnicos[] = $colorRosa;
    } elseif ($Abogados == "obautista") { //azul  //5
        $coloresUnicos[] = $colorAzul;
    } elseif ($Abogados == "walburo") { //1
        $coloresUnicos[] = $colorVerde;
    } elseif ($Abogados == "anavarro") { //3
        $coloresUnicos[] = $colorMorado;
    } elseif ($Abogados == "mteresa") {
        $coloresUnicos[] = $colorAmarillo;
    } elseif ($Abogados == "pusuario") {
        $coloresUnicos[] = $colorGris;
    } elseif ($Abogados == "mvazquez") { // 4
        $coloresUnicos[] = $colorDorado;
    } elseif ($Abogados == "vsanchez") {
        $coloresUnicos[] = $colorOro;
    } elseif ($Abogados == "mocampo") {
        $coloresUnicos[] = $colorNaranja2;
    }

    $registros = $row["count_registros"];
    $combo[] = $row["count_registros"] . " = " . $row["abogado_user"];
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