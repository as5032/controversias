<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;

// Obtener los datos a exportar
if (isset($_POST['dataToExport'])) {
	$dataToExport = $_POST['dataToExport'];

	// Crear una instancia de PhpSpreadsheet
	$spreadsheet = new Spreadsheet();
	$sheet = $spreadsheet->getActiveSheet();

	// Agregar las cabeceras
	$headers = ['# de Expediente','Acción/Controversia','Actor/Demandado', 'Accionante', 'Estatus'];
	$sheet->fromArray([$headers], null, 'A1');

	// Dar formato a las celdas de encabezado
	$styleArray = [
		'fill' => [
			'fillType' => Fill::FILL_SOLID,
			'startColor' => ['rgb' => '4DA3FF'],
		],
		'font' => [
			'bold' => true,
			'color' => ['rgb' => 'FFFFFF'],
		],
	];

	$sheet->getStyle('A1:E1')->applyFromArray($styleArray);

	// Analizar los datos y agregarlos a la hoja de cálculo
	$rowData = explode("\n", $dataToExport);

	// Acumular todas las filas en una matriz
	$allRows = [];
	foreach ($rowData as $row) {
		$cellData = explode("\t", $row);
		$allRows[] = $cellData;
	}

	// Usar fromArray para agregar todas las filas a la hoja de cálculo
	$sheet->fromArray($allRows, null, 'A2');

	// Ajustar automáticamente el ancho de las columnas
	foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
		$sheet->getColumnDimension($col)->setAutoSize(true);
	}

	// Obtener la fecha actual para incluir en el nombre del archivo
	$fechaExportacion = date('Y-m-d');

	// Configurar el encabezado del archivo Excel
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename=informe_juicios_' . $fechaExportacion . '.xlsx');
	header('Cache-Control: max-age=0');

	// Crear el objeto de escritura y generar el archivo XLSX
	$writer = new Xlsx($spreadsheet);
	$writer->save('php://output');

	// Finaliza la ejecución del script
	exit();
} else {
	echo "No se recibieron datos para exportar.";
}
?>
