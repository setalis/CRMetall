<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setTitle('Sheet 1'); // This is where you set the title
$sheet->setCellValue('A1', 'ID'); // This is where you set the column header
$sheet->setCellValue('B1', 'Наименование');// This is where you set the column header
$sheet->setCellValue('C1', 'Покупка');// This is where you set the column header
$sheet->setCellValue('D1', 'Продажа');// This is where you set the column header
$sheet->setCellValue('E1', 'Итого');// This is where you set the column header
$row = 2;// Initialize row counter

foreach ($productsStatistic as $item) {
    $sheet->setCellValue('A' . $row, $item['id']);
    $sheet->setCellValue('B' . $row, $item['name']);
    $sheet->setCellValue('C' . $row, $item['weight_plus']);
    $sheet->setCellValue('D' . $row, $item['weight_minus']);
    $sheet->setCellValue('E' . $row, $item['weight_all']);
    $row++;
}

$sheet->setCellValue('C'.$row, 'Итого:');
$sheet->setCellValue('D'.$row, '=SUM(D2:D'.($row-1).')');

// // This is the loop to populate data
// for ($i=1; $i < 5; $i++) {
//     $sheet->setCellValue('A' . $row, $i);
//     $sheet->setCellValue('B' . $row, "People ".$i);
//     $row++;

// }
$writer = new Xlsx($spreadsheet);
$fileName = "export-operation.xlsx";
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment;filename=\"$fileName\"");
$writer->save("php://output");
exit();
?>
