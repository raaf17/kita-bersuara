<?php
session_start();
include '../admin/conn.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Profile | Siswa</title>
  <link rel="stylesheet" href="../style/editprofile.css" />
</head>

<body>

  <body>
    <nav>
      <div class="container">
        <div class="nav_brand">
          <img src="../assets/img/pre-logo.png" alt="Logo Kita Bersuara" />
          <h4>Kita<br />Bersuara</h4>
        </div>
        <p>Dashboard Siswa</p>
        <div class="profile_siswa">
          <div class="name">
            <p><?php echo $_SESSION['nisn']['nama']; ?></p>
            <img src="../assets/img/arrow-drop.png" alt="Arrow Drop" />
            <input type="checkbox" name="check" id="check" />
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

    <main style="margin-top: 60px;">
      <div class="container" style="color: #5E7C60; margin-top: 180px;">
        <h1 style="color: #5E7C60;">HALAMAN EDIT PROFILE</h1>
        <form action="" method="post">
          <input type="hidden" name="nisn" value="<?= $_SESSION['nisn']['nisn']; ?>">
          <label for="nama">Nama Siswa</label>
          <input type="text" name="nama" value="<?php echo $_SESSION['nisn']['nama']; ?>" id="nama" />
          <label for="username">Username</label>
          <input type="text" name="username" value="<?php echo $_SESSION['nisn']['nisn']; ?>" id="username" readonly />
          <label for="password">Password</label>
          <input type="password" name="password" value="<?php echo $_SESSION['nisn']['password']; ?>" id="password" />
          <button type="submit" style="background-color: #5E7C60" name="submit">Edit Profile</button>
        </form>
      </div>
    </main>
    <?php
      if (isset($_POST['submit'])) {
      $nama = $_POST['nama'];
      $nisn = $_POST['nisn'];
      $password = $_POST['password'];

      $query = "UPDATE siswa SET nama='$nama', nisn='$nisn', password='$password' WHERE nisn='$nisn'";

      $conn->query($query);
      
      echo "<script>alert('Data Berhasil Diubah')</script>";
      echo "<script>location='loginsiswa.php';</script>";
    } ?>


    <footer>
      <p class="container">Copyright &copy; 2023 by Kita Bersuara</p>
    </footer>
    <script>
      const username = document.getElementById("username")

      username.addEventListener("click", () => alert("Username Tidak Dapat Diubah!"))
    </script>
  </body>
</body>

</html>