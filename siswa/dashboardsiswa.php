<?php

session_start();
include '../admin/conn.php';

if ($_SESSION['nisn'] != true) {
  echo '<script>window.location="loginsiswa.php"</script>';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Siswa | KitaBersuara</title>
  <link rel="stylesheet" href="../style/profile.css?version=<?php echo filemtime('../style/profile.css'); ?>">
</head>

<!-- ini body -->
<body>
  <nav>
    <div class="container">
      <div class="nav_brand">
        <a href="../index.php" style="text-decoration: none; margin-top: 5px;">
          <img src="../assets/img/pre-logo.png" alt="Logo Kita Bersuara" />
        </a>
        <a href="../index.php" style="text-decoration: none;">
          <h4>
            Kita<br />Bersuara
          </h4>
        </a>
      </div>
      <p>Dashboard Siswa</p>
      <div class="profile_siswa">
        <div class="name">
          <p><?php echo $_SESSION['nisn']['nama'] ?></p>
          <img src="../assets/img/arrow-drop.png" alt="Arrow Drop" />
          <input type="checkbox" name="check" id="check">
          <ul>
            <li><a href="../index.php">Dashboard</a></li>
            <li><a href="dashboardsiswa.php">Profile Saya</a></li>
            <li><a href="editprofile.php">Edit Profile</a></li>
            <li><a href="../logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <main>
    <div class="container">
      <div class="profile">
        <div class="detail">
          <h1><?php echo $_SESSION['nisn']['nama']; ?></h1>
          <p>
            <span class="nisn"><?php echo $_SESSION['nisn']['nisn']; ?></span> |
            <span class="politeknik">SMKN 1 Boyolangu</span>
          </p>
          <a href="pengaduan.php" class="lapor">Lapor Sekarang</a>
          <a href="editprofile.php" class="edit">Edit Profile</a>
        </div>
      </div>
      <div class="riwayat_laporan">
        <h3>Riwayat Laporan</h3>
        <div class="laporan">
          <?php
          $akun = $_SESSION['nisn']['nisn'];
          $ambil = $conn->query("SELECT * FROM laporan AS lp LEFT JOIN siswa AS siswa ON lp.nisn = siswa.nisn LEFT JOIN kategori AS kat ON lp.id_kategori = kat.id_kategori LEFT JOIN status_laporan AS sl ON lp.id_status = sl.id_status WHERE lp.nisn='$akun' ORDER BY lp.id_laporan DESC");
          while ($laporanku = $ambil->fetch_assoc()) {;
          ?>
            <div>
              <div class="foto-laporan">
                <img class="img-side2" src="../assets/fotobukti/<?= $laporanku['foto']; ?>" alt="bukti_laporan" width="170" height="170" />
              </div>
              <img class="img-side1" src="../assets/fotobukti/<?= $laporanku['foto']; ?>" alt="bukti_laporan" width="170" height="170" />
              <div class="detail_laporan">
                <h4 class="pengusul">Pengusul: <span>Saya Sendiri</span></h4>
                <h4 class="category">#<span><?php echo $laporanku['nama_kategori']; ?></span></h4>
                <p>Usulan: <br />
                  <span>
                    <?php
                    $report = htmlspecialchars($laporanku['keluhan']);
                    echo $report
                    ?>.
                  </span>
                </p>
              </div>

              <!-- laporan di approve -->
              <?php if ($laporanku['status'] == 'approve') { ?>
                <div class="icon_status approved">
                  <img src="../assets/img/approved.png" alt="status-icon">
                  <p>APPROVE</p>
                </div>
            </div>
            <form action="">
              <textarea name="feedback" id="feedback" cols="10" rows="1" readonly><?php echo $laporanku['feedback']; ?></textarea>
            </form>

            <!-- laporan di unapprove -->
          <?php } else if ($laporanku['status'] == 'unapprove') { ?>
            <div class="icon_status unapproved">
              <img src="../assets/img/unapproved.png" alt="status-icon">
              <p>UNAPPROVE</p>
            </div>
        </div>
        <form action="">
          <textarea name="feedback" id="feedback" cols="10" rows="1" readonly><?php echo $laporanku['feedback']; ?></textarea>
        </form>

        <!-- laporan terkirim -->
      <?php } else if ($laporanku['status'] == 'terkirim') { ?>
        <div class="icon_status approved">
          <img src="../assets/img/approved.png" alt="status-icon">
          <p>TERKIRIM</p>
        </div>
      </div>
      <form action="">
        <textarea name="feedback" id="feedback" cols="10" rows="1" readonly><?php echo $laporanku['feedback']; ?></textarea>
      </form>

  <?php  }
            } ?>

  <?php
  $cek = $conn->query("SELECT nisn FROM laporan WHERE nisn='$akun'");
  if (mysqli_num_rows($cek) == 0) { ?>
    <h1 style="text-align: center; font-weight: bold; font-size: 16px;">Belum ada laporan</h1>
  <?php  } ?>
  </main>

  <footer>
    <p class="container">Copyright &copy; 2023 by Kita Bersuara</p>
  </footer>
</body>

</html>