<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Admin | KitaBersuara</title>
  <link rel="stylesheet" href="../style/login.css" />
</head>

<body style="background-color: white;">
  <nav style="background-color: #5E7C60;">
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
    <main style="background-color: #F2EDD7; border-top: 10px solid #5E7C60; color: #5E7C60">
      <h2>LOGIN ADMIN</h2>
      <p>Please login with your account</p>
      <form action="" method="post">
        <label for="username">NISN</label>
        <div class="input-form" style="outline: 1px solid #5E7C60">
          <img src="../assets/img/username.png" alt="user-icon" width="24px" />
          <input type="text" style="color: #5E7C60" name="username" id="username" required />
        </div>
        <label for="password">Password</label>
        <div class="input-form">
          <img src="../assets/img/password.png" alt="lock-icon" width="24px" />
          <input type="password" name="password" id="password" required />
        </div>
        <button type="submit" name="submit">Login Now</button>
        <a href="../siswa/loginsiswa.php">Login as siswa</a>
      </form>
    </main>
  </div>

  <?php
  include 'conn.php';
  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $pass = $_POST['password'];

    $cek = mysqli_query($conn, "SELECT * FROM admin WHERE nisn='" . $username . "' AND password='" . $pass . "'");
    $akun = $cek->fetch_assoc();
    if (mysqli_num_rows($cek) > 0) {
      $d = mysqli_fetch_object($cek);
      $_SESSION['status_login'] = true;
      $_SESSION['a_global'] = $d;
      $_SESSION['id'] = $d->id_admin;
      $_SESSION['nisn'] = $akun;
      echo '<script>window.location="dashboard.php"</script>';
    } else {
      echo '<script>alert("Username atau Password Anda Salah!")</script>';
    }
  }

  ?>

  <footer>
    <p class="container">Copyright &copy; 2023 by Kita Bersuara</p>
  </footer>
  <script src="../siswa/script.js"></script>
</body>

</html>