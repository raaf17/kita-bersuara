<?php

include '../admin/conn.php';
$keyword = $_GET["keyword"];

$semuadata1 = array();
$semuadata2 = array();
$semuadata3 = array();

$terkirim = $conn->query("SELECT * FROM laporan,siswa,kategori,status_laporan WHERE laporan.keluhan LIKE '%$keyword%' and status_laporan.status='terkirim' and status_laporan.id_status=laporan.id_status and laporan.nisn=siswa.nisn and laporan.id_kategori=kategori.id_kategori");
$approve = $conn->query("SELECT * FROM laporan,siswa,kategori,status_laporan WHERE laporan.keluhan LIKE '%$keyword%' and status_laporan.status='approve' and status_laporan.id_status=laporan.id_status and laporan.nisn=siswa.nisn and laporan.id_kategori=kategori.id_kategori");
$unapprove = $conn->query("SELECT * FROM laporan,siswa,kategori,status_laporan WHERE laporan.keluhan LIKE '%$keyword%' and status_laporan.status='unapprove' and status_laporan.id_status=laporan.id_status and laporan.nisn=siswa.nisn and laporan.id_kategori=kategori.id_kategori");

while ($pecah1 = $terkirim->fetch_assoc()) {
  $semuadata1[] = $pecah1;
}
while ($pecah2 = $approve->fetch_assoc()) {
  $semuadata2[] = $pecah2;
}
while ($pecah3 = $unapprove->fetch_assoc()) {
  $semuadata3[] = $pecah3;
}

if (empty($semuadata1 or $semuadata2 or $semuadata3)) : ?>
  <div class="">Pencarian Tidak Ditemukan</div>
<?php endif ?>

<!-- laporan dengan status terkirim -->
<?php foreach ($semuadata1 as $key => $value) : ?>
  <div>
    <div class="laporan">
      <img src="../assets/fotobukti/<?= $value['foto']; ?>" alt="bukti_laporan" width="170" height="170" />
      <div class="detail_laporan">
        <h4 class="pengusul">Pengusul: <span> <?php echo $value['nama']; ?></span></h3>
          <h4 class="category">&nbsp;&nbsp;&nbsp;&nbsp;#<span><?php echo $value['nama_kategori']; ?></span></h4>
          <p>
            Usulan: <br />
            <span><?php echo $value['keluhan'] ?>.</span>
          </p>
      </div>
      <form action="" method="post" class="status">
        <input type="text" name="id_status" value="<?php echo $value['id_status'];  ?>" hidden>
        <button type="submit" name="approve" class="approve">APPROVE</button>
        <button type="submit" name="unapprove" class="delete">DELETE</button>
    </div>
    <div class="form">
      <textarea placeholder="Silahkan ketik feedback disini..." name="feedback" id="feedback" cols="10" rows="1"></textarea>
    </div>
    </form>
  </div>
<?php endforeach ?>

<?php
if (isset($_POST['approve'])) {
  $id_status = $_POST['id_status'];
  $feedback = $_POST['feedback'];
  $conn->query("UPDATE status_laporan SET feedback='$feedback', status='approve' where '$id_status'=id_status");
  echo "<script>alert('Laporan Berhasil Di Approve')</script>";
  echo "<script>location='dashboard.php';</script>";
}
?>

<?php
if (isset($_POST['unapprove'])) {
  $id_status = $_POST['id_status'];
  $feedback = $_POST['feedback'];
  $conn->query("UPDATE status_laporan SET feedback='$feedback', status='unapprove' where '$id_status'=id_status");
  echo "<script>alert('Laporan Berhasil Di Delete')</script>";
  echo "<script>location='dashboard.php';</script>";
}

?>


<!-- laporan dengan status approve -->
<?php foreach ($semuadata2 as $key => $value) : ?>
  <div>
    <div class="laporan">
      <img src="../assets/fotobukti/<?= $value['foto']; ?>" alt="bukti_laporan" width="170" height="170" />
      <div class="detail_laporan">
        <h4 class="pengusul">Pengusul: <span> <?php echo $value['nama']; ?></span></h3>
          <h4 class="category">&nbsp;&nbsp;&nbsp;&nbsp;#<span><?php echo $value['nama_kategori']; ?></span></h4>
          <p>
            Usulan: <br />
            <span><?php echo $value['keluhan'] ?>.</span>
          </p>
      </div>
      <form action="" class="status">
        <div class="icon_status approved">
          <img src="../assets/img/approved.png" alt="status-icon">
          <p>APPROVE</p>
        </div>
    </div>
    <div class="form">
      <textarea placeholder="feedback kosong" <?php if ($value['feedback']) {
                                                echo "readonly";
                                              } ?> name="feedback" id="feedback" cols="10" rows="1"><?php echo $value['feedback']; ?></textarea>
    </div>
    </form>
  </div>
<?php endforeach ?>

<!-- laporan dengan status unapprove -->
<?php foreach ($semuadata3 as $key => $value) : ?>
  <div>
    <div class="laporan">
      <img src="../assets/fotobukti/<?= $value['foto']; ?>" alt="bukti_laporan" width="170" height="170" />
      <div class="detail_laporan">
        <h4 class="pengusul">Pengusul: <span> <?php echo $value['nama']; ?></span></h3>
          <h4 class="category">&nbsp;&nbsp;&nbsp;&nbsp;#<span><?php echo $value['nama_kategori']; ?></span></h4>
          <p>
            Usulan: <br />
            <span><?php echo $value['keluhan'] ?>.</span>
          </p>
      </div>
      <form action="" class="status">
        <div class="icon_status unapproved">
          <img src="../assets/img/unapproved.png" alt="status-icon">
          <p>UNAPPROVE</p>
        </div>
    </div>
    <div class="form">
      <textarea placeholder="feedback kosong" <?php if ($value['feedback']) {
                                                echo "readonly";
                                              } ?> name="feedback" id="feedback" cols="10" rows="1"><?php echo $value['feedback']; ?></textarea>
    </div>
    </form>
  </div>
<?php endforeach ?>