<?php 
session_start();
require 'functions.php';

if ( !isset($_SESSION["login"]) ){
	echo "<script>
			alert('Anda Harus Login Terlebih Dahulu!');
      document.location.href ='login.php';
		</script>";
}

//ambil data di url
$id = $_GET["idUser"];

$biodata = query("SELECT * FROM users WHERE idUser = '$id'")[0];

if (isset($_POST["submit"]) ){

	
	if (ubah($_POST) > 0 ) {
		echo "
			<script>
				alert('Data berhasil diubah');
				document.location.href = 'user.php';
			</script>
		";
	} else {
		echo("\n \n \n \n \n \n");
		echo ("Error description:" .$conn -> error);
	}

 }
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Data User</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/manual/styledatauser.css">
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

    <div class="sidebar">
			<ul>
				<li>
					<a href="" style="text-align: center; padding: 30px 0 30px 0; font-size: 20px;">Welcome, <br><?php echo $biodata["namaUser"]; ?> </a>
				</li>

				<li>
					<a href="user.php"><span class="fa fa-user" aria-hidden="true"></span>Data User</a>
				</li>	
				 	
				<li>
					<a href="hasilUser.php"><span class="fas fa-trash-restore-alt" aria-hidden="true"></span>Hasil Pengumpulan</a>
				</li>
				
				<li>
					<a href="setoranUser.php"><span class="fas fa-comments-dollar" aria-hidden="true"></span>Transaksi Setoran</a>
				</li>

				<li>
					<a href="pengumpulanUser.php"><span class="fas fa-chart-bar" aria-hidden="true"></span>Grafik Pengumpulan</a>
				</li>

				<li>
					<a href="logout.php"><span class="fas fa-sign-out-alt" aria-hidden="true"></span>Logout</a>
				</li>

                <br><br><br><br><br><br><br><br>
                <img src="img/logo/logo.png" style="width:75%" class="ms-4" alt="">
                <p class="text-center text-warning">Bank Sampah Mliriprowo</p>

			</ul>
		</div>
      <div class="box-1 text-center">
        <h2 style="font-size: 30px; color: #262626;">Data Nasabah</h2>
        <div class="card">
          <div class="card-body">
          <form action="" method="post" class="mt-3">
            <div class="form-group mt-2">
            <label for="nama">Nama Lengkap</label>
            <div class="input-group">
                <div class="input-group-prepend mt-2">
                <div class="input-group-text">
                    <i class="fas fa-file-signature mt-2"></i>
                </div>
                </div>
                <input type="text" name="nama" id="nama" class="form-control mt-2" placeholder="Masukkan Nama Lengkap Anda" value="<?php echo $biodata["namaUser"]; ?>">
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
                <input type="text" name="nik" id="nik" class="form-control mt-2" placeholder="Masukkan Nomor Induk Kewarganegaraan" value="<?php echo $biodata["nik"]; ?>">
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
                <input type="text" name="alamat" id="alamat" class="form-control mt-2" placeholder="Masukkan Alamat Anda (lengkap dengan RT/RW)" value="<?php echo $biodata["alamat"]; ?>">
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
                <input type="text" name="telepon" id="telepon" class="form-control mt-2" placeholder="Masukkan Nomor Telepon Anda" value="<?php echo $biodata["telepon"]; ?>">
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
                <input type="text" name="username" id="username" class="form-control mt-2" placeholder="Masukkan Username Anda" value="<?php echo $biodata["username"]; ?>">
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
                <input type="password" name="password" id="password" class="form-control mt-2" placeholder="Masukkan Password Anda" value="<?php echo $biodata["passwordUser"]; ?>">
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
                <input type="password" name="password2" id="password2" class="form-control mt-2" placeholder="Konfirmasi Password Anda" value="<?php echo $biodata["passwordUser"]; ?>">
            </div>
            </div>

            <div class="form-group mt-2">
            <div class="input-group">
                <div class="input-group-prepend mt-2">
                </div>
                <input type="hidden" name="jmlSetoran" id="jmlSetoran" class="form-control mt-2" placeholder="" value="<?php echo $biodata["jmlSetoran"]; ?>">
            </div>
            </div>

            <div class="form-group mt-2">
            <div class="input-group">
                <div class="input-group-prepend mt-2">
                </div>
                <input type="hidden" name="saldo" id="saldo" class="form-control mt-2" placeholder="" value="<?php echo $biodata["saldo"]; ?>">
            </div>
            </div>

            <button type="submit" name="submit" class="btn-regist btn-primary mt-3 me-2 ms-1" style="width: 100%;">SUBMIT</button>
            </form>
          </div>
      </div>
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