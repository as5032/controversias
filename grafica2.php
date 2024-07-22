 <?php
    require_once('conexion_db.php');
    $sql = "SELECT
    cat_estatus.estatus AS estatus, id,
    COUNT(captura.juicio_proced) AS count_registros
    FROM 
    captura
    LEFT JOIN cat_estatus ON captura.estatus = cat_estatus.id
    WHERE captura.estatus<>16
    GROUP BY estatus 
    ORDER BY count_registros DESC";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die('Error en la consulta: ' . mysqli_error($conn));
    }
    $totals2 = [];
    $combo2 = [];
                                    $colores = [ //COLORES PARA LAS GRAFICAS SUBSECUENTES
                                        'rgba(159, 34, 65, 1)', //GUINDA
                                        'rgba(35, 91, 78, 1 )'
                                    ];
    $index = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $registros = $row["count_registros"];
        //$asunto[] = $row["estatus"];
        $combo2[] = $registros . " = " . $row["estatus"]; //valores para la grafica
        $totals2[] = $registros; // valores presentados en etiquetas
        $index++;
    }
    mysqli_free_result($result);
    ?>
 <script>
     var ctx = document.getElementById("user-chart2");
     var etiquetas2 = <?php
                        $etiquetas2 = [];
                        foreach ($combo2 as $index => $combo2) {
                            //$etiquetas2[] = ucwords(strtolower($combo2)); // aqui se convierten tambien los caracteres a Titulo
                            $etiquetas2[] = $combo2;
                        }
                        echo json_encode($etiquetas2);
                        ?>;

     var myChart = new Chart(ctx, {
         type: "line",
         data: {
             labels: etiquetas2,
             datasets: [{
                 label: "Asunto por estatus", //Titulo de la gráfica
                 data: <?php echo json_encode($totals2); ?>,
                 //borderColor: getDataColors()[1],
                 backgroundColor: <?php echo json_encode($colores); ?>,
                 borderWidth: 1,
                 hoverBorderWidth: 10,
                 tension: .5,
                 fill: true,
                 pointBorderWidth: 10
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
             onClick: function(event, elements) {
                 if (elements.length > 0) {
                     var index = elements[0].index;
                     var value = data.datasets[0].data[index];
                     var registros = etiquetas2[index];
                     window.location.href = 'consulta_procedimientos.php?valor=' + registros + '=' + 2;
                 }
             }
         }
     });
 </script>