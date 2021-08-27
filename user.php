<?php 
session_start();
require 'functions.php';

if ( !isset($_SESSION["login"]) ){
	echo "<script>
			alert('Anda Harus Login Terlebih Dahulu!');
      document.location.href ='login.php';
		</script>";
}

$id = $_SESSION["idUser"];
$biodata = query("SELECT * FROM users WHERE idUser = '$id'")[0];

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
					<a href="setoranUser.php"><span class="fas fa-comments-dollar" aria-hidden="true"></span>Transaksi Penarikan</a>
				</li>

				<li>
					<a href="pengumpulanUser.php"><span class="fas fa-chart-bar" aria-hidden="true"></span>Grafik Pengumpulan</a>
				</li>

				<li>
					<a href="logout.php"><span class="fas fa-sign-out-alt" aria-hidden="true"></span>Logout</a>
				</li>

        <br><br><br><br><br><br>
        <img src="img/logo/logo.png" style="width:75%" class="ms-4" alt="">
        <p class="text-center text-warning">Bank Sampah Mliriprowo</p>

			</ul>
		</div>
      <div class="box-1 text-center">
        <h2 style="font-size: 30px; color: #262626;">Data Nasabah</h2>
        <div class="card">
          <div class="card-body">
        
            <section>
              <div class="form-group">
                <label class="text-left">Nomor Induk Nasabah:</label>
                <input type="text" style="cursor: not-allowed;" disabled="disabled" value="<?php echo $biodata["idUser"]; ?>" />
              </div>
              <div class="form-group">
                <label class="">Nama Nasabah:</label>
                <input type="text" style="cursor: not-allowed;" disabled="disabled" value="<?php echo $biodata["namaUser"]; ?>"/>
              </div>
              <div class="form-group">
                <label class="">NIK:</label>
                <input type="text" style="cursor: not-allowed;" disabled="disabled" value="<?php echo $biodata["nik"]; ?>"/>
              </div>
              <div class="form-group">
                <label class="">Alamat:</label>
                <input type="text" style="cursor: not-allowed;" disabled="disabled" value="<?php echo $biodata["alamat"]; ?>"/>
              </div>
              <div class="form-group">
                <label class="">Nomor Telepon:</label>
                <input type="text" style="cursor: not-allowed;" disabled="disabled" value="<?php echo $biodata["telepon"]; ?>"/>
              </div>
              <div class="form-group">
                <label class="">Username:</label>
                <input type="text" style="cursor: not-allowed;" disabled="disabled" value="<?php echo $biodata["username"]; ?>"/>
              </div>
              <div class="form-group">
                <label class="">Password User:</label>
                <input type="text" style="cursor: not-allowed;" disabled="disabled" value="<?php echo $biodata["passwordUser"]; ?>"/>
              </div>
              <div class="form-group">
                <label class="">Jumlah Setoran:</label>
                <input type="text" style="cursor: not-allowed;" disabled="disabled" value="<?php echo $biodata["jmlSetoran"]; ?>"/>
              </div>
              <div class="form-group">
                <label class="">Saldo Total (Rp):</label>
                <input type="text" style="cursor: not-allowed;" disabled="disabled" value="<?php echo $biodata["saldo"]; ?>"/>
              </div>
              <a href="ubahuser.php?idUser=<?php echo $biodata["idUser"]; ?>"><input type="button" href="" value="Edit Data" /></a> 
            </section>
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