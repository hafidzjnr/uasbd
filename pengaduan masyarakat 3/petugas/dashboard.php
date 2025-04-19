
<h3 class="white-text"><b>Dashboard</b></h3>

	<div class="row">
		<div class="col s4">
		  <div class="card black">
		    <div class="card-content pink-text">
			<?php 
				$query = mysqli_query($koneksi,"SELECT * FROM pengaduan WHERE status='proses'");
				$jlmmember = mysqli_num_rows($query);
				if($jlmmember<1){
					$jlmmember=0;
				}
			 ?>
		      <span class="card-title">Laporan Status Proses<b class="right"><?php echo $jlmmember; ?></b></span>
		      <p></p>
		    </div>
		  </div>
		</div>	

		<div class="col s4">
		    <div class="card pink">
		    <div class="card-content black-text">
			<?php 
				$query = mysqli_query($koneksi,"SELECT * FROM tanggapan WHERE id_petugas='".$_SESSION['data']['id_petugas']."'");
				$jlmmember = mysqli_num_rows($query);
				if($jlmmember<1){
					$jlmmember=0;
				}
			 ?>
		      <span class="card-title">Laporan Ditanggapi <b class="right"><?php echo $jlmmember; ?></b></span>
		      <p></p>
		    </div>
		  </div>
		</div>
	</div>