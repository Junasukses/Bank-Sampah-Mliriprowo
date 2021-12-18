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
error_reporting(0); 
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/manual/style.css">
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

    <!--wrapper start-->
        <div class="wrapper">
            <!--sidebar start-->
            <div class="sidebar">
                <div class="sidebar-menu">
                    <center class="profile">
                        <img src="img/user/<?= $biodata["gambar"]  ?>" alt="">
                        <p><?php echo $biodata["namaUser"]; ?></p>
                    </center>
                    <li class="item">
                        <a href="user.php" target="isi" class="menu-btn">
                            <i class="fa fa-user"></i><span>Data User</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="hasilUser.php" target="isi" class="menu-btn">
                            <i class="fas fa-comments-dollar"></i><span>Hasil Pengumpulan</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="setoranUser.php" target="isi" class="menu-btn">
                            <i class="fas fa-comments-dollar"></i><span>Transaksi Penarikan</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="pengumpulanUser.php" target="isi" class="menu-btn">
                            <i class="fas fa-chart-bar"></i><span>Grafik Pengumpulan</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="logout.php" target="isi" class="menu-btn">
                            <i class="fas fa-sign-out-alt"></i><span>Logout</span>
                        </a>
                    </li>
                </div>
            </div>
            <!--sidebar end-->
        </div>
        
      <div class="box-1">
        <h2 style="font-size: 30px; color: #262626;" class="text-center">Edit Data Nasabah</h2>
        <div class="card">
          <div class="card-body">
          <form action="" method="post" class="mt-3" enctype="multipart/form-data">
            <div class="form-group mt-2">
            <input type="hidden" name="gambarlama" value="<?= $data["gambar"]; ?>">
            <input type="hidden" name="jmlSetoran" id="jmlSetoran" class="form-control mt-2" placeholder="" value="<?php echo $biodata["jmlSetoran"]; ?>">
            <input type="hidden" name="saldo" id="saldo" class="form-control mt-2" placeholder="" value="<?php echo $biodata["saldo"]; ?>">
            
            <label for="nama">Nama Lengkap</label>
            <div class="input-group">
                <input type="text" name="nama" id="nama" required="required" class="form-control mt-2" placeholder="Masukkan Nama Lengkap Anda" value="<?php echo $biodata["namaUser"]; ?>">
            </div>
            </div>

            <div class="form-group mt-2">
            <label for="nama">Gambar</label>
            <div class="input-group">
                <img src="img/user/<?= $biodata["gambar"]  ?>" width="30%" height="20%"> <br><input type="file" name="gambar" id="gambar" required="required">
            </div>
            </div>
					
            <div class="form-group mt-2">
            <label for="nik">NIK</label>
            <div class="input-group">
                <input type="number" name="nik" id="nik" required="required" class="form-control mt-2" placeholder="Masukkan Nomor Induk Kewarganegaraan" value="<?php echo $biodata["nik"]; ?>">
            </div>
            </div>

            <div class="form-group mt-2">
            <label for="alamat">Alamat</label>
            <div class="input-group">
                <input type="text" name="alamat" id="alamat" required="required" class="form-control mt-2" placeholder="Masukkan Alamat Anda (lengkap dengan RT/RW)" value="<?php echo $biodata["alamat"]; ?>">
            </div>
            </div>

            <div class="form-group mt-2">
            <label for="telepon">Nomor Telepon</label>
            <div class="input-group">
                <input type="number" name="telepon" id="telepon" required="required" class="form-control mt-2" placeholder="Masukkan Nomor Telepon Anda" value="<?php echo $biodata["telepon"]; ?>">
            </div>
            </div>

            <div class="form-group mt-2">
            <label for="username">Username</label>
            <div class="input-group">
                <input type="text" name="username" id="username" required="required" class="form-control mt-2" placeholder="Masukkan Username Anda" value="<?php echo $biodata["username"]; ?>">
            </div>
            </div>

            <div class="form-group mt-2">
            <label for="password">Password</label>
            <div class="input-group">
                <input type="password" name="password" required="required" id="password" class="form-control mt-2" placeholder="Masukkan Password Anda" value="<?php echo $biodata["passwordUser"]; ?>">
            </div>
            </div>

            <div class="form-group mt-2">
            <label for="password2">Konfirmasi Password</label>
            <div class="input-group">
                <input type="password" name="password2" id="password2" required="required" class="form-control mt-2" placeholder="Konfirmasi Password Anda" value="<?php echo $biodata["passwordUser"]; ?>">
            </div>
            </div>

            <!-- <div class="form-group mt-2">
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
            </div> -->

            <button type="submit" name="submit" class="btn btn-primary btn-lg" style="width: 100%;">SUBMIT</button>
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