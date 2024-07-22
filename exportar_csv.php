<?php

require_once('config.php');
require_once('conexion_db.php');

$filename = "export_" . date("Y-m-d") . ".csv";

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $filename);

$output = fopen('php://output', 'w');

// Incluir el BOM UTF-8 al inicio del archivo
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

// Encabezados del CSV
fputcsv($output, array('ID', 'Fecha Captura', 'Fecha Ingreso', 'Fecha Vencimiento', 'Núm. Exp', 'Núm. Int', 'Juicio', 'Actor', 'Accionante', 'Estatus', 'Abogado', 'Ministro', 'Asunto', 'Seguimiento', 'Prioridad', 'Observaciones', 'Año'));

// Primera consulta
$query1 = "SELECT
            captura_historico.idcaptura,
            captura_historico.fecha_cap,
            captura_historico.fecha_ing,
            captura_historico.fecha_ven,
            captura_historico.num_exp,
            captura_historico.num_int,
            cat_juicio.t_juicio AS juicio,
            cat_actor.actord AS actor,
            captura_historico.accionante,
            cat_estatus.estatus AS estatus,
            cat_abogado.n_abogado AS abogado,
            cat_ministro.ministros AS ministro,
            captura_historico.asunto,
            cat_seguimiento.seguimiento AS seguimiento,
            cat_prioridad.nivel AS prioridad,
            captura_historico.observaciones,
            captura_historico.year
        FROM captura_historico
        LEFT JOIN cat_estatus ON captura_historico.estatus = cat_estatus.id
        LEFT JOIN cat_abogado ON captura_historico.abogado = cat_abogado.id
        LEFT JOIN cat_juicio ON captura_historico.juicio_proced = cat_juicio.id
        LEFT JOIN cat_actor ON captura_historico.actores = cat_actor.id
        LEFT JOIN cat_seguimiento ON captura_historico.seguimiento = cat_seguimiento.id
        LEFT JOIN cat_prioridad ON captura_historico.prioridad = cat_prioridad.id
        LEFT JOIN cat_ministro ON captura_historico.ministro = cat_ministro.id;";

// Ejecutar la primera consulta y escribir los resultados
$result1 = mysqli_query($conn, $query1);
if (!$result1) {
    exit("Error en la consulta 1: " . mysqli_error($conn));
}
while ($row = mysqli_fetch_assoc($result1)) {
    fputcsv($output, $row);
}

// Segunda consulta
$query2 = "SELECT
            captura.idcaptura,
            captura.fecha_cap,
            captura.fecha_ing,
            captura.fecha_ven,
            captura.num_exp,
            captura.num_int,
            cat_juicio.t_juicio AS juicio,
            cat_actor.actord AS actor,
            captura.accionante,
            cat_estatus.estatus AS estatus,
            cat_abogado.n_abogado AS abogado,
            cat_ministro.ministros AS ministro,
            captura.asunto,
            cat_seguimiento.seguimiento AS seguimiento,
            cat_prioridad.nivel AS prioridad,
            captura.observaciones
        FROM captura
        LEFT JOIN cat_estatus ON captura.estatus = cat_estatus.id
        LEFT JOIN cat_abogado ON captura.abogado = cat_abogado.id
        LEFT JOIN cat_juicio ON captura.juicio_proced = cat_juicio.id
        LEFT JOIN cat_actor ON captura.actores = cat_actor.id
        LEFT JOIN cat_seguimiento ON captura.seguimiento = cat_seguimiento.id
        LEFT JOIN cat_prioridad ON captura.prioridad = cat_prioridad.id
        LEFT JOIN cat_ministro ON captura.ministro = cat_ministro.id;";

// Ejecutar la segunda consulta y escribir los resultados
$result2 = mysqli_query($conn, $query2);
if (!$result2) {
    exit("Error en la consulta 2: " . mysqli_error($conn));
}
while ($row = mysqli_fetch_assoc($result2)) {
    fputcsv($output, $row);
}

fclose($output);
mysqli_close($conn);
exit();
?>
