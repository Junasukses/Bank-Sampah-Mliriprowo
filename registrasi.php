<?php 
	
require 'functions.php';

	if(isset($_POST["register"]) ) {

		if ( registrasi($_POST) > 0 ){
			echo "<script>
					alert('User baru berhasil ditambahkan!');
				  </script>";
			echo "<script>
					window.location.href='login.php'
				</script";
		} else {
			echo mysqli_error($conn);
		}
	}

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Registrasi</title>
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

  <div class="isi-content mx-auto" style="width: 70%; margin-top: 5%; box-shadow: 0 3px 20px rgba(0,0,0,0.4); padding: 40px;">
      <h3 class="text-center">FORM REGISTRASI</h3><hr style="width:75%; height: 5px;" class="mx-auto bg-danger">
      <form action="" method="post" class="mt-3">

        <div class="form-group mt-2">
          <label for="nama">Nama Lengkap</label>
          <div class="input-group">
            <div class="input-group-prepend mt-2">
              <div class="input-group-text">
                <i class="fas fa-file-signature mt-2"></i>
              </div>
            </div>
            <input type="text" name="nama" id="nama" class="form-control mt-2" placeholder="Masukkan Nama Lengkap Anda">
          </div>
        </div>

        <div class="form-group mt-2">
          <label for="nik">NIK</label>
          <div class="input-group">
            <div class="input-group-prepend mt-2">
              <div class="input-group-text">
                <i class="fas fa-address-card mt-2"></i>
              </div>
            </div>
            <input type="text" name="nik" id="nik" class="form-control mt-2" placeholder="Masukkan Nomor Induk Kewarganegaraan">
          </div>
        </div>

        <div class="form-group mt-2">
          <label for="alamat">Alamat</label>
          <div class="input-group">
            <div class="input-group-prepend mt-2">
              <div class="input-group-text">
                <i class="fas fa-map-marker-alt mt-2"></i>
              </div>
            </div>
            <input type="text" name="alamat" id="alamat" class="form-control mt-2" placeholder="Masukkan Alamat Anda (lengkap dengan RT/RW)">
          </div>
        </div>

        <div class="form-group mt-2">
          <label for="telepon">Nomor Telepon</label>
          <div class="input-group">
            <div class="input-group-prepend mt-2">
              <div class="input-group-text">
                <i class="fas fa-tty mt-2"></i>
              </div>
            </div>
            <input type="text" name="telepon" id="telepon" class="form-control mt-2" placeholder="Masukkan Nomor Telepon Anda">
          </div>
        </div>

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
                <i class="fas fa-lock mt-2"></i>
              </div>
            </div>
            <input type="password" name="password" id="password" class="form-control mt-2" placeholder="Masukkan Password Anda">
          </div>
        </div>

        <div class="form-group mt-2">
          <label for="password2">Konfirmasi Password</label>
          <div class="input-group">
            <div class="input-group-prepend mt-2">
              <div class="input-group-text">
                <i class="fas fa-unlock-alt mt-2"></i>
              </div>
            </div>
            <input type="password" name="password2" id="password2" class="form-control mt-2" placeholder="Konfirmasi Password Anda">
          </div>
        </div>

        <div class="form-group mt-2">
          <div class="input-group">
            <div class="input-group-prepend mt-2">
            </div>
            <input type="hidden" name="jmlSetoran" id="jmlSetoran" class="form-control mt-2" placeholder="Konfirmasi Password Anda">
          </div>
        </div>

        <div class="form-group mt-2">
          <div class="input-group">
            <div class="input-group-prepend mt-2">
            </div>
            <input type="hidden" name="saldo" id="saldo" class="form-control mt-2" placeholder="Konfirmasi Password Anda">
          </div>
        </div>

        <button type="submit" name="register" class="btn-regist btn-primary mt-3 me-2 ms-1" style="width: 100%;">SUBMIT</button>
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