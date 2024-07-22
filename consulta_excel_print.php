<?php
// Incluir tu archivo de conexión a la base de datos
require_once 'conexion_db.php';
if (isset($_POST['Find'])) {

    // Comenzar a construir la consulta SQL
    $sql = "SELECT 
	            num_exp,
                cat_juicio.t_juicio AS juicio,
                cat_actor.actord AS actor,
                accionante,
                cat_estatus.estatus AS estatus
            FROM captura
	        LEFT JOIN cat_juicio ON captura.juicio_proced = cat_juicio.id
	        LEFT JOIN cat_actor ON captura.actores = cat_actor.id
            LEFT JOIN cat_estatus ON captura.estatus = cat_estatus.id
                WHERE 1 = 1";

    $filtros_flag = false;


    if (!empty($_POST['Juicio'])) {
        $juicios_seleccionados = $_POST['Juicio'];
        $juicios_filtro = implode(",", $juicios_seleccionados);
        $sql .= " AND captura.juicio_proced IN ($juicios_filtro)";
        $filtros_flag = true;
    }

    if (!empty($_POST['Actor'])) {
        $actores_seleccionados = $_POST['Actor'];
        $actores_filtro = implode(",", $actores_seleccionados);
        $sql .= " AND captura.actores IN ($actores_filtro)";
        $filtros_flag = true;
    }


    // Agregar cláusula para el rango de fechas
    if (!empty($_POST['FechaIn']) && !empty($_POST['FechaVen'])) {
        $fecha_inicio = $_POST['FechaIn'];
        $fecha_final = $_POST['FechaVen'];
        $sql .= " AND captura.fecha_cap BETWEEN '$fecha_inicio' AND '$fecha_final'";
        $filtros_flag = true;
    }

    if ($filtros_flag) {

        // Realizar la consulta
        $resultado = $conn->query($sql);

        // Verificar si se encontraron resultados
        if ($resultado->num_rows > 0) {
            // Mostrar los resultados
            while ($fila = $resultado->fetch_assoc()) {
                // Procesar los datos obtenidos
                $exp = $fila['num_exp'];
                $juicio = $fila['juicio'];
                $actor = $fila['actor'];
                $accionante = $fila['accionante'];
                $estatus = $fila['estatus'];
                echo '<tr>
                   <td>' . $exp . '</td>
                   <td>' . $juicio . '</td>
                   <td class="denied">' . $actor . '</td>
                   <td class="process">' . $accionante . '</td>
                   <td class="process">' . $estatus . '</td>
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
                    num_exp,
                    cat_juicio.t_juicio AS juicio,
                    cat_actor.actord AS actor,
                    accionante,
                    cat_estatus.estatus AS estatus
                FROM captura
                LEFT JOIN cat_juicio ON captura.juicio_proced = cat_juicio.id
                LEFT JOIN cat_actor ON captura.actores = cat_actor.id
                LEFT JOIN cat_estatus ON captura.estatus = cat_estatus.id";

        $resultado = $conn->query($sql);

        // Verificar si se encontraron resultados
        if ($resultado->num_rows > 0) {
            // Mostrar los resultados
            while ($fila = $resultado->fetch_assoc()) {
                // Procesar los datos obtenidos
                $exp = $fila['num_exp'];
                $juicio = $fila['juicio'];
                $actor = $fila['actor'];
                $accionante = $fila['accionante'];
                $estatus = $fila['estatus'];
                echo '<tr>
                    <td>' . $exp . '</td>
                    <td>' . $juicio . '</td>
                    <td class="denied">' . $actor . '</td>
                    <td class="process">' . $accionante . '</td>
                    <td class="process">' . $estatus . '</td>
                    </tr>';
                $showPrintButton = true;
            }
        } else {
            // No se encontraron resultados
            echo "No se encontraron registros.";
        }
    }
}
