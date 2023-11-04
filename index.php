<?php

session_start();
include 'admin/conn.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home | KitaBersuara</title>
  <link rel="stylesheet" href="style/style.css" />
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>
  <!-- bagian 1 - navbar -->
  <nav>
    <div class="container">
      <div class="nav_brand">
        <img src="assets/img/pre-logo.png" alt="Logo Kita Bersuara" />
        <h4>
          Kita<br />Bersuara
        </h4>
      </div>
      <label class="burger_menu" for="burger" id="label">
        <input type="checkbox" name="burger" id="burger" />
      </label>
      <ul class="list_link" id="link">
        <li class="home"><a href="index.php">Home</a></li>
        <li class="cara"><a href="tatacara.php">Tata Cara</a></li>
        <li class="btn_login"><a href="siswa/loginsiswa.php">Login</a></li>
      </ul>
      <?php if (isset($_SESSION['nisn'])) { ?>
        <div class="btn">
          <a href="logout.php">Logout</a>
        </div>
      <?php } else { ?>
        <div class="btn">
          <a href="siswa/loginsiswa.php">Login</a>
        </div>
      <?php } ?>
    </div>
  </nav>
  <!-- akhir bagian 1 - navbar -->

  <!-- bagian 2 - hero konten -->
  <main>
    <div class="container">
      <!-- hero konten - Kiri -->
      <sect ion class="left" data-aos="fade-up" data-aos-duration="1500">
        <h1 style="color: #5E7C60;">Layanan Pengaduan Siswa Esemkita Online</h1>
        <p style="color: #5E7C60;">
          Suarakan keluhan anda disini, kami siap memprosesnya dengan cepat
        </p>
        <a href="siswa/pengaduan.php" style="background-color: #5E7C60; color: white">Laporkan!</a>
      </sect>
      <!-- akhir hero konten - kiri -->

      <!-- hero konten - Kanan -->
      <section class="right" data-aos="fade-up" data-aos-duration="1500">
        <img src="assets/img/speaker.png" style="margin-top: 68px;" alt="Speaker" />
      </section>
      <!-- akhir hero konten - Kanan -->
    </div>
  </main>
  <!-- akhir bagian 2 - hero konten -->

  <div class="our-process">
    <h2 data-aos="fade-up" data-aos-duration="1500">OUR PROCESS</h2>
    <div class="container card-our-process" data-aos="fade-up" data-aos-duration="1500">
      <div class="user">
        <h4 id="userCount"><?php
                            $query = "SELECT * FROM siswa";
                            $result = mysqli_query($conn, $query);
                            $totalCount1 = mysqli_num_rows($result);
                            echo $totalCount1;
                            ?></h4>
        <h3>User</h3>
      </div>
      <div class="keluhan">
        <h4 id="keluhanCount"><?php
                              $query = "SELECT * FROM laporan";
                              $result = mysqli_query($conn, $query);
                              $totalCount2 = mysqli_num_rows($result);
                              echo $totalCount2;
                              ?></h4>
        <h3 style="text-align: center;">Laporan</h3>
      </div>
      <div class="kategori">
        <h4 id="kategoriCount"><?php
                                $query = "SELECT * FROM kategori";
                                $result = mysqli_query($conn, $query);
                                $totalCount3 = mysqli_num_rows($result);
                                echo $totalCount3;
                                ?></h4>
        <h3>Kategori</h3>
      </div>
    </div>
  </div>
  <!-- bagian 3 - kategori laporan -->
  <div class="category_laporan">
    <h2 style="color: #5E7C60;" data-aos="fade-up" data-aos-duration="1500">HAL YANG BISA ANDA LAPORKAN</h2>
    <section class="category container" data-aos="fade-up" data-aos-duration="1500">
      <div class="sarpras" style="background-color: F2EDD7;">
        <img src="assets/img/sarpras.png" width="153" alt="" />
        <h3>SARPRAS</h3>
        <p>Perlatan Sekolah <br>Kualitas Gedung <br>Ruang Kelas</p>
      </div>
      <div class="kurikulum" style="background-color: F2EDD7;">
        <img src="assets/img/kurikulum.png" width="154" alt="" />
        <h3>KURIKULUM</h3>
        <p>Bimbingan Kegiatan <br>Koordinasi Acara <br>Pengawasan Kegiatan</p>
      </div>
      <div class="kesiswaan" style="background-color: F2EDD7;">
        <img src="assets/img/kesiswaan.png" width="154" alt="" />
        <h3>KESISWAAN</h3>
        <p>Penyusunan Jadwal <br>Laporan Kegiatan <br> Koordinasi Kegiatan </p>
      </div>
      <div class="humas" style="background-color: F2EDD7;">
        <img src="assets/img/humas.png" width="154" alt="" />
        <h3>HUMAS</h3>
        <p>Hubungan Antar Sekolah <br>Laporan Kemajuan Sekolah <br>Kerjasama Dengan Lembaga</p>
      </div>
    </section>
  </div>
  <!-- akhir bagian 3 - kategori laporan -->

  <!-- bagian 4 - pre-tim expert -->
  <div class="tim-expert-title" data-aos="fade-up" data-aos-duration="1500">
    <h1 class="tim-expert">Tim Expert</h1>
    <h3 class="orang-web-crafters">Orang-orang dari WebCrafters</h3>
  </div>
  <!-- akhir bagian 4 - pre-tim expert -->

  <!-- bagian 5 - Tim Expert -->
  <div class="container tim-expert" data-aos="fade-up" data-aos-duration="1500">
    <!-- rafi -->
    <div class="tim rafi">
      <img src="./assets/img/rafi.jpg" alt="" />
      <div class="pre-profil">
        <div class="profil">
          <h6 class="nama">Muhammad Rafi</h6>
          <h6 class="jobdesk">Project Manager</h6>
        </div>
      </div>
    </div>

    <!-- yuma -->
    <div class="tim yuma">
      <img src="./assets/img/yuma.jpg" alt="" />
      <div class="pre-profil">
        <div class="profil">
          <h6 class="nama">Yuma Aji P.</h6>
          <h6 class="jobdesk">Frontend Developer</h6>
        </div>
      </div>
    </div>

    <!-- dalta -->
    <div class="tim dalta">
      <img src="./assets/img/dalta.jpg" alt="" />
      <div class="pre-profil">
        <div class="profil">
          <h6 class="nama">Savero Dalta S.</h6>
          <h6 class="jobdesk">UI/UX Designer</h6>
        </div>
      </div>
    </div>

    <!-- reyhan -->
    <div class="tim reyhan">
      <img src="./assets/img/reyhan.png" alt="" />
      <div class="pre-profil">
        <div class="profil">
          <h6 class="nama">Reyhan Surya R.</h6>
          <h6 class="jobdesk">Backend Developer</h6>
        </div>
      </div>
    </div>
  </div>
  <!-- akhir bagian 5 - Tim Expert -->

  <!-- bagian 6 - Footer -->
  <footer>
    <p class="container">Copyright &copy; 2023 by Kita Bersuara</p>
  </footer>
  <!-- akhir bagian 6 - Footer -->

  <!-- responsive hamburger -->
  <script src="siswa/script.js"></script>
  <!-- akhir responsive hamburger -->

  <!-- scroll animation -->
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>

  <script>
    function animateCount(elementId, endValue) {
      const element = document.getElementById(elementId);
      const duration = 1500; // Durasi animasi dalam milidetik
      const frameDuration = 1000 / 60; // Durasi setiap frame animasi (60 FPS)
      const totalFrames = Math.round(duration / frameDuration);
      const step = (endValue - 0) / totalFrames;
      let currentFrame = 0;

      const animation = setInterval(() => {
        currentFrame++;
        element.innerText = Math.round(0 + step * currentFrame);
        if (currentFrame === totalFrames) {
          clearInterval(animation);
          element.innerText = endValue;
        }
      }, frameDuration);
    }

    // Fungsi untuk mengecek apakah elemen dalam tampilan atau tidak
    function handleIntersection(entries, observer) {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          // Saat elemen masuk dalam tampilan, panggil animateCount
          if (entry.target.id === "userCount") {
            animateCount("userCount", <?php echo $totalCount1; ?>);
          } else if (entry.target.id === "keluhanCount") {
            animateCount("keluhanCount", <?php echo $totalCount2; ?>);
          } else if (entry.target.id === "kategoriCount") {
            animateCount("kategoriCount", <?php echo $totalCount3; ?>);
          }
          observer.unobserve(entry.target);
        }
      });
    }

    const options = {
      threshold: 0.1 // Saat elemen terlihat sebagian, panggil handleIntersection
    };

    const observer = new IntersectionObserver(handleIntersection, options);

    // Amati masing-masing elemen h4
    observer.observe(document.getElementById("userCount"));
    observer.observe(document.getElementById("keluhanCount"));
    observer.observe(document.getElementById("kategoriCount"));
  </script>


  <!-- akhir scroll animation -->
</body>

</html>