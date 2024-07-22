                                                <?php
                                                require_once('conexion_db.php');
                                                $sql = "SELECT
                                                cat_seguimiento.seguimiento AS seguimiento,
                                                COUNT(captura.juicio_proced) AS count_registros
                                                FROM 
                                                    captura
                                                LEFT JOIN cat_seguimiento ON captura.seguimiento = cat_seguimiento.id
                                                WHERE captura.estatus <> 16
                                                GROUP BY cat_seguimiento.seguimiento;";
                                                $result = mysqli_query($conn, $sql);
                                                if (!$result) {
                                                    die('Error en la consulta: ' . mysqli_error($conn));
                                                }
                                                $index = 0;
                                                $totals3 = [];
                                                $combo3 = [];
                                            $colores = [ //COLORES PARA LAS GRAFICAS SUBSECUENTES
                                                'rgba(152, 152, 154, 1)', //GUINDA
                                                'rgba(247, 249, 249, 1)', //blanco
                                                'rgba(159, 34, 65, 1)', // rojo
                                                'rgba(41, 128, 185 , 1)', // azul marino
                                                'rgba(105, 28, 50,1)',
                                                'rgba(16, 49, 43, 1)',
                                                'rgba(188, 149, 92,1)',
                                                'rgba(111, 114, 113, 1)'
                                            ];
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $registros3 = $row["count_registros"];
                                                    $combo3[] = $row["count_registros"] . " = " . $row["seguimiento"];
                                                    $totals3[] = $registros3; // Agrega los días restantes al array totals
                                                    $index++;
                                                }
                                                mysqli_free_result($result);
                                                ?>
                                                <script>
                                                    var ctx = document.getElementById("user-chart3");
                                                    var etiquetas3 = <?php
                                                                        $etiquetas3 = [];
                                                                        foreach ($combo3 as $index => $combo3) {
                                                                            $etiquetas3[] = $combo3;
                                                                        }
                                                                        echo json_encode($etiquetas3);
                                                                        ?>;
                                                    var myChart = new Chart(ctx, {
                                                        type: "line",
                                                        data: {
                                                            labels: etiquetas3,
                                                            datasets: [{
                                                                label: "Asuntos por Seguimiento",
                                                                data: <?php echo json_encode($totals3); ?>, //etiqueta en la presentacion de abogados
                                                                backgroundColor: <?php echo json_encode($colores); ?>,
                                                                borderColor: <?php echo json_encode($colores); ?>,
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
                                                                    window.location.href = 'consulta_procedimientos.php?valor=' + registros + '=' + 3;
                                                                }
                                                            }
                                                        }
                                                    });
                                                </script>