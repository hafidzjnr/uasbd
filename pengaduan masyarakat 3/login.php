<div class="card" style="padding: 50px; width: 40%; margin: 0 auto; margin-top: 10%; border-radius: 30px; box-shadow: 0px 10px 20px 5px #263238;">
<h3 style="text-align: center;" class="black-text"><b>Login</b></h3>
<h5 style="text-align: center;" class="black-text"><b>Pengaduan Masyarakat</b></h5>

	<form method="POST">
		<div class="input_field">
			<label style="color: black;" for="username">Username</label>
			<input id="username" type="text" name="username" placeholder="Masukan Username" autocomplete="off" required>
		</div>
		<div class="input_field">
			<label style="color: black;" for="password">Password</label>
			<input id="password" type="password" name="password"  placeholder="Masukan Password" autocomplete="off" required>
		</div>
		<input type="submit" name="login" value="Login" class="btn pink white-text" style="width: 100%;"><br><br>
		<a href="new1.php">Belum Punya Akun?</a>
	</form>
</div>	
<?php 
	if(isset($_POST['login'])){
		$username = mysqli_real_escape_string($koneksi,$_POST['username']);
		$password = mysqli_real_escape_string($koneksi,md5($_POST['password']));
	
		$sql = mysqli_query($koneksi,"SELECT * FROM masyarakat WHERE username='$username' AND password='$password' ");
		$cek = mysqli_num_rows($sql);
		$data = mysqli_fetch_assoc($sql);
	
		$sql2 = mysqli_query($koneksi,"SELECT * FROM petugas WHERE username='$username' AND password='$password' ");
		$cek2 = mysqli_num_rows($sql2);
		$data2 = mysqli_fetch_assoc($sql2);

		if($cek>0){
			session_start();
			$_SESSION['username']=$username;
			$_SESSION['data']=$data;
			$_SESSION['level']='masyarakat';
			header('location:masyarakat/');
		}
		elseif($cek2>0){
			if($data2['level']=="admin"){
				session_start();
				$_SESSION['username']=$username;
				$_SESSION['data']=$data2;
				header('location:admin/');
			}
			elseif($data2['level']=="petugas"){
				session_start();
				$_SESSION['username']=$username;
				$_SESSION['data']=$data2;
				header('location:petugas/');
			}
		}
		else{
			echo "<script>alert('Gagal Login Sob')</script>";
		}

	}


 ?>