<?php
session_start();
require 'functions.php';

	if ( isset($_POST["login"]) ){

      $username = mysqli_real_escape_string($conn, $_POST['username']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);

      $data_admin = mysqli_query($conn, "SELECT * FROM admins WHERE usernameAdmin = '$username'");
      $data_nasabah = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

      $n = mysqli_fetch_array($data_nasabah);
      $a = mysqli_fetch_array($data_admin);


			// admin
			$IdAdmin = $a['IdAdmin'];
			$nama_a = $a['namaAdmin'];
			$username_a = $a['usernameAdmin'];
			$password_a = $a['passwordAdmin'];
			$level_a = $a['level'];	
			$cek_admin = mysqli_num_rows($data_admin);
			// nasabah
			$id_n = $n['idUser'];
			$nama_n = $n['namaUser'];
			$nik_n = $n['nik'];
			$alamat = $n['alamat'];
      $telepon_n = $n['telepon'];
			$username_n = $n['username'];
			$password_n = $n['passwordUser'];
      $jmlSetoran = $n['jmlSetoran'];
			$saldo = $n['saldo'];
			$cek_user = mysqli_num_rows($data_nasabah);

			if ($username == "" || $password == "") {
				echo "
				<script>
					alert('Username dan Password tidak boleh kosong!');
					document.location.href ='login.php';
				</script>
				";
			}
			else {
				if ($cek_admin > 0) {
          session_start();
          $_SESSION['IdAdmin'] = $IdAdmin;
          $_SESSION['namaAdmin'] = $nama_a;
          $_SESSION['usernameAdmin'] = $username_a;
          $_SESSION['passwordAdmin'] = $password_a;
          $_SESSION['level'] = $level_a;
          $_SESSION["login"] = true;
          echo "
          <script>
            alert('Selamat Anda berhasil login!');
            document.location.href ='admin.php';
          </script>
          ";
		  	}
				else if ($cek_user > 0) {
          session_start();
          $_SESSION['idUser'] = $id_n;
          $_SESSION['namaUser'] = $nama_n;
          $_SESSION['nik'] = $nik_n;
          $_SESSION['alamat'] = $alamat;
          $_SESSION['telepon'] = $telepon_n;
          $_SESSION['username'] = $username_n;
          $_SESSION['passwordUser'] = $password;
          $_SESSION['jmlSetoran'] = $jmlSetoran;
          $_SESSION['saldo'] = $saldo;
          $_SESSION["login"] = true;

          echo "
            <script>
              alert('Selamat Anda berhasil login!');
              document.location.href ='user.php';
            </script>
          ";	
				}

				else {
          echo "
          <script>
            alert('Maaf username dan password tidak valid!');
            document.location.href ='login.php';
          </script>
          ";
				}
      }
    } else {header('location:yakali.php');}
  
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/manual/stylelogin.css">
    <script src="js/manual/preloader.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>
    $(document).ready(function() {
      $(".preloader").fadeOut();
    })
    </script>

  </head>
  <body> 
  <!--Pre Loader-->
  <div class="preloader">
    <div class="loading">
      <img src="img/aset/loading.gif" width="80">
    </div>
  </div>

    <div class="isi-content mx-auto" style="width: 30%; margin-top: 10%; box-shadow: 0 3px 20px rgba(0,0,0,0.4); padding: 40px;">
        <h3 class="text-center">FORM LOGIN</h3><hr style="width:75%; height: 5px;" class="mx-auto bg-danger">
        <form action=""  method="post" class="mt-3">
            <div class="form-group mt-2">
            <label for="username">Username</label>
            <div class="input-group">
                <div class="input-group-prepend mt-2">
                <div class="input-group-text">
                    <i class="fas fa-user mt-2"></i>
                </div>
                </div>
                <input type="text" name="username" id="username" class="form-control mt-2" placeholder="Masukkan Username Anda">
            </div>
            </div>
            <div class="form-group mt-2">
            <label for="password">Password</label>
            <div class="input-group">
                <div class="input-group-prepend mt-2">
                <div class="input-group-text">
                    <i class="fas fa-unlock-alt mt-2"></i>
                </div>
                </div>
                <input type="password" name="password" id="password" class="form-control mt-2" placeholder="Masukkan Password Anda">
            </div>
            <input type="checkbox" name="remember" id="remember">
						<label for="remember">Remember me</label>
            </div>
            <button type="submit" name="login" class="btn-login mt-3 me-2" style="width: 100%;">LOGIN</button>
            <small id="" class="form-text text-muted">Belum punya akun? silakan <a href="registrasi.php">Registrasi</a> disini! </small>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>