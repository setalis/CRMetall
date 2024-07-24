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
$sheet->setCellValue('C1', 'Цена');// This is where you set the column header
$sheet->setCellValue('D1', 'Засор');// This is where you set the column header
$sheet->setCellValue('E1', 'Вес');// This is where you set the column header
$row = 2;// Initialize row counter

foreach ($carts as $item) {
    $sheet->setCellValue('A' . $row, $item->id);
    $sheet->setCellValue('B' . $row, $item->name);
    $sheet->setCellValue('C' . $row, $item->price);
    $sheet->setCellValue('D' . $row, $item->dirt);
    $sheet->setCellValue('E' . $row, (-$item->weight_stock));
    $row++;
}

$sheet->setCellValue('A'.$row, 'cevvf');
$sheet->setCellValue('E'.$row, '=SUM(E2:E'.($row-1).')');

// // This is the loop to populate data
// for ($i=1; $i < 5; $i++) {
//     $sheet->setCellValue('A' . $row, $i);
//     $sheet->setCellValue('B' . $row, "People ".$i);
//     $row++;

// }
$writer = new Xlsx($spreadsheet);
$fileName = "Your First Excel Exported From Laravel.xlsx";
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment;filename=\"$fileName\"");
$writer->save("php://output");
exit();
?>
