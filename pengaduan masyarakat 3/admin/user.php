<link rel="stylesheet" type="text/css" href="../csstyle/respon.css">

<div class="row page-header">
          <div class="col s12 m9">
            <h3 class="text"><b>User</b></h3>
          </div>  
          <div class="col s12 m3 add-button-container">
            <div class="section"></div>
            <a class="waves-effect waves-light btn modal-trigger black" href="#modal1"><i class="material-icons">add</i></a>
          </div>
        </div>

        <table id="example" class="responsive-table white" style="width:100%">
          <thead>
              <tr>
				<th>No</th>
				<th>Nama</th>
				<th>Username</th>
				<th>Telephone</th>
				<th>level</th>
				<th>Opsi</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$tampil = mysqli_query($koneksi,"SELECT * FROM petugas ORDER BY nama_petugas ASC");
		while ($r=mysqli_fetch_assoc($tampil)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['nama_petugas']; ?></td>
			<td><?php echo $r['username']; ?></td>
			<td><?php echo $r['telp']; ?></td>
			<td><?php echo $r['level']; ?></td>
			<td>
					<a class="btn-small modal-trigger more-btn" href="#user_edit<?php echo $r['id_petugas'] ?>">Edit</a> 
					<a class="btn-small delete-btn " onclick="event.preventDefault(); showConfirm('Anda yakin ingin menghapus?', function(confirmed) { 
            if(confirmed) window.location.href='index.php?p=user_hapus&id_petugas=<?php echo $r['id_petugas'] ?>';
        })" href="#">Hapus</a>
			</td>

<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
        <!-- Modal Structure -->
        <div id="user_edit<?php echo $r['id_petugas'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="pink-text">Edit</h4>
			<form method="POST">
				<div class="col s12 input-field">
					<label for="nama">Nama</label>
					<input hidden type="text" name="id_petugas" value="<?php echo $r['id_petugas']; ?>">
					<input id="nama" type="text" name="nama" value="<?php echo $r['nama_petugas']; ?>">
				</div>
				<div class="col s12 input-field">
					<label for="username">Username</label>		
					<input id="username" type="text" name="username" value="<?php echo $r['username']; ?>"><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="telp">Telp</label>
					<input id="telp" type="number" name="telp" value="<?php echo $r['telp']; ?>"><br><br>
				</div>
				<div class="col s12 input-field">
					<p>
						<label>
						  <input value="admin" class="with-gap" name="level" type="radio" <?php if($r['level']=="admin"){echo "checked";} ?> />
						  <span>Admin</span>
						</label>
						<label>
						  <input value="petugas" class="with-gap" name="level" type="radio" <?php if($r['level']=="petugas"){echo "checked";} ?> />
						  <span>Petugas</span>
						</label>
					</p>
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="Update" value="Simpan" class="btn black pink-text">
				</div>
			</form>

			<?php 
				if(isset($_POST['Update'])){
					// echo $_POST['nama'].$_POST['username'].$_POST['telp'].$_POST['level'];
					$update=mysqli_query($koneksi,"UPDATE petugas SET nama_petugas='".$_POST['nama']."',username='".$_POST['username']."',telp='".$_POST['telp']."',level='".$_POST['level']."' WHERE id_petugas='".$_POST['id_petugas']."' ");
					if($update){
						echo "<script>alert('Data di Update')</script>";
						echo "<script>location='index.php?p=user'</script>";
					}
				}
			 ?>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->

		</tr>
            <?php  }
             ?>

          </tbody>
        </table>        

        <!-- Modal Structure -->
        <div id="modal1" class="modal">
          <div class="modal-content">
            <h4 class="pink-text">Add</h4>
			<form method="POST">
				<div class="col s12 input-field">
					<label for="nama">Nama</label>
					<input id="nama" type="text" name="nama">
				</div>
				<div class="col s12 input-field">
					<label for="username">Username</label>		
					<input id="username" type="text" name="username"><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="password">Password</label>
					<input id="password" type="password" name="password"><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="telp">Telp</label>
					<input id="telp" type="number" name="telp"><br><br>
				</div>

				<div class="col s12 input-field">
					<select class="default" name="level">
						<option selected disabled="">Pilih Level</option>
						<option value="admin">Admin</option>
						<option value="petugas">Petugas</option>
					</select>
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="input" value="Simpan" class="btn-small ">
				</div>
			</form>

			<?php 
				if(isset($_POST['input'])){
					$password = md5($_POST['password']);

					$query=mysqli_query($koneksi,"INSERT INTO petugas VALUES (NULL,'".$_POST['nama']."','".$_POST['username']."','".$password."','".$_POST['telp']."','".$_POST['level']."')");
					if($query){
						echo "<script>alert('Data Ditambahkan')</script>";
						echo "<script>location='index.php?p=user'</script>";
					}
				}
			 ?>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>

<?php if(isset($_POST['input'])): ?>
    <script>
        showAlert('Data berhasil ditambahkan', 'success');
        setTimeout(() => {
            window.location.href = 'index.php?p=user';
        }, 2000);
    </script>
<?php endif; ?>

<?php if(isset($_POST['Update'])): ?>
    <script>
        showAlert('Data berhasil diupdate', 'success');
        setTimeout(() => {
            window.location.href = 'index.php?p=user';
        }, 2000);
    </script>
<?php endif; ?>