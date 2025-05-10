<?php
session_start();
include 'conn/koneksi.php';

$error_message = '';
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
        $_SESSION['username']=$username;
        $_SESSION['data']=$data;
        $_SESSION['level']='masyarakat';
        header('location:masyarakat/');
        exit();
    }
    elseif($cek2>0){
        if($data2['level']=="admin"){
            $_SESSION['username']=$username;
            $_SESSION['data']=$data2;
            header('location:admin/');
            exit();
        }
        elseif($data2['level']=="petugas"){
            $_SESSION['username']=$username;
            $_SESSION['data']=$data2;
            header('location:petugas/');
            exit();
        }
    }
    else{
        $error_message = 'Gagal Login Sob';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pengaduan Masyarakat</title>
    <link rel="stylesheet" type="text/css" href="csstyle/style.css">
    <link rel="stylesheet" type="text/css" href="csstyle/alerts.css">
    <script src="js/alerts.js"></script>
</head>
<body>
    <div class="card">
        <div id="particles-bg"></div>
        <div class="form-content">
            <h3><b>Login</b></h3>
            <h5><b>Pengaduan Masyarakat</b></h5>

            <form method="POST">
                <div class="input_field">
                    <label for="username">Username</label>
                    <input id="username" 
                        type="text" 
                        name="username" 
                        placeholder="Masukan Username" 
                        autocomplete="off" 
                        required>
                </div>
                <div class="input_field">
                    <label for="password">Password</label>
                    <input id="password" 
                        type="password" 
                        name="password"  
                        placeholder="Masukan Password" 
                        autocomplete="off" 
                        required>
                </div>

                <input type="submit" 
                    name="login" 
                    value="Login" 
                    class="btn login-btn">
                <br><br>
                <a href="new1.php" class="signup-link">Belum Punya Akun?</a>
            </form>
            <?php if($error_message): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    showAlert('<?php echo $error_message; ?>', 'error');
                });
            </script>
            <?php endif; ?>
        </div>
    </div>

    <!-- Add particles.js library -->
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
                    value: '#3a1c71'
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
                    color: '#3a1c71',
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