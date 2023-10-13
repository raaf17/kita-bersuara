<?php
include "../admin/conn.php";
$keyword = $_GET["keycat"];

$setuju = $conn->query("SELECT * FROM laporan,siswa,kategori,status_laporan where status_laporan.status='approve' and laporan.id_status=status_laporan.id_status and laporan.nisn=siswa.nisn and laporan.id_kategori=kategori.id_kategori");
$tidak = $conn->query("SELECT * FROM laporan,siswa,kategori,status_laporan where status_laporan.status='unapprove' and laporan.id_status=status_laporan.id_status and laporan.nisn=siswa.nisn and laporan.id_kategori=kategori.id_kategori");
if ($keyword == "setuju") { ?>
 <?php if (mysqli_num_rows($setuju) != 0){?>
    <?php while ($perlaporan = $setuju->fetch_assoc()) {; ?>
        <div>
            <div class="laporan">
                <img src="../assets/fotobukti/<?= $perlaporan['foto']; ?>" alt="bukti_laporan" width="170" height="170" />
                <div class="detail_laporan">
                    <h4 class="pengusul">Pengusul: <span> <?php echo $perlaporan['nama']; ?></span></h3>
                            <h4 class="category">&nbsp;&nbsp;&nbsp;&nbsp;#<span><?php echo $perlaporan['nama_kategori']; ?></span></h4>
                            <p>
                                Usulan: <br />
                                <span><?php echo $perlaporan['keluhan'] ?>.</span>
                            </p>
                </div>
                <div class="icon_status approved">
              <img src="../assets/img/unapproved.png" alt="status-icon">
              <p>APPROVE</p>
            </div>
            </div>
            <div class="form">
                <textarea placeholder="feedback anda disini..." <?php if( $perlaporan['feedback']){ echo "readonly";} ?> name="feedback" id="feedback" cols="10" rows="1"><?php echo $perlaporan['feedback']; ?></textarea>
            </div>
            </form>
        </div>
        </div>
        <?php      
        }
      } else {?>
        <h1 style="text-align: center; font-weight: bold; font-size: 16px;">Belum ada laporan yang disetujui</h1>
<?php }
}

if ($keyword == "tidakSetuju") { ?>
 <?php if (mysqli_num_rows($setuju) != 0){?>
    <?php while ($perlaporan = $tidak->fetch_assoc()) {; ?>
        <div>
            <div class="laporan">
                <img src="../assets/fotobukti/<?= $perlaporan['foto']; ?>" alt="bukti_laporan" width="170" height="170" />
                <div class="detail_laporan">
                    <h4 class="pengusul">Pengusul: <span> <?php echo $perlaporan['nama']; ?></span></h3>
                            <h4 class="category">&nbsp;&nbsp;&nbsp;&nbsp;#<span><?php echo $perlaporan['nama_kategori']; ?></span></h4>
                            <p>
                                Usulan: <br />
                                <span><?php echo $perlaporan['keluhan'] ?>.</span>
                            </p>
                </div>
                <div class="icon_status unapproved">
              <img src="../assets/img/unapproved.png" alt="status-icon">
              <p>UNAPPROVE</p>
            </div>
            </div>
            <div class="form">
                <textarea placeholder="feedback anda disini..." <?php if( $perlaporan['feedback']){ echo "readonly";} ?> name="feedback" id="feedback" cols="10" rows="1"><?php echo $perlaporan['feedback']; ?></textarea>
            </div>
            </form>
        </div>
        </div>
        <?php      
    }
      } else {?>
        <h1 style="text-align: center; font-weight: bold; font-size: 16px;">Belum ada laporan yang tidak setujui</h1>
<?php }
}
?>
