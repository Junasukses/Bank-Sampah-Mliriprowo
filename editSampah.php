<?php 
session_start();
require 'functions.php';

if ( !isset($_SESSION["login"]) ){
	echo "<script>
			alert('Anda Harus Login Terlebih Dahulu!');
      document.location.href ='login.php';
		</script>";
}

$id = $_SESSION["IdAdmin"];
$biodata = query("SELECT * FROM admins WHERE IdAdmin = '$id'")[0];

//ambil data di url
$id = $_GET["idSampah"];
$sampah = query("SELECT * FROM sampah WHERE idSampah = '$id'")[0];

$coba = query("SELECT idUser FROM users")[0];

if (isset($_POST["submit"]) ){

	
	if (editSampah($_POST) > 0 ) {
		echo "
			<script>
				alert('Sampah Berhasil Diedit');
				document.location.href = 'sampahAdmin.php';
			</script>
		";
	} else {
		echo "	
			<script>
				alert('Sampah Gagal Diedit!');
				document.location.href = 'sampahAdmin.php';
			</script>
		";
	}

 }

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Edit Sampah</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="test/style.css">
    <link rel='stylesheet' href='https://unicons.iconscout.com/release/v3.0.6/css/line.css'>
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
                        <img src="img/logo/user.png" alt="">
                        <p>Administrator</p>
                    </center>
                    <li class="item">
                        <a href="admin.php" target="isi" class="menu-btn">
                            <i class="fas fa-desktop"></i><span>Dashboard</span>
                        </a>
                    </li>
                    <li class="item" id="kategori">
                        <a href="#kategori"class="menu-btn">
                            <i class="glyphicon glyphicon-book"></i><span>Data<i class="fas fa-chevron-down drop-down"></i></span>
                        </a>
                        <div class="sub-menu">
                            <a href="pengguna.php" target="isi"><i class=""></i><span>Data Pengguna</span></a>
                        </div>
                        <div class="sub-menu">
                            <a href="sampahAdmin.php" target="isi"><i class=""></i><span>Data Sampah</span></a>
                        </div>
                        <div class="sub-menu">
                            <a href="setoranAdmin.php" target="isi"><i class=""></i><span>Data Setoran</span></a>
                        </div>
                        <div class="sub-menu">
                            <a href="penarikanAdmin.php" target="isi"><i class=""></i><span>Data Penarikan</span></a>
                        </div>
                        <div class="sub-menu">
                            <a href="penjualanAdmin.php" target="isi"><i class=""></i><span>Data Penjualan</span></a>
                        </div>
                        <div class="sub-menu">
                            <a href="beritaAdmin.php" target="isi"><i class=""></i><span>Data Berita</span></a>
                        </div>
                    </li>
                    <li class="item" id="post">
                        <a href="#post"class="menu-btn">
                            <i class="fas fa-chart-bar"></i><span>Grafik<i class="fas fa-chevron-down drop-down"></i></span>
                        </a>
                        <div class="sub-menu">
                            <a href="monitoringAdmin.php" target="isi"><i class=""></i><span>Grafik Monitoring</span></a>
                        </div>
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
            <h2 class="text-center" style="font-size: 30px; color: #262626;">Edit Jenis Sampah</h2>
            <div class="card">
            <div class="card-body">
            <form action="" method="post" class="mt-3" enctype="multipart/form-data">
            <input type="hidden" name="namalama" value="<?php echo $sampah["namaSampah"]; ?>">
            <div class="form-group mt-2">
                <label for="jenisSampah" >Jenis Sampah :</label>
                <select name="jenisSampah" id="jenisSampah" required="required" class="btn btn-info dropdown-toggle"  style="width: 100%;" value="<?php echo $sampah["jenisSampah"]; ?>">
                    <option class="dropdown-item">Organik</option>
                    <option class="dropdown-item">Anorganik</option>
                </select>
            </div>
            <div class="form-group mt-2">
                <label for="jenisSampah" >Nama Sampah :</label>
                <input type="text" name="namaSampah" id="namaSampah"
                required="required" autofocus placeholder="Nama Sampah" autocomplete="off" class="form-order" style="width: 100%;" value="<?php echo $sampah["namaSampah"]; ?>"><br>
            </div>
            <div class="form-group mt-2">
                <label for="satuan">Harga Satuan :</label>
                <input type="number" name="harga" id="harga"
                required="required" autofocus placeholder="Rp. " class="form-order" style="width: 92%;" value="<?php echo $sampah["harga"]; ?>">
                <select name="satuan" id="satuan" required="required" class="btn btn-info dropdown-toggle" value="<?php echo $sampah["satuan"]; ?>">
                    <option class="dropdown-item">KG</option>
                    <option class="dropdown-item">PC</option>
                    <option class="dropdown-item">LT</option>								
                </select>
            </div>
            
            <div class="form-group mt-2">
                <label for="foto">Gambar :</label>
                <img src="img/sampah/<?= $sampah["gambar"]  ?>" width="30%" height="20%"> <br>
                <input type="file" name="foto" id="foto" class="form-order" value="img/sampah/<?php echo $sampah["gambar"]; ?>">
            </div>
            <div class="form-group mt-2">
            <label for="keterangan">Keterangan :</label>
                <input type="textarea" name="keterangan" id="keterangan" autofocus placeholder="keterangan" style="width: 100%;" class="form-order, ket" value="<?php echo $sampah["deskripsi"]; ?>"><br>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-lg" style="width: 100%;">SUBMIT</button>
                </form>
            
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