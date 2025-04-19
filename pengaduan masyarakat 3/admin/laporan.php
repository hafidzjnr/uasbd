        <div class="row">
          <div class="col s12 m9">
            <h3 class="white-text"><b>Laporan</b></h3>
          </div> 
          <div class="col s12 m3">
            <div class="section"></div>
            <a style="margin-right: 5px;" title="PDF" class="waves-effect waves-light btn black" href="cetak.php"><i class="material-icons">print</i></a>
          	<a title="Excel" class="waves-effect waves-light btn black" href="export.php"><i class="material-icons">save</i></a>
          </div>
        </div>

        <table id="example" class=" responsive-table white" style="width:100%">
          <thead>
              <tr>
				<th>No</th>
				<th>NIK Pelapor</th>
				<th>Nama Pelapor</th>
				<th>Nama Petugas</th>
				<th>Tanggal Masuk</th>
				<th>Tanggal Ditanggapi</th>
				<th>Status</th>
				<th>Opsi</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$query = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik INNER JOIN tanggapan ON tanggapan.id_pengaduan=pengaduan.id_pengaduan INNER JOIN petugas ON tanggapan.id_petugas=petugas.id_petugas ORDER BY tgl_pengaduan DESC");
		while ($r=mysqli_fetch_assoc($query)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['nik']; ?></td>
			<td><?php echo $r['nama']; ?></td>
			<td><?php echo $r['nama_petugas']; ?></td>
			<td><?php echo $r['tgl_pengaduan']; ?></td>
			<td><?php echo $r['tgl_tanggapan']; ?></td>
			<td><?php echo $r['status']; ?></td>
			<td><a class="btn black pink-text modal-trigger" href="#laporan?id_tanggapan=<?php echo $r['id_tanggapan'] ?>">More</a></td>

<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
        <!-- Modal Structure -->
        <div id="laporan?id_tanggapan=<?php echo $r['id_tanggapan'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="pink-text">Detail</h4>
            <div class="col s12 m6">
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
<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->

		</tr>
            <?php  }
             ?>

          </tbody>
        </table>        