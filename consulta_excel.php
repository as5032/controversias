<?php
                                                // Incluir tu archivo de conexión a la base de datos
                                                require_once 'conexion_db.php';
                                                if (isset($_POST['Find'])) {

                                                    // Comenzar a construir la consulta SQL
                                                    $sql = "SELECT 
                                                            cat_juicio.t_juicio AS juicio,
                                                            cat_actor.actord AS actor,
                                                            COUNT(*) AS total_expedientes
                                                            FROM captura
                                                            LEFT JOIN cat_juicio ON captura.juicio_proced = cat_juicio.id
                                                            LEFT JOIN cat_actor ON captura.actores = cat_actor.id
                                                                WHERE 1 = 1";

                                                    $filtros_flag = false;

                                                    /* // Agregar cláusulas WHERE según los filtros seleccionados
                                                    if (!empty($_POST['Abogado'])) {
                                                        $abogados_seleccionados = $_POST['Abogado'];
                                                        $abogados_filtro = implode(",", $abogados_seleccionados);
                                                        $sql .= " AND captura.abogado IN ($abogados_filtro)";
                                                    } */
                                                    /* 
                                                    if (!empty($_POST['Seguimiento'])) {
                                                        $seguimientos_seleccionados = $_POST['Seguimiento'];
                                                        $seguimientos_filtro = implode(",", $seguimientos_seleccionados);
                                                        $sql .= " AND captura.seguimiento IN ($seguimientos_filtro)";
                                                    }

                                                    if (!empty($_POST['Prioridad'])) {
                                                        $prioridades_seleccionados = $_POST['Prioridad'];
                                                        $prioridades_filtro = implode(",", $prioridades_seleccionados);
                                                        $sql .= " AND captura.prioridad IN ($prioridades_filtro)";
                                                    } */

                                                    if (!empty($_POST['Juicio'])) {
                                                        $juicios_seleccionados = $_POST['Juicio'];
                                                        $juicios_filtro = implode(",", $juicios_seleccionados);
                                                        $sql .= " AND captura.juicio_proced IN ($juicios_filtro)";
                                                        $filtros_flag = true;
                                                    }

                                                    /* if (!empty($_POST['Estatus'])) {
                                                        $estatus_seleccionados = $_POST['Estatus'];
                                                        $estatus_filtro = implode(",", $estatus_seleccionados);
                                                        $sql .= " AND captura.estatus IN ($estatus_filtro)";
                                                    } */

                                                    if (!empty($_POST['Actor'])) {
                                                        $actores_seleccionados = $_POST['Actor'];
                                                        $actores_filtro = implode(",", $actores_seleccionados);
                                                        $sql .= " AND captura.actores IN ($actores_filtro)";
                                                        $filtros_flag = true;
                                                    }

                                                    /*  if (!empty($_POST['Ministro'])) {
                                                         $ministros_seleccionados = $_POST['Ministro'];
                                                         $ministros_filtro = implode(",", $ministros_seleccionados);
                                                         $sql .= " AND captura.ministro IN ($ministros_filtro)";
                                                     } */

                                                    // Agregar cláusula para el rango de fechas
                                                    if (!empty($_POST['FechaIn']) && !empty($_POST['FechaVen'])) {
                                                        $fecha_inicio = $_POST['FechaIn'];
                                                        $fecha_final = $_POST['FechaVen'];
                                                        $sql .= " AND captura.fecha_cap BETWEEN '$fecha_inicio' AND '$fecha_final'";
                                                        $filtros_flag = true;
                                                    }

                                                    if ($filtros_flag) {
                                                        $sql .= "GROUP BY cat_juicio.t_juicio, cat_actor.actord
                                                            ORDER BY cat_juicio.t_juicio, cat_actor.actord";

                                                        // Realizar la consulta
                                                        $resultado = $conn->query($sql);

                                                        // Verificar si se encontraron resultados
                                                        if ($resultado->num_rows > 0) {
                                                            // Mostrar los resultados
                                                            while ($fila = $resultado->fetch_assoc()) {
                                                                // Procesar los datos obtenidos
                                                                $juicio = $fila['juicio'];
                                                                $actor = $fila['actor'];
                                                                $total_exp = $fila['total_expedientes'];
                                                                echo '<tr>
                                                                    <td>' . $juicio . '</td>
                                                                    <td class="denied">' . $actor . '</td>
                                                                    <td class="process">' . $total_exp . '</td>
                                                                </tr>';
                                                                $showPrintButton = true;
                                                            }
                                                        } else {
                                                            // No se encontraron resultados
                                                            echo "No se encontraron registros para los filtros seleccionados.";
                                                        }
                                                    } else {

                                                        // Si no se proporcionaron filtros, realizar una consulta sin restricciones
                                                        // Esto mostrará todos los registros existentes
                                                        $sql = "SELECT 
                                                                cat_juicio.t_juicio AS juicio,
                                                                cat_actor.actord AS actor,
                                                                COUNT(*) AS total_expedientes
                                                                FROM captura
                                                                LEFT JOIN cat_juicio ON captura.juicio_proced = cat_juicio.id
                                                                LEFT JOIN cat_actor ON captura.actores = cat_actor.id
                                                                GROUP BY cat_juicio.t_juicio, cat_actor.actord
                                                                ORDER BY cat_juicio.t_juicio, cat_actor.actord";

                                                        $resultado = $conn->query($sql);

                                                        // Verificar si se encontraron resultados
                                                        if ($resultado->num_rows > 0) {
                                                            // Mostrar los resultados
                                                            while ($fila = $resultado->fetch_assoc()) {
                                                                // Procesar los datos obtenidos
                                                                $juicio = $fila['juicio'];
                                                                $actor = $fila['actor'];
                                                                $total_exp = $fila['total_expedientes'];
                                                                echo '<tr>
                                                                <td>' . $juicio . '</td>
                                                                <td class="denied">' . $actor . '</td>
                                                                <td class="process">' . $total_exp . '</td>
                                                                </tr>';
                                                                $showPrintButton = true;
                                                            }
                                                        } else {
                                                            // No se encontraron resultados
                                                            echo "No se encontraron registros.";
                                                        }
                                                    }
                                                }
                                                ?>