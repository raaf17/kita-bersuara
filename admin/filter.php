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
  <link rel="stylesheet" href="../style/filter.css?version=<?php echo filemtime('../style/filter.css'); ?>">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
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
      <h1>FILTER LAPORAN</h1>

      <div class="filter-laporan">

        <form action="" method="post">
          <!-- input tanggal -->
          <div class="input-tanggal">
            <div class="tgl-mulai">
              <input type="date" name="tgl-mulai" placeholder="mulai">
            </div>
            <span>sd</span>
            <div class="tgl-selesai">
              <input type="date" name="tgl-selesai">
            </div>
          </div>

          <div class="pre-apply">
            <div class="apply">
              <button type="submit" name="filter-tgl"><i class="fa-solid fa-filter"></i>Apply</button>
            </div>
          </div>
          <div class="apply2">
            <button type="submit" name="filter-tgl"><i class="fa-solid fa-filter"></i>Apply</button>
          </div>
        </form>

        <div>
          <button class="show-modal-2"><a href="dashboard.php" style="text-decoration: none; color: white;">Kembali</a></button>
        </div>

      </div>


      <div class="riwayat_laporan">
        <?php include '../process/all_filter.php' ?>
      </div>

    </div>
  </main>

</body>

</html>