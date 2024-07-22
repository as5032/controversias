 <?php
    require_once('conexion_db.php');
    $sql = "SELECT
    cj.t_juicio AS tjuicio,
    m.month,
    IFNULL(COUNT(captura.juicio_proced), 0) AS count_registros
FROM
    (SELECT DISTINCT t_juicio FROM cat_juicio) cj
CROSS JOIN
    (SELECT DISTINCT MONTHNAME(fecha_ing) AS month FROM captura WHERE YEAR(fecha_ing) = YEAR(CURDATE())) m
LEFT JOIN
    (
        SELECT
            cat_juicio.t_juicio AS t_juicio,
            MONTHNAME(fecha_ing) AS month,
            captura.juicio_proced
        FROM 
            captura
        LEFT JOIN 
            cat_juicio ON captura.juicio_proced = cat_juicio.id
        WHERE 
            captura.estatus = 16
            AND YEAR(fecha_ing) = YEAR(CURDATE())
            AND fecha_ing >= MAKEDATE(YEAR(CURDATE()), 1) AND fecha_ing < DATE_ADD(MAKEDATE(YEAR(CURDATE()), 1), INTERVAL 1 YEAR)
        GROUP BY 
            t_juicio, month, captura.juicio_proced
    ) captura ON cj.t_juicio = captura.t_juicio AND m.month = captura.month
GROUP BY
    tjuicio, m.month
ORDER BY
    FIELD(m.month, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), tjuicio";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die('Error en la consulta: ' . mysqli_error($conn));
    }
    $totals2 = [];
    $combo2 = [];
    $index = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $registros = $row["count_registros"];
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
        //$asunto[] = $row["estatus"];
        $combo2[] = $registros . " = " . $mes; //valores para la grafica
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
     /*const getDataColors = opacity => {
         const colors = ['#7448c2', '#21c0d7', '#d99e2b', '#cd3a81', '#9c99cc', '#e14eca', '#ffffff', '#ff0000', '#d6ff00', '#0038ff']
         return colors.map(color => opacity ? `${color + opacity}` : color)
     }*/
     var myChart = new Chart(ctx, {
         type: "bar",
         data: {
             labels: etiquetas2,
             datasets: [{
                 label: "Cantidad", //Titulo de la gráfica
                 data: <?php echo json_encode($totals2); ?>,
                 //borderColor: getDataColors()[1],
                 backgroundColor: <?php echo json_encode($colors); ?>,
                 borderWidth: 1,
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
                     //window.location.href = 'informes_graficas.php?valor=' + registros + '=' + 2;
                 }
             }
         }
     });
 </script>