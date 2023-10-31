<?php

if (isset($_POST['filter-tgl'])) {

  $tgl_mulai = $_POST['tgl-mulai'];
  $tgl_selesai = $_POST['tgl-selesai'];

  $approve  = $conn->query("SELECT * FROM laporan,siswa,kategori,status_laporan where status_laporan.status='approve' and status_laporan.id_status=laporan.id_status and laporan.nisn=siswa.nisn and laporan.id_kategori=kategori.id_kategori AND laporan.created_at BETWEEN '$tgl_mulai' AND DATE_ADD('$tgl_selesai', INTERVAL 1 DAY)");
  $unapprove = $conn->query("SELECT * FROM laporan,siswa,kategori,status_laporan where status_laporan.status='unapprove' and status_laporan.id_status=laporan.id_status and laporan.nisn=siswa.nisn and laporan.id_kategori=kategori.id_kategori AND laporan.created_at BETWEEN '$tgl_mulai' AND DATE_ADD('$tgl_selesai', INTERVAL 1 DAY)");

  if (mysqli_num_rows($approve) == 0 && mysqli_num_rows($unapprove) == 0) { ?>
    <h1 style="text-align: center; font-weight: bold; font-size: 16px; margin-top: 5px; margin-bottom: -188px">Laporan yang anda cari pada<br>tanggal <?php echo $tgl_mulai ?> sampai dengan tanggal <?php echo $tgl_selesai ?> tidak ada!</h1>
  <?php
  } else {

  while ($perlaporan1 = $approve->fetch_assoc()) {; ?>
  <div>
    <div class="laporan">
      <img src="../assets/fotobukti/<?= $perlaporan1['foto']; ?>" alt="bukti_laporan" width="170" height="170" />
      <div class="detail_laporan">
        <h4 class="pengusul">Pengusul: <span><?php echo $perlaporan1['nama']; ?></span></h3>
          <h4 class="category">&nbsp;&nbsp;&nbsp;&nbsp;#<span><?php echo $perlaporan1['nama_kategori']; ?></span></h4>
          <p>
            Usulan: <br />
            <span><?php echo $perlaporan1['keluhan'] ?>.</span>
          </p>
      </div>
      <form action="" method="" class="status">
        <div class="icon_status approved">
          <img src="../assets/img/unapproved.png" alt="status-icon">
          <p>APPROVE</p>
        </div>
    </div>
    <div class="form">
      <textarea placeholder="tidak ada feedback" <?php if ($perlaporan1['feedback']) {
                                                    echo "readonly";
                                                  } ?> name="feedback" id="feedback" cols="10" rows="1" required><?php echo $perlaporan1['feedback']; ?></textarea>
    </div>
    </form>
  </div>
<?php } ?>

<?php while ($perlaporan2 = $unapprove->fetch_assoc()) {; ?>
  <div>
    <div class="laporan">
      <img src="../assets/fotobukti/<?= $perlaporan2['foto']; ?>" alt="bukti_laporan" width="170" height="170" />
      <div class="detail_laporan">
        <h4 class="pengusul">Pengusul: <span><?php echo $perlaporan2['nama']; ?></span></h3>
          <h4 class="category">&nbsp;&nbsp;&nbsp;&nbsp;#<span><?php echo $perlaporan2['nama_kategori']; ?></span></h4>
          <p>
            Usulan: <br />
            <span><?php echo $perlaporan2['keluhan'] ?>.</span>
          </p>
      </div>
      <form action="" method="" class="status">
        <div class="icon_status unapproved">
          <img src="../assets/img/unapproved.png" alt="status-icon">
          <p>UNAPPROVE</p>
        </div>
    </div>
    <div class="form">
      <textarea placeholder="tidak ada feedback" <?php if ($perlaporan2['feedback']) {
                                                    echo "readonly";
                                                  } ?> name="feedback" id="feedback" cols="10" rows="1" required><?php echo $perlaporan2['feedback']; ?></textarea>
    </div>
    </form>
  </div>
<?php }
  }
}
?>