<?php
require "../assets/library/vendor/autoload.php";

if (isset($_POST['submit'])) {
  $err = "";
  $ekstensi = "";
  $success = "";

  $file_name = $_FILES['filexls']['name']; // Untuk mendapatkan nama file yang diupload
  $file_data = $_FILES['filexls']['tmp_name']; // Untuk mendapatkan temporary data

  if (empty($file_name)) {
    $err .= "Silahkan masukkan file yang kamu inginkan";
  } else {
    $ekstensi = pathinfo($file_name)['extension'];
  }

  $ekstensi_allowed = array("xls", "xlsx");
  if (!in_array($ekstensi, $ekstensi_allowed)) {
    $err .= "Silahkan masukkan file tipe xls atau xlsx. File $file_name yang kamu masukkan punya tipe $ekstensi";
  }

  if (empty($err)) {
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_data);
    $spreadsheet = $reader->load($file_data);
    $sheetData = $spreadsheet->getActiveSheet()->toArray();

    $jumlahData = 0;
    for ($i = 1; $i < count($sheetData); $i++) {
      $nisn = $sheetData[$i]['0'];
      $password = $sheetData[$i]['1'];
      $nama = $sheetData[$i]['2'];
      $kelas = $sheetData[$i]['3'];

      $query_check = "SELECT COUNT(*) FROM siswa WHERE nisn = '$nisn'";
      $result_check = mysqli_query($conn, $query_check);
      $row = mysqli_fetch_row($result_check);

      if ($row[0] == 0) {
        $sql1 = "INSERT INTO siswa (nisn, password, nama, kelas) VALUES ('$nisn', '$password', '$nama', '$kelas')";
        mysqli_query($conn, $sql1);
        $jumlahData++;
      } else {
        continue;
      }
    }

    if ($jumlahData > 0) {
      $success = "Jumlah Data Berhasil Dimasukkan";
    }
  }

  if ($err) {
?>
      <?php echo "<script>alert('$err')</script>"; ?>
    <?php
  }

  if ($success) {
    ?>
      <?php echo "<script>alert('$success')</script>"; ?>
  <?php
  }
}

?>