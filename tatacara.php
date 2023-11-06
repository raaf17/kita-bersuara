<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tata Cara | KitaBersuara</title>
  <link rel="stylesheet" href="style/tatacara.css?version=<?php echo filemtime('style/tatacara.css'); ?>">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>
  <!-- Header -->
  <nav style="background-color: #5E7C60;">
    <div class="container">
      <div class="nav_brand">
        <a href="index.php" style="text-decoration: none; margin-top: 5px;">
          <img src="assets/img/pre-logo.png" alt="Logo Kita Bersuara" />
        </a>
        <a href="index.php" style="text-decoration: none;">
          <h4>
            Kita<br />Bersuara
          </h4>
        </a>
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
  <!-- End of Header -->

  <!-- Main Content -->
  <main class="container">
    <h2 data-aos="fade-up" data-aos-duration="1500">TATA CARA PENGADUAN</h2>
    <section data-aos="fade-up" data-aos-duration="1500">
      <div class="description" style="background-color: #F2EDD7;">
        <div class="bottom_description"></div>
        <p class="bold" style="color: #5E7C60;">Anda harus Siswa SMKN 1 BOYOLANGU</p>
      </div>
    </section>
    <section data-aos="fade-up" data-aos-duration="1500">
      <div class="description" style="background-color: #F2EDD7;">
        <div class="bottom_description"></div>
        <p class="bold" style="color: #5E7C60;">Login Akun</p>
        <div class="desc">
          <p style="color: #5E7C60;">Login Akun Siswa:</p>
          <ul>
            <li style="color: #5E7C60;">NISN: NISN Siswa</li>
            <li style="color: #5E7C60;">Password: Password Akun Siswa</li>
          </ul>
          <p style="color: #5E7C60;">Login Akun Admin:</p>
          <ul>
            <li style="color: #5E7C60;">NISN: NISN Admin</li>
            <li style="color: #5E7C60;">Password: Password Akun Admin</li>
          </ul>
        </div>
      </div>
    </section>
    <section data-aos="fade-up" data-aos-duration="1500">
      <div class="description" style="background-color: #F2EDD7;">
        <div class="bottom_description"></div>
        <p class="bold" style="color: #5E7C60;">Siswa Melapor Dengan Memilih Kategori Pelaporan</p>
      </div>
    </section>
    <section data-aos="fade-up" data-aos-duration="1500">
      <div class="description" style="background-color: #F2EDD7;">
        <div class="bottom_description"></div>
        <p class="bold" style="color: #5E7C60;">Upload Foto Bukti Laporan yang Sesuai dengan yang Dilaporkan</p>
      </div>
    </section>
    <section data-aos="fade-up" data-aos-duration="1500">
      <div class="description" style="background-color: #F2EDD7;">
        <div class="bottom_description"></div>
        <p class="bold" style="color: #5E7C60;">
          Siswa Mengisi Laporan Pada Tempat yang Disediakan
        </p>
      </div>
    </section>
    <section data-aos="fade-up" data-aos-duration="1500">
      <div class="description" style="background-color: #F2EDD7;">
        <div class="bottom_description"></div>
        <p class="bold" style="color: #5E7C60;">Submit laporan</p>
      </div>
    </section>
    <section data-aos="fade-up" data-aos-duration="1500">
      <div class="description" style="background-color: #F2EDD7;">
        <div class="bottom_description"></div>
        <p class="bold" style="color: #5E7C60;">Jika Admin, Masuk ke halaman Admin</p>
      </div>
    </section>
    <section data-aos="fade-up" data-aos-duration="1500">
      <div class="description" style="background-color: #F2EDD7;">
        <div class="bottom_description"></div>
        <p class="bold" style="color: #5E7C60;">Admin mengevaluasi laporan</p>
      </div>
    </section>
  </main>
  <!-- End of Main Content -->

  <!-- Footer -->
  <footer>
    <p class="container">Copyup
      &copy; 2023 by Kita Bersuara</p>
  </footer>
  <!-- End of Footer -->

  <!-- External Javascript -->
  <script src="siswa/script.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>