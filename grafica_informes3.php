                                                <?php
                                                // Configuración de la conexión a MySQL
                                                require_once('conexion_db.php');

                                                // Consulta SQL para obtener los juicios_proced
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
            captura.estatus <> 16
        	AND captura.actores=2
            AND YEAR(fecha_ing) = YEAR(CURDATE())
            AND fecha_ing >= MAKEDATE(YEAR(CURDATE()), 1) AND fecha_ing < DATE_ADD(MAKEDATE(YEAR(CURDATE()), 1), INTERVAL 1 YEAR)
        GROUP BY 
            t_juicio, month, captura.juicio_proced
    ) captura ON cj.t_juicio = captura.t_juicio AND m.month = captura.month
GROUP BY
    tjuicio, m.month
ORDER BY
    FIELD(m.month, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), tjuicio;";

                                                $result = mysqli_query($conn, $sql);

                                                if (!$result) {
                                                    die('Error en la consulta: ' . mysqli_error($conn));
                                                }

                                                // Arrays para almacenar los datos de la consulta
                                                $index = 0;
                                                $totals3 = [];
                                                $combo3 = [];
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
                                                    $registros3 = $row["count_registros"];

                                                    $combo3[] = $row["count_registros"] . " = " . $mes;
                                                    $totals3[] = $registros3; // Agrega los días restantes al array totals
                                                    $index++;
                                                }

                                                mysqli_free_result($result);
                                                ?>
                                                <script>
                                                    var ctx = document.getElementById("user-chart3");

                                                    // Crear un arreglo de etiquetas que combine el juicio_proced y el abogado
                                                    var etiquetas3 = <?php
                                                                        $etiquetas3 = [];
                                                                        foreach ($combo3 as $index => $combo3) {
                                                                            $etiquetas3[] = $combo3;
                                                                        }
                                                                        echo json_encode($etiquetas3);
                                                                        ?>;

                                                    var myChart = new Chart(ctx, {
                                                        type: "bar",
                                                        data: {
                                                            labels: etiquetas3,
                                                            datasets: [{
                                                                label: "Cantidad",
                                                                data: <?php echo json_encode($totals3); ?>, //etiqueta en la presentacion de abogados
                                                                backgroundColor: <?php echo json_encode($colors); ?>,
                                                                borderWidth: 1,
                                                                hoverBorderWidth: 4,
                                                                tension: .5,
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
                                                                    var registros = etiquetas3[index];
                                                                    //window.location.href = 'informes_graficas.php?valor=' + registros + '=' + 3;
                                                                }
                                                            }
                                                        }
                                                    });
                                                </script>