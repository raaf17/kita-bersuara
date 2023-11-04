<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Siswa | KitaBersuara</title>
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
      <h2>LOGIN SISWA</h2>
      <p>Please login with your account</p>
      <form action="" method="post">
        <label for="username">NISN</label>
        <div class="input-form">
          <img src="../assets/img/username.png" alt="user-icon" width="24px" />
          <input type="text" name="username" id="username" required />
        </div>
        <label for="password">Password</label>
        <div class="input-form">
          <img src="../assets/img/password.png" alt="lock-icon" width="24px" />
          <input type="password" name="password" id="password" required />
        </div>
        <button type="submit" name="submit">Login Now</button>
        <a href="../admin/loginadmin.php">Login as Admin</a>
      </form>
    </main>
  </div>

  <?php
  include '../admin/conn.php';
  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $ambil = $conn->query("SELECT * FROM siswa where '$username'=nisn AND '$pass'=password ");
    $akunyangcocok = $ambil->num_rows;
    if ($akunyangcocok == 1) {
      $akun = $ambil->fetch_assoc();
      $_SESSION['nisn'] = $akun;

      echo "<script>location='dashboardsiswa.php';</script>";
    } else {
      echo "<script>alert('Username atau Password Salah!');</script>";
      echo "<script>location='loginsiswa.php';</script>";
    }
  }
  ?>

  <footer>
    <p class="container">Copyright &copy; 2023 by Kita Bersuara</p>
  </footer>

  <script src="script.js"></script>
</body>

</html>