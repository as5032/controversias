<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Conexión a la base de datos
$mysqli = new mysqli("tu_host", "tu_usuario", "tu_contraseña", "tu_base_de_datos");

if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

// Consulta 1
$query1 = "SELECT
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
        FROM
            captura
        LEFT JOIN cat_estatus ON captura.estatus = cat_estatus.id
        LEFT JOIN cat_abogado ON captura.abogado = cat_abogado.id
        LEFT JOIN cat_juicio ON captura.juicio_proced = cat_juicio.id
        LEFT JOIN cat_actor ON captura.actores = cat_actor.id
        LEFT JOIN cat_seguimiento ON captura.seguimiento = cat_seguimiento.id
        LEFT JOIN cat_prioridad ON captura.prioridad = cat_prioridad.id
        LEFT JOIN cat_ministro ON captura.ministro = cat_ministro.id
        WHERE cat_estatus.estatus = 'CONCLUIDO';";

// Consulta 2
$query2 = "SELECT
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
        FROM
            captura_historico
        LEFT JOIN cat_estatus ON captura_historico.estatus = cat_estatus.id
        LEFT JOIN cat_abogado ON captura_historico.abogado = cat_abogado.id
        LEFT JOIN cat_juicio ON captura_historico.juicio_proced = cat_juicio.id
        LEFT JOIN cat_actor ON captura_historico.actores = cat_actor.id
        LEFT JOIN cat_seguimiento ON captura_historico.seguimiento = cat_seguimiento.id
        LEFT JOIN cat_prioridad ON captura_historico.prioridad = cat_prioridad.id
        LEFT JOIN cat_ministro ON captura_historico.ministro = cat_ministro.id;";

// Ejecutando las consultas y combinando los resultados
$results = [];
foreach ([$query1, $query2] as $query) {
    if ($result = $mysqli->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        $result->free();
    }
}

// Creando el documento Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Añadiendo las cabeceras (asegúrate de incluir todas las que necesitas, incluyendo 'Year' si es específico de la segunda consulta)
$headers = ['ID', 'Fecha Captura', 'Fecha Ingreso', 'Fecha Vencimiento', 'Número Expediente', 'Número Interno', 'Juicio', 'Actor', 'Accionante', 'Estatus', 'Abogado', 'Ministro', 'Asunto', 'Seguimiento', 'Prioridad', 'Observaciones', 'Year']; // Asegúrate de ajustar según tus necesidades
$column = 1;
foreach ($headers as $header) {
    $sheet->setCellValueByColumnAndRow($column, 1, $header);
    $column++;
}

// Añadiendo los datos combinados de las consultas
$row = 2;
foreach ($results as $data) {
    $column = 1;
    foreach ($data as $value) {
        $sheet->setCellValueByColumnAndRow($column, $row, $value);
        $column++;
    }
    $row++;
}

// Guardando el archivo
$writer = new Xlsx($spreadsheet);
$filename = 'exportacion_combinada.xlsx';
$writer->save($filename);

// Cerrar la conexión de la base de datos
$mysqli->close();

echo "Exportación combinada completada con éxito.";

?>
