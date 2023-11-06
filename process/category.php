<?php

include "../admin/conn.php";
$keyword = $_GET["keycat"];

$terkirim = $conn->query("SELECT * FROM laporan,siswa,kategori,status_laporan where kategori.nama_kategori='$keyword' and status_laporan.status='terkirim' and status_laporan.id_status=laporan.id_status and laporan.nisn=siswa.nisn and laporan.id_kategori=kategori.id_kategori ");
$approve  = $conn->query("SELECT * FROM laporan,siswa,kategori,status_laporan where kategori.nama_kategori='$keyword' and status_laporan.status='approve' and status_laporan.id_status=laporan.id_status and laporan.nisn=siswa.nisn and laporan.id_kategori=kategori.id_kategori ");
$unapprove = $conn->query("SELECT * FROM laporan,siswa,kategori,status_laporan where kategori.nama_kategori='$keyword' and status_laporan.status='unapprove' and status_laporan.id_status=laporan.id_status and laporan.nisn=siswa.nisn and laporan.id_kategori=kategori.id_kategori ");

if ($keyword == "Kesiswaan" or "Kurikulum" or "Sarpras" or "Humas") { ?>
    <!-- laporan dengan status terkirim -->
    <?php while ($perlaporan = $terkirim->fetch_assoc()) {; ?>
        <div>
            <div class="laporan">
                <img src="../assets/fotobukti/<?= $perlaporan['foto']; ?>" alt="bukti_laporan" width="170" height="170" />
                <div class="detail_laporan">
                    <h4 class="pengusul">Pengusul: <span><?php echo $perlaporan['nama']; ?></span></h3>
                        <h4 class="category">&nbsp;&nbsp;&nbsp;&nbsp;#<span><?php echo $perlaporan['nama_kategori']; ?></span></h4>
                        <p>
                            Usulan: <br />
                            <span><?php echo $perlaporan['keluhan'] ?>.</span>
                        </p>
                </div>
                <form action="" method="post" class="status">
                    <input type="text" name="id_status" value="<?php echo $perlaporan['id_status'];  ?>" hidden>
                    <button type="submit" name="approve" class="approve">APPROVE</button>
                    <button type="submit" name="unapprove" class="delete">DELETE</button>
            </div>
            <div class="form">
                <textarea placeholder="Silahkan ketik feedback disini..." name="feedback" id="feedback" cols="10" rows="1"></textarea>
            </div>
            </form>
        </div>
    <?php } ?>

    <?php
    if (isset($_POST['approve'])) {
        $id_status = $_POST['id_status'];
        $feedback = $_POST['feedback'];
        $conn->query("UPDATE status_laporan SET feedback='$feedback', status='approve' where id_status='$id_status'");
        echo "<script>alert('Laporan Berhasil Di Approve')</script>";
        echo "<script>location='dashboard.php';</script>";
    }
    ?>
    <?php
    if (isset($_POST['unapprove'])) {
        $id_status = $_POST['id_status'];
        $feedback = $_POST['feedback'];
        $conn->query("UPDATE status_laporan SET feedback='$feedback', status='unapprove' where id_status='$id_status'");
        echo "<script>alert('Laporan Berhasil Di Delete')</script>";
        echo "<script>location='dashboard.php';</script>";
    }
    ?>

    <!-- kondisi approve -->
    <?php while ($perlaporan1 = $approve->fetch_assoc()) {; ?>
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

    <!-- kondisi unapprove -->
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
                <div class="icon_status unapproved">
                    <img src="../assets/img/unapproved.png" alt="status-icon">
                    <p>UNAPPROVE</p>
                </div>
            </div>
            <div class="form">
                <textarea placeholder="tidak ada feedback" name="feedback" <?php if ($perlaporan2['feedback']) {
                                                                                echo "readonly";
                                                                            } ?> id="feedback" cols="10" rows="1" required><?php echo $perlaporan2['feedback']; ?></textarea>
            </div>
            </form>
        </div>
<?php }
} ?>

<?php if ($keyword == 'all') {
    include 'all.php';
} ?>

<?php if ($keyword == 'setuju' or 'tidakSetuju') {
    include 'riwayat_laporan.php';
} ?>

<?php
if ($keyword == "Kesiswaan" or "Kurikulum" or "Sarpras" or "Humas") {
    if (mysqli_num_rows($terkirim) == 0 && mysqli_num_rows($approve) == 0 && mysqli_num_rows($unapprove) == 0) { ?>
        <h1 style="text-align: center; font-weight: bold; font-size: 16px; margin-top: 2px; margin-bottom: -76px">Masih kosong semua kack!<br>Harap bersabar....</h1>
<?php  }
}
?>