<?php
// Add this near the top of the file to ensure alerts will work
if(!isset($alertsIncluded)) {
    echo '<link rel="stylesheet" type="text/css" href="../css/alerts.css">';
    echo '<link rel="stylesheet" type="text/css" href="../csstyle/masyarakat-dashboard.css">';
    echo '<script src="../js/alerts.js"></script>';
    $alertsIncluded = true;
}
?>
<table class="responsive-table" border="2" style="width: 100%;">
	<tr>
		<td><h4 class="white-text hide-on-med-and-down"><b>Tulis Laporan</b></h4></td>
		<td><h4 class="white-text hide-on-med-and-down"><b>Daftar Laporan</b></h4></td>
	</tr>
	<tr>
		<td style="padding: 20px;">
			<form method="POST" enctype="multipart/form-data">
				<textarea class="materialize-textarea " name="laporan" placeholder="Tulis Laporan"></textarea><br><br>
				<label>Gambar</label>
				<input type="file" name="foto"><br><br>
				<input type="submit" name="kirim" value="Kirim" class="btn black pink-text">
			</form>
		</td>

		<td>
			
			<table border="3" class="display responsive-table ">
				<tr>
					<td>No</td>
					<td>NIK</td>
					<td>Nama</td>
					<td>Tanggal Masuk</td>
					<td>Status</td>
					<td>Opsi</td>
				</tr>
				<?php 
					$no=1;
					$pengaduan = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik INNER JOIN tanggapan ON pengaduan.id_pengaduan=tanggapan.id_pengaduan WHERE pengaduan.nik='".$_SESSION['data']['nik']."' ORDER BY pengaduan.id_pengaduan DESC");
					while ($r=mysqli_fetch_assoc($pengaduan)) { ?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $r['nik']; ?></td>
						<td><?php echo $r['nama']; ?></td>
						<td><?php echo $r['tgl_pengaduan']; ?></td>
						<td><?php echo $r['status']; ?></td>
						<td>
							<a class="btn-small modal-trigger more-btn" href="#tanggapan&id_pengaduan=<?php echo $r['id_pengaduan'] ?>">More</a> 
							<a class="btn-small delete-btn" onclick="event.preventDefault(); showConfirm('Anda yakin ingin menghapus pengaduan ini?', function(confirmed) { 
            if(confirmed) window.location.href='index.php?p=pengaduan_hapus&id_pengaduan=<?php echo $r['id_pengaduan'] ?>';
        })" href="#">Hapus</a>
						</td>

<!-- ditanggapi -->
        <div id="tanggapan&id_pengaduan=<?php echo $r['id_pengaduan'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="pink-text">Detail</h4>
            <div class="col s12">
				<p>NIK : <?php echo $r['nik']; ?></p>
            	<p>Dari : <?php echo $r['nama']; ?></p>
            	<p>Petugas : <?php echo $r['nama_petugas']; ?></p>
				<p>Tanggal Masuk : <?php echo $r['tgl_pengaduan']; ?></p>
				<p>Tanggal Ditanggapi : <?php echo $r['tgl_tanggapan']; ?></p>
				<?php 
					if($r['foto']=="kosong"){ ?>
						<img src="../img/noImage.png" width="100">
				<?php	}else{ ?>
					<img width="100" src="../img/<?php echo $r['foto']; ?>">
				<?php }
				 ?>
				<br><b class="pink-text">Pesan</b>
				<p><?php echo $r['isi_laporan']; ?></p>
				<br><b class="pink-text">Respon</b>
				<p><?php echo $r['tanggapan']; ?></p>
            </div>

          </div>
          <div class="modal-footer col s12">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
<!-- ditanggapi -->

					</tr>
				<?php	}
				 ?>
			</table>

		</td>
	</tr>
</table>
<?php 
	
	 if(isset($_POST['kirim'])){
	 	$nik = $_SESSION['data']['nik'];
	 	$tgl = date('Y-m-d');


	 	$foto = $_FILES['foto']['name'];
	 	$source = $_FILES['foto']['tmp_name'];
	 	$folder = './../img/';
	 	$listeks = array('jpg','png','jpeg','jfif');
	 	$pecah = explode('.', $foto);
	 	$eks = $pecah['1'];
	 	$size = $_FILES['foto']['size'];
	 	$nama = date('dmYis').$foto;

		if($foto !=""){
		 	if(in_array($eks, $listeks)){
		 		if($size<=10000000){
					move_uploaded_file($source, $folder.$nama);
					$query = mysqli_query($koneksi,"INSERT INTO pengaduan VALUES (NULL,'$tgl','$nik','".$_POST['laporan']."','$nama','proses')");

		 			if($query){
			 			echo "<script>
                        showAlert('Pengaduan berhasil dikirim dan akan segera diproses', 'success');
                        setTimeout(function() {
                            window.location.href = 'index.php';
                        }, 2000);
                    </script>";
		 			}

		 		}
		 		else{
		 			echo "<script>showAlert('Ukuran gambar tidak boleh lebih dari 10MB', 'error');</script>";
		 		}
		 	}
		 	else{
		 		echo "<script>showAlert('Format file tidak didukung', 'error');</script>";
		 	}
		}
		else{
			$query = mysqli_query($koneksi,"INSERT INTO pengaduan VALUES (NULL,'$tgl','$nik','".$_POST['laporan']."','noImage.png','proses')");
			if($query){
			 	echo "<script>
                showAlert('Pengaduan berhasil dikirim dan akan segera ditanggapi', 'success');
                setTimeout(function() {
                    window.location.href = 'index.php';
                }, 2000);
            </script>";
 			}
		}

	 }

 ?>