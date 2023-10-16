<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register Siswa | KitaBersuara</title>
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
        <label class="burger_menu" for="burger" id="label">
          <input type="checkbox" name="burger" id="burger" />
        </label>
        <ul class="list_link" id="link">
          <li class="home"><a href="../index.php">Home</a></li>
          <li class="cara"><a href="../tatacara.php">Tata Cara</a></li>
        </ul>
      </div>
    </nav>

    <div class="container">
      <main>
        <h2>TAMBAH DATA SISWA</h2>
        <form action="" method="post">
          <label for="username">Nama Lengkap</label>
          <div class="input-form">
            <img src="../assets/img/icons8-name-24.png" alt="user-icon" width="24px" />
            <input type="text" name="nama" id="nama" />
          </div>
          <label for="username">Username</label>
          <div class="input-form">
            <img src="../assets/img/icons8-user-30.png" alt="user-icon" width="24px" />
            <input type="text" name="username" id="username" />
          </div>
          <label for="password">Password</label>
          <div class="input-form">
            <img src="../assets/img/icons8-lock-24.png" alt="lock-icon" width="24px" />
            <input type="password" name="password" id="password" />
          </div>
          <button type="submit" name="submit">Tambah Data</button>
          <button><a href="dashboard.php" style="text-decoration: none; color: white;">Kembali</a></button>
        </form>
      </main>
    </div>
    <?php 
    include '../admin/conn.php';
    if (isset($_POST['submit'])) {
      $name = $_POST['nama'];
      $username = $_POST['username'];
      $password = $_POST['password'];

      $query = "INSERT INTO siswa (nisn, password, nama, foto) VALUES('$username', '$password', '$name', NULL)";
      mysqli_query($conn, $query);
      echo "<script>location='dashboard.php';</script>";
    }
    ?>

<footer>
    <p class="container">Copyright &copy; 2023 by Kita Bersuara</p>
  </footer>
    <script src="script.js"></script>
  </body>
</html>
