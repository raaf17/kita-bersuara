<?php
$ambil = $conn->query("SELECT * FROM laporan,siswa,kategori,status_laporan where status_laporan.status='approve' OR status_laporan.status='unapprove' OR status_laporan.status='terkirim' and status_laporan.id_status=laporan.id_status and laporan.nisn=siswa.nisn and laporan.id_kategori=kategori.id_kategori ");
while ($perlaporan = $ambil->fetch_assoc()) {;
  $imagePath = ($laporanku['foto']) ? "../assets/fotobukti/" . $laporanku['foto'] : "../assets/img/image-default.png";
?>
  <div>
    <div class="laporan">
      <img src="<?= $imagePath; ?>" alt="bukti_laporan" />
      <div class="detail_laporan">
        <h4 class="pengusul">Pengusul: <span>Pengusul: <span><?php echo $perlaporan['nama']; ?></span></h3>
            <h4 class="category">#<span><?php echo $perlaporan['nama_kategori']; ?></span></h4>
            <p>
              Usulan: <br />
              <span><?php echo $perlaporan['keluhan'] ?>.</span>
            </p>
      </div>
      <form action="" method="post" class="status">
        <button type="submit" name="approve" class="approve">APPROVE</button>
        <button type="submit" name="unapprove" class="delete">DELETE</button>
    </div>
    <div class="form">
      <textarea placeholder="Ketikkan feedback anda disini..." name="feedback" id="feedback" cols="10" rows="1" required></textarea>
    </div>
    </form>
    <?php 
      if (isset($_POST['approve'])) {
        $id_status = $perlaporan['id_status'];
        $feedback = $_POST['feedback'];
        $conn->query("UPDATE status_laporan SET feedback='$feedback', status='approve' where '$id_status'=id_status");
        echo "<script>alert('Laporan Berhasil Di Approve')</script>";
        echo "<script>location='dashboard.php';</script>";
      }
    ?>
    <?php 
      if (isset($_POST['unapprove'])) {
        $id_status = $perlaporan['id_status'];
        $feedback = $_POST['feedback'];
        $conn->query("UPDATE status_laporan SET feedback='$feedback', status='unapprove' where '$id_status'=id_status");
        echo "<script>alert('Laporan Berhasil Di Delete')</script>";
        echo "<script>location='dashboard.php';</script>";
      }
    ?>
  </div>

<?php } ?>