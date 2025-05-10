<?php
include 'conn/koneksi.php';
if(isset($_POST['simpan'])){
    $password = md5($_POST['password']);
    $query=mysqli_query($koneksi,"INSERT INTO masyarakat VALUES ('".$_POST['nik']."','".$_POST['nama']."','".$_POST['username']."','".$password."','".$_POST['telp']."')");
    if($query){
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                showAlert('Data berhasil disimpan', 'success');
                setTimeout(function() {
                    window.location.href = 'index.php';
                }, 2000);
            });
        </script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Buat Akun - Pengaduan Masyarakat</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="csstyle/new1.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/alerts.css">
    <script src="js/alerts.js"></script>
</head>
<body>
    <div class="registration-card">
        <div id="particles-bg"></div>
        <div class="form-content">
            <h3><b>Registrasi</b></h3>
            <h5><b>Pengaduan Masyarakat</b></h5>

            <form method="POST" class="registration-form">
                <div class="input_field">
                    <label for="nik">NIK</label>
                    <input id="nik" type="number" name="nik" placeholder="Masukan NIK" autocomplete="off" required>
                </div>
                <div class="input_field">
                    <label for="nama">Nama</label>
                    <input id="nama" type="text" name="nama" placeholder="Masukan Nama" autocomplete="off" required>
                </div>
                <div class="input_field">
                    <label for="username">Username</label>        
                    <input id="username" type="text" name="username" placeholder="Masukan Username" autocomplete="off" required>
                </div>
                <div class="input_field">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" placeholder="Masukan Password" autocomplete="off" required>
                </div>
                <div class="input_field">
                    <label for="telp">Telp</label>
                    <input id="telp" type="number" name="telp" placeholder="Masukan Nomor Telepon" autocomplete="off" required>
                </div>
            
                <input type="submit" name="simpan" value="Daftar" class="submit-btn">
                <a href="index.php" class="back-link">Kembali Ke Login</a>
            </form>
        </div>
    </div>
    
    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script>
        particlesJS('particles-bg', {
            particles: {
                number: {
                    value: 40,
                    density: {
                        enable: true,
                        value_area: 800
                    }
                },
                color: {
                    value: '#FF4B8B'
                },
                opacity: {
                    value: 0.2,
                    random: false
                },
                size: {
                    value: 3,
                    random: true
                },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#FF4B8B',
                    opacity: 0.2,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 2,
                    direction: 'none',
                    random: false,
                    straight: false,
                    out_mode: 'out',
                    bounce: false
                }
            },
            interactivity: {
                detect_on: 'canvas',
                events: {
                    onhover: {
                        enable: true,
                        mode: 'repulse'
                    },
                    onclick: {
                        enable: true,
                        mode: 'push'
                    },
                    resize: true
                }
            },
            retina_detect: true
        });
    </script>
</body>
</html>