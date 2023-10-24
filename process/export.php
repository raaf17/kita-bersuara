<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['export-file'])) {
  require "../assets/library/vendor/autoload.php";
  $spreadsheet = new Spreadsheet();
  $worksheet = $spreadsheet->getActiveSheet();

  $query = "SELECT * FROM laporan AS lp LEFT JOIN siswa AS siswa ON lp.nisn = siswa.nisn LEFT JOIN kategori AS kat ON lp.id_kategori = kat.id_kategori LEFT JOIN status_laporan AS sl ON lp.id_status = sl.id_status";
  $result = $conn->query($query);

  $worksheet->setCellValue('A1', 'No');
  $worksheet->setCellValue('B1', 'Keluhan');
  $worksheet->setCellValue('C1', 'Kategori');
  $worksheet->setCellValue('D1', 'NISN');
  $worksheet->setCellValue('E1', 'Nama');
  $worksheet->setCellValue('F1', 'Tanggal');

  $column = 2;
  foreach ($result as $laporan) {
    $worksheet->setCellValue('A' . $column, ($column - 1));
    $worksheet->setCellValue('B' . $column, $laporan['keluhan']);
    $worksheet->setCellValue('C' . $column, $laporan['nama_kategori']);
    $worksheet->setCellValue('D' . $column, $laporan['nisn']);
    $worksheet->setCellValue('E' . $column, $laporan['nama']);
    $created_at = $laporan['created_at'];
    $worksheet->setCellValue('F' . $column, date('Y-m-d H:i:s', strtotime($created_at)));

    $column++;
  }

  $worksheet->getStyle('A1:F1')->getFont()->setBold(true);
  $worksheet->getStyle('A1:F1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFFFF00');
  $styleArray = [
    'borders' => [
      'allBorders' => [
        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        'color' => ['argb' => 'FF000000'],
      ]
    ],
  ];
  $worksheet->getStyle('A1:F' . ($column - 1))->applyFromArray($styleArray);

  $worksheet->getColumnDimension('A')->setAutoSize(true);
  $worksheet->getColumnDimension('B')->setAutoSize(true);
  $worksheet->getColumnDimension('C')->setAutoSize(true);
  $worksheet->getColumnDimension('D')->setAutoSize(true);
  $worksheet->getColumnDimension('E')->setAutoSize(true);
  $worksheet->getColumnDimension('F')->setAutoSize(true);

  $writer = new Xlsx($spreadsheet);
  ob_clean();
  $filename = 'laporan-excel.xlsx';
  header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
  header("Content-Disposition: attachment; filename=laporan-excel".date('Y-m-d h:i:s').".xlsx");
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
  $writer->save('php://output');
  exit;
}
?>