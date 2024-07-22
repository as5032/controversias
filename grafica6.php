                                            <?php
                                            // Configuración de la conexión a MySQL
                                            require_once('conexion_db.php');

                                            // Consulta SQL para obtener los datos de la tabla
                                            $sql = "SELECT
                                                    cat_juicio.t_juicio AS tjuicio,
                                                    COUNT(captura.juicio_proced) AS count_registros
                                                    FROM 
                                                        captura
                                                    LEFT JOIN cat_juicio ON captura.juicio_proced = cat_juicio.id
                                                    WHERE captura.estatus<>16
                                                    GROUP BY tjuicio;";

                                            $result = mysqli_query($conn, $sql);

                                            if (!$result) {
                                                die('Error en la consulta: ' . mysqli_error($conn));
                                            }


                                            $colores = [ //COLORES PARA LAS GRAFICAS SUBSECUENTES
                                                'rgba(159, 34, 65, 1)', //GUINDA
                                                'rgba(35, 91, 78, 1 )',
                                                'rgba(221, 201, 163, 1)',
                                                'rgba(152, 152, 154, 1)',
                                                'rgba(105, 28, 50,1)',
                                                'rgba(16, 49, 43, 1)',
                                                'rgba(188, 149, 92,1)',
                                                'rgba(111, 114, 113, 1)'
                                            ];
                                            // Arrays para almacenar los datos de la consulta
                                            $index = 0;
                                            //$asunto = [];
                                            $totals6 = [];
                                            $combo = [];
                                            // Recorrer los resultados y almacenar los datos en los arrays
                                            $index = 0;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $registros = $row["count_registros"];
                                                //$asunto[] = $row["tjuicio"];
                                                $totals6[] = $registros; // Agrega los días restantes al array totals
                                                $combo[] = $row["count_registros"] . " = " . $row["tjuicio"];
                                                $index++;
                                            }

                                            mysqli_free_result($result);

                                            mysqli_close($conn);

                                            ?>
                                            <script>
                                                var ctx = document.getElementById("user-chart6");

                                                // Crear un arreglo de etiquetas que combine el juicio_proced y el abogado
                                                var etiquetas6 = <?php
                                                                    $etiquetas6 = [];
                                                                    foreach ($combo as $index => $combo) {
                                                                        $etiquetas6[] = $combo;
                                                                    }
                                                                    echo json_encode($etiquetas6);
                                                                    ?>;
                                                var myChart = new Chart(ctx, {
                                                    type: "polarArea",
                                                    data: {
                                                        labels: etiquetas6,
                                                        datasets: [{
                                                            label: "Juicio/Procedimiento", //etiqueta en la presentacion de abogados
                                                            data: <?php echo json_encode($totals6); ?>,
                                                            backgroundColor: <?php echo json_encode($colores); ?>,
                                                            borderColor: "grey",
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
                                                                var registros = etiquetas6[index];
                                                                window.location.href = 'consulta_procedimientos.php?valor=' + registros + '=' + 6;
                                                            }
                                                        }
                                                    }
                                                });
                                            </script>