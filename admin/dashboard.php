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
  <link rel="stylesheet"
    href="../style/dashboardadmin.css?version=<?php echo filemtime('../style/dashboardadmin.css'); ?>">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">

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
      <h1>LAPORAN SISWA</h1>

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
      <div>
        <button type="submit">Tambah Data</button>
      </div>

      <form action="hasilpencarian.php" method="get">
        <div class="search">
          <label for="search" class="bold">Search: </label>
          <input type="text" placeholder="cari laporan..." name="search" id="search" name="search">
        </div>
      </form>
      <form>
        <div class="category_search">
          <label for="category" class="bold">Select Category:</label>
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
  <?php
  require "../assets/library/vendor/autoload.php";

  if (isset($_POST['submit'])) {
    $err = "";
    $ekstensi = "";
    $success = "";

    $file_name = $_FILES['filexls']['name']; // Untuk mendapatkan nama file yang diupload
    $file_data = $_FILES['filexls']['tmp_name']; // Untuk mendapatkan temporary data
  
    if (empty($file_name)) {
      $err .= "<li>Silahkan masukkan file yang kamu inginkan</li>";
    } else {
      $ekstensi = pathinfo($file_name)['extension'];
    }

    $ekstensi_allowed = array("xls", "xlsx");
    if (!in_array($ekstensi, $ekstensi_allowed)) {
      $err .= "<li>Silahkan masukkan file tipe xls atau xlsx. File yang kamu masukkan <b>$file_name</b> punya tipe <b>$ekstensi</b></li>";
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

  <script>
    let feedback = document.getElementById("feedback");
    let button = document.getElementById("btn_feedback");
    const riwayat = document.querySelector(".riwayat_laporan");
    const search = document.querySelector("#search")
    const span = document.querySelectorAll(".category_search");

    search.addEventListener("keyup", (e) => {
      let xhr = new XMLHttpRequest()

      xhr.onreadystatechange = function () {
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

        xhr.onreadystatechange = function () {
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