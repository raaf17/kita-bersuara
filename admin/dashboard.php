<?php
include 'conn.php';
session_start();
if ($_SESSION['status_login'] != true) {
  echo '<script>window.location="loginadmin.php"</script>';
}
?>

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
  $filename = 'laporan-excel.xlsx';
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="' . $filename . '"');
  header('Cache-Control: max-age=0');
  $writer->save('php://output');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="../style/dashboardadmin.css?version=<?php echo filemtime('../style/dashboardadmin.css'); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>

<body>
  <nav>
    <div class="container">
      <div class="nav_brand">
        <img src="../assets/img/pre-logo.png" alt="Logo Kita Bersuara" />
        <h4>Kita<br />Bersuara</h4>
      </div>
      <p>Dashboard Admin</p>
      <div class="profile_siswa">
        <div class="name">
          <p><span>Selamat Datang(Admin), </span>
            <?php echo $_SESSION['nisn']['nama']; ?>
          </p>
          <img src="../assets/img/arrow-drop.png" alt="Arrow Drop" />
          <input type="checkbox" name="check" id="check" />
          <ul>
            <li><a href="../index.php">Dashboard</a></li>
            <li><a href="../logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <main>
    <div class="container">
      <h1>LAPORAN SISWA</h1>

      <div class="buttonTambahDataSiswa">
        <div>
          <button></i><a href="datasiswa.php" style="text-decoration: none; color: white;"><i class="fa-solid fa-user"></i> Data Semua Siswa</a></button>
        </div>
        <div>
          <form action="" method="post">
            <button type="submit" name="export-file"><i class="fa-solid fa-file-export"></i> Export Laporan</a></button>
          </form>
        </div>
      </div>


      <form action="hasilpencarian.php" method="get">
        <div class="search">
          <label for="search" class="bold">Search : </label>
          <input type="text" placeholder="cari laporan..." name="search" id="search" name="search">
        </div>
      </form>
      <form>
        <div class="category_search">
          <label for="category" class="bold">Select Category :</label>
          <span>
            <input type="checkbox" name="all" id="all">
            <label for="all" class="all">ALL</label>
          </span>
          <span>
            <input type="checkbox" name="sarpras" id="sarpras">
            <label for="sarpras" class="sarpras">Sarpras</label>
          </span>
          <span>
            <input type="checkbox" name="kurikulum" id="kurikulum">
            <label for="kurikulum" class="kurikulum">Kurikulum</label>
          </span>
          <span>
            <input type="checkbox" name="kesiswaan" id="kesiswaan">
            <label for="kesiswaan" class="kesiswaan">Kesiswaan</label>
          </span>
          <span>
            <input type="checkbox" name="humas" id="humas">
            <label for="humas" class="humas">Humas</label>
          </span>
          <span>
            <input type="checkbox" name="setuju" id="setuju">
            <label for="setuju" class="setuju">Setuju</label>
          </span>
          <span>
            <input type="checkbox" name="tidakSetuju" id="tidakSetuju">
            <label for="tidakSetuju" class="tidakSetuju">Tidak Setuju</label>
          </span>

        </div>
      </form>

      <div class="riwayat_laporan">
        <?php include '../ajax/all.php' ?>
      </div>
  </main>

  <footer>
    <p class="container">Copyright &copy; 2023 by Kita Bersuara</p>
  </footer>

  <script>
    let feedback = document.getElementById("feedback");
    let button = document.getElementById("btn_feedback");
    const riwayat = document.querySelector(".riwayat_laporan");
    const search = document.querySelector("#search")
    const span = document.querySelectorAll(".category_search");

    search.addEventListener("keyup", (e) => {
      let xhr = new XMLHttpRequest()

      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          riwayat.innerHTML = `${xhr.responseText}`
        }
      }

      xhr.open("GET", "../ajax/search.php?keyword=" + e.target.value, true)
      xhr.send();
    })

    span.forEach((e) => {
      e.addEventListener("click", (e) => {
        e.preventDefault()
        console.log(e)
        let xhr = new XMLHttpRequest()

        xhr.onreadystatechange = function() {
          if (xhr.readyState == 4 && xhr.status == 200) {
            riwayat.innerHTML = `${xhr.responseText}`
          }
        }

        xhr.open("GET", "../ajax/category.php?keycat=" + e.target.className, true)
        xhr.send();
      })
    })

    feedback.addEventListener("keydown", (e) => {
      if (e.target.value.length > 0) {
        button.style.display = "block"
      } else {
        button.style.display = "none"
      }
    })
  </script>
</body>

</html>