                                                <?php
                                                // Configuración de la conexión a MySQL
                                                require_once('conexion_db.php');

                                                                                    // Consulta SQL para obtener los juicios_proced
                                                                                    $sql = "SELECT
                                                        cat_actor.actord AS actores,
                                                        COUNT(captura.juicio_proced) AS count_registros
                                                        FROM 
                                                            captura
                                                        LEFT JOIN cat_actor ON captura.actores = cat_actor.id
                                                        WHERE captura.estatus<>16
                                                        AND actores>0
                                                        GROUP BY actores";

                                                $result = mysqli_query($conn, $sql);

                                                if (!$result) {
                                                    die('Error en la consulta: ' . mysqli_error($conn));
                                                }

                                                // Arrays para almacenar los datos de la consulta
                                                $index = 0;
                                                $totals5 = [];
                                                $combo5 = [];
                                                $color2=[];
                                                $colorDorado = 'rgba( 185, 119, 14,   1)';
                                                $colorAma = 'rgba(237, 187, 153,   1)';
                                                $index = 0;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $Abogados = $row["actores"];
                                                    if ($Abogados == "ACTOR") {
                                                        $color2[] = $colorDorado;
                                                    } elseif ($Abogados == "DEMANDADO") {
                                                        $color2[] = $colorAma;
                                                    } 
                                                    $registros = $row["count_registros"];
                                                    $prioridadActual = $row["prioridad"];
                                                    $totals5[] = $registros;
                                                    $combo5[] = $registros = $row["count_registros"] . " = " . $prioridadActual = $row["actores"];
                                                    $index++;
                                                }
                                                mysqli_free_result($result);
                                                ?>
                                                <!-- "Juicio/Procedimiento con prioridad" -->
                                                <script>
                                                    var ctx = document.getElementById("user-chart5");

                                                    // Crear un arreglo de etiquetas que combine el juicio_proced y el abogado
                                                    var etiquetas5 = <?php
                                                                        $etiquetas5 = [];
                                                                        foreach ($combo5 as $index => $combo5) {
                                                                            $etiquetas5[] = $combo5;
                                                                        }
                                                                        echo json_encode($etiquetas5);
                                                                        ?>;

                                                    var myChart = new Chart(ctx, {
                                                        type: "polarArea",
                                                        data: {
                                                            labels: etiquetas5,
                                                            datasets: [{
                                                                label: "Asuntos por Prioridad", //etiqueta en la presentacion de abogados
                                                                data: <?php echo json_encode($totals5); ?>,
                                                                backgroundColor: <?php echo json_encode($color2); ?>,
                                                                borderColor: "gray",
                                                                borderWidth: 1,
                                                                hoverBorderWidth: 4,
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
                                                                    var registros = etiquetas5[index];
                                                                    window.location.href = 'consulta_procedimientos.php?valor=' + registros + '=' + 5;
                                                                }
                                                            }
                                                        }
                                                    });
                                                </script>