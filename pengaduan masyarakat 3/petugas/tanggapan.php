<?php 
	$query = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik INNER JOIN tanggapan ON pengaduan.id_pengaduan=tanggapan.id_pengaduan INNER JOIN petugas ON tanggapan.id_petugas=petugas.id_petugas WHERE tanggapan.id_pengaduan='".$_GET['id']."'");
	$r=mysqli_fetch_assoc($query);
?>

<h2 class="white-text">Tanggapan dari <?php echo $r['nama_petugas']; ?></h2>
<div class="card">
    <div class="card-content">
        <p><b>Tanggal Tanggapan:</b> <?php echo $r['tgl_tanggapan']; ?></p>
        
        <?php if($r['foto'] != "kosong"): ?>
            <div class="media-section">
                <img width="200" src="../img/<?php echo $r['foto']; ?>">
            </div>
        <?php endif; ?>
        
        <div class="message-section">
            <h5 class="pink-text">Pengaduan</h5>
            <p><?php echo $r['isi_laporan']; ?></p>
            
            <h5 class="pink-text">Tanggapan</h5>
            <p><?php echo $r['tanggapan']; ?></p>
            
            <p><b>Status:</b> <?php echo $r['status']; ?></p>
        </div>
        
        <div class="button-section" style="margin-top: 20px;">
            <button class="btn black pink-text" onclick="window.location.href='index.php?p=pengaduan'">Kembali</button>
        </div>
    </div>
</div>