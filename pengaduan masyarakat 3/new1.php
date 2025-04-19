<!DOCTYPE html>
<html>
<head>
	<title>Buat Akun</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<link href="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>
<body style="background: url(img/pik.jpg); background-size: cover;">
	
<div class="card"style="padding: 50px; width: 40%; margin: 0 auto; margin-top: 5%; border-radius: 30px; box-shadow: 0px 10px 20px 5px #263238;">
<h3 style="text-align: center;" class="black-text"><b>Registrasi</b></h3>
<h5 style="text-align: center;" class="black-text"><b>Masyarakat</b></h5>

	<form method="POST">
		<div >
				<div><label style="color: black;" for="nik">NIK</label>
					<input id="nik" type="number" name="nik" placeholder="Masukan NIK" autocomplete="off"><br><br>
				</div>
				<div >
					<label style="color: black;" for="nama">Nama</label>
					<input id="nama" type="text" name="nama" placeholder="Masukan Nama" autocomplete="off"><br><br>
				</div>
				<div >
					<label style="color: black;" for="username">Username</label>		
					<input id="username" type="text" name="username" placeholder="Masukan Username" autocomplete="off"><br><br>
				</div>
				<div >
					<label style="color: black;" for="password">Password</label>
					<input id="password" type="password" name="password" placeholder="Masukan Password" autocomplete="off"><br><br>
				</div>
				<div >
					<label style="color: black;" for="telp">Telp</label>
					<input id="telp" type="number" name="telp" placeholder="Masukan Nomor Telepon" autocomplete="off"><br><br>
				</div>
			
		<input type="submit" name="simpan" value="Simpan" class="btn pink " style="width: 100%; border-radius: 30px;"><br><br>
		<a href="index.php">Kembali Ke login</a>
	</div>
	</form>
</body>
</html>


<?php 
			include 'conn/koneksi.php';
				if(isset($_POST['simpan'])){
					$password = md5($_POST['password']);

					$query=mysqli_query($koneksi,"INSERT INTO masyarakat VALUES ('".$_POST['nik']."','".$_POST['nama']."','".$_POST['username']."','".$password."','".$_POST['telp']."')");
					if($query){
						echo "<script>alert('Data Tesimpan');
						document.location.href ='index.php';
						</script>";
					}
				}
			 ?>