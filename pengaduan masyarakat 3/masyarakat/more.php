<?php 
	
	if($_GET['apa']=="pengaduan"){ ?>

<?php 
	$query = mysqli_query($koneksi,"SELECT * FROM pengaduan WHERE id_pengaduan='".$_GET['id']."'
	");
	$r=mysqli_fetch_assoc($query);
?>

<h2 class="white-text" style="margin-bottom: 20px;">Detail Pengaduan</h2>

<div class="card">
    <div class="card-content">
        <b class="pink-text">Pesan</b>
        <p><?php echo $r['isi_laporan']; ?></p>
        <p>Status : <?php echo $r['status']; ?></p>

        <?php if($r['foto'] != "kosong"): ?>
            <div style="margin-top: 20px;">
                <b class="pink-text">Bukti Foto</b><br>
                <img width="200" src="../img/<?php echo $r['foto']; ?>">
            </div>
        <?php endif; ?>

        <div style="margin-top: 30px;">
            <button class="btn black pink-text" onclick="window.location.href='index.php?p=dashboard'">Kembali</button>
        </div>
    </div>
</div>

<?php	}elseif ($_GET['apa']=="tanggapan") { ?>

<?php 
	$query = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik INNER JOIN tanggapan ON pengaduan.id_pengaduan=tanggapan.id_pengaduan INNER JOIN petugas ON tanggapan.id_petugas=petugas.id_petugas WHERE tanggapan.id_pengaduan='".$_GET['id_pengaduan']."'");
	$r=mysqli_fetch_assoc($query);
 ?>
<h2>Petugas <?php echo $r['nama_petugas']; ?></h2>
<b>Ditanggapi pada :<?php echo $r['tgl_tanggapan']; ?></b><br>
<?php 
	if($r['foto']=="kosong"){ ?>
		<img src="../img/noImage.png" width="100">
<?php	}else{ ?>
	<img width="100" src="../img/<?php echo $r['foto']; ?>">
<?php }
 ?>
<p><?php echo $r['isi_laporan']; ?></p>
<p><?php echo $r['tanggapan']; ?></p>
<p>Status : <?php echo $r['status']; ?></p>

<button><a href="index.php?p=dashboard">Back</a></button>

<?php } ?>