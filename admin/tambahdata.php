<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Data | KitaBersuara</title>
    <link rel="stylesheet" href="../style/login.css?version=<?php echo filemtime('../style/login.css'); ?>">
  </head>
  <body>
    <nav>
      <div class="container">
        <div class="nav_brand">
          <img src="../assets/img/pre-logo.png" alt="Logo Kita Bersuara" />
          <h4>
            Kita<br />
            Bersuara
          </h4>
        </div>
      </div>
    </nav>

    <div class="container">
      <main>
        <h2>TAMBAH DATA SISWA</h2>
        <form action="" method="post">
          <label for="nama">Nama Lengkap</label>
          <div class="input-form">
            <img src="../assets/img/nama.png" alt="user-icon" width="24px" />
            <input type="text" name="nama" id="nama" />
          </div>
          <label for="kelas">Kelas</label>
          <div class="input-form">
            <img src="../assets/img/kelas.png" alt="user-icon" width="24px" />
            <input type="text" name="kelas" id="kelas" />
          </div>
          <label for="username">NISN</label>
          <div class="input-form">
            <img src="../assets/img/username.png" alt="user-icon" width="24px" />
            <input type="text" name="username" id="username" />
          </div>
          <label for="password">Password</label>
          <div class="input-form">
            <img src="../assets/img/password.png" alt="lock-icon" width="24px" />
            <input type="password" name="password" id="password" />
          </div>
          <button type="submit" name="submit">Tambah Data</button>
          <button><a href="datasiswa.php" style="text-decoration: none; color: white;">Kembali</a></button>
        </form>
      </main>
    </div>
    <?php 
    include '../admin/conn.php';
    if (isset($_POST['submit'])) {
      $name = $_POST['nama'];
      $kelas = $_POST['kelas'];
      $username = $_POST['username'];
      $password = $_POST['password'];

      $query = "INSERT INTO siswa (nisn, password, nama, kelas) VALUES('$username', '$password', '$name', '$kelas')";
      mysqli_query($conn, $query);
      echo "<script>location='datasiswa.php';</script>";
    }
    ?>

<footer>
    <p class="container">Copyright &copy; 2023 by Kita Bersuara</p>
  </footer>
    <script src="script.js"></script>
  </body>
</html>
