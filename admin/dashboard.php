<?php

include 'conn.php';
session_start();

if ($_SESSION['status_login'] != true) {
  echo '<script>window.location="loginadmin.php"</script>';
}

include '../process/export.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin | KitaBersuara</title>
  <link rel="stylesheet" href="../style/dashboardadmin.css?version=<?php echo filemtime('../style/dashboardadmin.css'); ?>">
  <link rel="stylesheet" href="../assets/library/fontawesome/css/all.min.css">
</head>

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
      <h1>LAPORAN SISWA</h1>
      <div class="buttonTambahDataSiswa">
        <div>
          <button><a href="datasiswa.php" style="text-decoration: none; color: white;"><i class="fa-solid fa-user"></i> Data Semua Siswa</a></button>
        </div>
        <div>
          <form action="" method="post">
            <button type="submit" name="export-file"><i class="fa-solid fa-file-export"></i> Export Laporan Dalam Bentuk Excel</a></button>
          </form>
        </div>
        <div>
          <button><a href="filter.php" style="text-decoration: none; color: white;"><i class="fa-solid fa-filter"></i> Filter Laporan</a></button>
        </div>
        <div>
          <button><a href="tabel_laporan.php" style="text-decoration: none; color: white;"><i class="fa-solid fa-table"></i> Lihat Laporan Dalam Bentuk Tabel</a></button>
        </div>
      </div>

      <form action="" method="get">
        <div class="search">
          <label for="search" class="bold">Search : </label>
          <input type="text" placeholder="cari laporan..." name="search" id="search" name="search">
        </div>
      </form>

      <form id="search">
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
        <?php include '../process/all.php' ?>
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

      xhr.open("GET", "../process/search.php?keyword=" + e.target.value, true)
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

        xhr.open("GET", "../process/category.php?keycat=" + e.target.className, true)
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