                                                <?php
                                                // Configuración de la conexión a MySQL
                                                require_once('conexion_db.php');

                                                // Consulta SQL para obtener los juicios_proced
                                                $sql = "SELECT
                                                        cat_prioridad.nivel AS prioridad,
                                                        COUNT(captura.juicio_proced) AS count_registros
                                                        FROM 
                                                            captura
                                                        LEFT JOIN cat_prioridad ON captura.prioridad = cat_prioridad.id
                                                        WHERE estatus<> 16
                                                        GROUP BY prioridad";

                                                $result = mysqli_query($conn, $sql);

                                                if (!$result) {
                                                    die('Error en la consulta: ' . mysqli_error($conn));
                                                }

                                                // Arrays para almacenar los datos de la consulta
                                                $index = 0;
                                                $totals4 = [];
                                                $colors4 = [];
                                                $combo4 = [];
                                                // Colores personalizados según los rangos de prioridad
                                                 
                                                $colorVerdeFuerte = 'rgba(118, 193, 33, 1)'; // Baja
                                                //$colorAmarillo = 'rgba(255, 195, 0, 1)'; // Media
                                                $colorAmarillo = 'rgba(229, 226, 23, 1)';
                                                $colorRojoClaro = 'rgba(222, 40, 32,  1)'; // Alta
                                                $colorNaranja = 'rgba(255,161,25, 1)';


                                                $index = 0;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $registros = $row["count_registros"];
                                                    $prioridadActual = $row["prioridad"];

                                                    if ($prioridadActual == "ALTA") {
                                                        $colors4[] = $colorRojoClaro;
                                                    } elseif ($prioridadActual == "MEDIA") {
                                                        $colors4[] = $colorNaranja;
                                                    } elseif ($prioridadActual == "BAJA") {
                                                        $colors4[] = $colorAmarillo;
                                                    }
                                                    $totals4[] = $registros;
                                                    $combo4[] = $registros = $row["count_registros"] . " = " . $prioridadActual = $row["prioridad"];
                                                    $index++;
                                                }
                                                mysqli_free_result($result);
                                                ?>
                                                <!-- "Juicio/Procedimiento con prioridad" -->
                                                <script>
                                                    var ctx = document.getElementById("user-chart4");

                                                    // Crear un arreglo de etiquetas que combine el juicio_proced y el abogado
                                                    var etiquetas4 = <?php
                                                                        $etiquetas4 = [];
                                                                        foreach ($combo4 as $index => $combo4) {
                                                                            $etiquetas4[] = $combo4;
                                                                        }
                                                                        echo json_encode($etiquetas4);
                                                                        ?>;

                                                    var myChart = new Chart(ctx, {
                                                        type: "doughnut",
                                                        data: {
                                                            labels: etiquetas4,
                                                            datasets: [{
                                                                label: "Asuntos por Prioridad", //etiqueta en la presentacion de abogados
                                                                data: <?php echo json_encode($totals4); ?>,
                                                                backgroundColor: <?php echo json_encode($colors4); ?>,
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
                                                                    var registros = etiquetas4[index];
                                                                    window.location.href = 'consulta_procedimientos.php?valor=' + registros + '=' + 4;
                                                                }
                                                            }
                                                        }
                                                    });
                                                </script>