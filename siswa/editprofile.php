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
  <style>
    nav .container .profile_siswa .name {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      -webkit-column-gap: 10px;
      column-gap: 10px;
      cursor: pointer;
      position: relative;
    }

    nav .container .profile_siswa .name input[type="checkbox"] {
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      width: 100% !important;
      opacity: 0;
      cursor: pointer;
      height: 100%;
    }

    nav .container .profile_siswa .name input[type="checkbox"]:checked~ul {
      display: block;
    }

    nav .container .profile_siswa .name ul {
      display: none;
      position: absolute;
      background-color: white;
      top: 40px;
      list-style: none;
      border-radius: 5px;
      border: 2.5px solid #5E7C60;
      -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.413);
      box-shadow: 0 0 4px rgba(0, 0, 0, 0.413);
    }

    nav .container .profile_siswa .name ul li:not(:last-child) {
      border-bottom: 2.5px solid #5E7C60;
    }

    nav .container .profile_siswa .name ul li a {
      display: block;
      padding: 5px 20px;
      text-decoration: none;
      color: #5E7C60;
      font-weight: 600;
    }

    nav .container .profile_siswa .name ul li a:hover {
      background-color: #5E7C60;
      color: white;
    }

    nav .container .btn_login {
      padding: 4px 26px;
      border: 2px solid white;
      border-radius: 4px;
      color: white;
      text-decoration: none;
      font-size: 22px;
      font-weight: 500;
      -webkit-transition: all ease-in-out 0.3s;
      transition: all ease-in-out 0.3s;
    }

    nav .container .btn_login:hover {
      background-color: white;
      color: #5E7C60;
    }

    main .container form input:-moz-read-only {
      background-color: #5E7C60;
    }

    main .container form>label,
    main .container form>input,
    main .container form button {
      width: 70%;
      margin: 5px 0;
    }

    main .container form>input,
    main .container form button {
      padding: 10px;
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
    }

    main .container form>input {
      background-color: transparent;
      border: 3px solid #5E7C60;
      border-radius: 3px;
      outline: none;
      color: #5E7C60;
      font-weight: 500;
    }

    main .container form button {
      background-color: #5E7C60;
      border: none;
      outline: none;
      font-weight: 800;
      font-size: 16px;
      color: white;
      cursor: pointer;
      border-radius: 3px;
    }
  </style>
</head>

<body>

  <body>
    <nav style="background-color: #5E7C60;">
      <div class="container">
        <div class="nav_brand">
          <img src="../assets/img/pre-logo.png" alt="Logo PUTI ONLINE" />
          <h4>Kita<br />Bersuara</h4>
        </div>
        <p>Dashboard Siswa</p>
        <div class="profile_siswa">
          <!-- <img
              class="profile"
              src="../assets/foto dashboardsiswa/<?php echo $_SESSION['nisn']['fotomhs']; ?>"
              alt="Profile_Siswa"
            /> -->
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
        <form action="" method="post" enctype="multipart/form-data">
          <!-- <div class="image">
              <img src="../assets/foto dashboardsiswa/<?php echo $_SESSION['nisn']['fotomhs'] ?>" alt="Profile siswa" />
              <label for="foto">
                <img src="../assets/img/camera.png" alt="icon-camera" />
                <input type="file" name="foto" id="foto" />
              </label>
            </div> -->
          <label for="nama">Nama Siswa</label>
          <input type="text" style="border: 3px solid #5E7C60" name="nama" value="<?php echo $_SESSION['nisn']['nama']; ?>" id="nama" readonly />
          <label for="username">Username</label>
          <input type="text" style="border: 3px solid #5E7C60" name="username" value="<?php echo $_SESSION['nisn']['nisn']; ?>" id="username" readonly />
          <label for="password">Password</label>
          <input type="password" style="border: 3px solid #5E7C60" name="password" value="<?php echo $_SESSION['nisn']['password']; ?>" id="password" />
          <button type="submit" style="background-color: #5E7C60" name="submit">Edit Profile</button>
        </form>
      </div>
    </main>
    <?php if (isset($_POST['submit'])) {
      $nisn = $_SESSION['nisn']['nisn'];
      $nama_foto = $_FILES['foto']['name'];
      $lokasi = $_FILES['foto']['tmp_name'];
      if (!empty($lokasi)) {
        move_uploaded_file($lokasi, "../assets/foto dashboardsiswa/$nama_foto");
        $conn->query("UPDATE siswa SET password='$_POST[password]', fotomhs='$nama_foto' where nisn='$nisn'");
      } else {
        $conn->query("UPDATE siswa SET password='$pass' WHERE nisn='$id'");
      }
      echo "<script>alert('Data Berhasil Diubah')</script>";
      echo "<script>location='loginsiswa.php';</script>";
    } ?>


    <footer style="background-color: #5E7C60;">
      <p class="container">Copyright &copy; 2023 by Kita Bersuara</p>
    </footer>
    <script>
      const nama = document.getElementById("nama")
      const username = document.getElementById("username")

      nama.addEventListener("click", () => alert("Nama tidak dapat diubah!"))
      username.addEventListener("click", () => alert("Username tidak dapat diubah!"))
    </script>
  </body>
</body>

</html>