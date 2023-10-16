<?php
include 'conn.php';
session_start();
if ($_SESSION['status_login'] != true) {
  echo '<script>window.location="loginadmin.php"</script>';
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
  <link rel="stylesheet" href="../style/dashboardadmin.css?version=<?php echo filemtime('../style/datasiswa.css'); ?>">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="script.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#tabel1').DataTable();
    });
  </script>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    .table-container {
      padding: 20px;
      max-width: 100%;
      margin: 0 auto;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      overflow-x: auto;
    }

    .data-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    .data-table th,
    .data-table td {
      padding: 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    .data-table th {
      background-color: #f8f9fa;
      font-weight: bold;
      color: #333;
    }

    .data-table tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .data-table tbody tr:hover {
      background-color: #f0f0f0;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
      .table-container {
        max-width: 100%;
      }
    }
  </style>

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
          <p><span>Selamat Datang, </span>
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
      <h1>DATA SISWA</h1>

      <div class="buttonTambahDataSiswa">
        <div>
          <button class="show-modal">Import Data Siswa</button>
          <span class="overlay"></span>
          <div class="modal-box">
            <h2>Tambah Data Siswa</h2>
            <form action="" method="post" enctype="multipart/form-data">
              <div class="file-wrapper">
                <input type="file" name="filexls" id="formFile" required />
                <span>Pilih File Excel</span>
              </div>
              <div class="buttons">
                <button type="submit" name="submit" class="submit-btn">Tambah</button>
                <button class="close-btn">Close</button>
              </div>
            </form>
          </div>
        </div>
        <div>
          <button><a href="tambahdata.php" style="text-decoration: none; color: white;">Tambah Data Siswa</a></button>
        </div>
        <div>
          <button><a href="dashboard.php" style="text-decoration: none; color: white;">Kembali</a></button>
        </div>
      </div>

      <div class="table-container">
        <table class="data-table" id="tabel1">
          <thead>
            <tr>
              <th>No</th>
              <th>NISN</th>
              <th>Nama</th>
            </tr>
          </thead>
          <tbody id="table-body">
            <?php
            $no = 1;
            $query = "SELECT * FROM siswa";
            $tampil = mysqli_query($conn, $query);

            while ($data = mysqli_fetch_array($tampil)) :
            ?>
              <tr>
                <td><?= $no++; ?>.</td>
                <td><?= $data['nisn']; ?></td>
                <td><?= $data['nama']; ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

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

        $query_check = "SELECT COUNT(*) FROM siswa WHERE nisn = '$nisn'";
        $result_check = mysqli_query($conn, $query_check);
        $row = mysqli_fetch_row($result_check);

        if ($row[0] == 0) {
          $sql1 = "INSERT INTO siswa (nisn, password, nama) VALUES ('$nisn', '$password', '$nama')";
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
      <div>
        <?php
        echo "<script>alert('$err')</script>";
        ?>
      </div>
    <?php
    }

    if ($success) {
    ?>
      <div>
        <?php
        echo "<script>alert('$success')</script>";
        ?>
      </div>
  <?php
    }
  }
  ?>

  <footer>
    <p class="container">Copyright &copy; 2023 by Kita Bersuara</p>
  </footer>

  <script type="text/javascript">
    const main = document.querySelector("main"),
      overlay = document.querySelector(".overlay"),
      showBtn = document.querySelector(".show-modal"),
      closeBtn = document.querySelector(".close-btn");

    showBtn.addEventListener("click", () =>
      main.classList.add("active")
    );
    overlay.addEventListener("click", () =>
      main.classList.remove("active")
    );
    closeBtn.addEventListener("click", () =>
      main.classList.remove("active")
    );
  </script>

</body>

</html>