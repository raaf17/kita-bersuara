<?php
include 'conn.php';
session_start();
if ($_SESSION['status_login'] != true) {
  echo '<script>window.location="loginadmin.php"</script>';
}
?>

<?php
if (isset($_GET['hapus'])) {
  $id_laporan = $_GET['hapus'];
  $query = "DELETE FROM laporan WHERE id_laporan = '$id_laporan'";
  $q1 = mysqli_query($conn, $query);
  header("refresh:0.5;url=tabel_laporan.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Siswa | KitaBersuara</title>
  <link rel="stylesheet" href="../style/tabel_laporan.css?version=<?php echo filemtime('../style/tabel_laporan.css'); ?>">
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <link rel="stylesheet" href="../assets/library/fontawesome/css/all.min.css">
  <link href="../assets/library/DataTables/datatables.min.css" rel="stylesheet">
  <script src="../assets/library/DataTables/datatables.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#tabel1').DataTable();
    });
  </script>

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
      <h1>TABEL LAPORAN</h1>
      <div class="container-button">
        <div class="group-button-2">
          <button class="show-modal-2"><a href="dashboard.php" style="text-decoration: none; color: white;"><i class="fa-solid fa-arrow-left"></i> Kembali</a></button>
        </div>
      </div>


      <div class="table-container">
        <table class="data-table" id="tabel1">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Keluhan</th>
              <th>Kategori</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="table-body">
            <?php
            $no = 1;
            $query = "SELECT * FROM laporan AS lp LEFT JOIN siswa AS siswa ON lp.nisn = siswa.nisn LEFT JOIN kategori AS kat ON lp.id_kategori = kat.id_kategori LEFT JOIN status_laporan AS sl ON lp.id_status = sl.id_status";
            $tampil = mysqli_query($conn, $query);

            while ($data = mysqli_fetch_array($tampil)) :
            ?>
              <tr>
                <td><?= $no++; ?>.</td>
                <td><?= $data['nama']; ?></td>
                <td><?= $data['keluhan']; ?></td>
                <td><?= $data['nama_kategori']; ?></td>
                <td>
                  <a href="tabel_laporan.php?hapus=<?= $data['id_laporan']; ?>" onclick="return confirm('Yakin mau hapus?');"><button class="hapus" style="background-color: red;"><i class="fa-solid fa-trash"></i> Hapus</button></a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <?php include '../process/import.php' ?>

  <footer>
    <p class="container">Copyright &copy; 2023 by Kita Bersuara</p>
  </footer>

  <script type="text/javascript">
    const main = document.querySelector("main"),
      showBtn = document.querySelector(".show-modal"),
      closeBtn = document.querySelector(".close-btn");

    showBtn.addEventListener("click", () =>
      main.classList.add("active")
    );
    closeBtn.addEventListener("click", () =>
      main.classList.remove("active")
    );
  </script>

</body>

</html>