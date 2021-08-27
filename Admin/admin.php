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

$no = mysqli_query($conn, "SELECT * FROM saldo_bank");
$jumlahData = mysqli_num_rows($no);
$hitung = $jumlahData - 1;
$saldo = query("SELECT * FROM saldo_bank")[$hitung];

$stock = query("SELECT stock FROM stock_sampah");

$users = mysqli_query($conn, "SELECT * FROM users");
$jumlahDataUsers = mysqli_num_rows($users);

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Admin</title>
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
          <a href="admin.php" style="text-align: center; padding: 30px 0 30px 0; font-size: 20px;">Welcome, <br><?php echo $biodata["namaAdmin"]; ?> </a>
				</li>

				<li>
					<a href="pengguna.php"><span class="fas fa-users" aria-hidden="true"></span>Data Pengguna</a>
				</li>	
				 	
				<li>
					<a href="sampahAdmin.php"><span class="fas fa-trash" aria-hidden="true"></span>Data Sampah</a>
				</li>
				
				<li>
					<a href="setoranAdmin.php"><span class="fas fa-trash-restore-alt" aria-hidden="true"></span>Data Setoran</a>
				</li>

        <li>
					<a href="penarikanAdmin.php"><span class="fas fa-hand-holding-usd" aria-hidden="true"></span>Data Penarikan</a>
				</li>

        <li>
					<a href="penjualanAdmin.php"><span class="fas fa-dollar-sign" aria-hidden="true"></span>Data Penjualan</a>
				</li>

				<li>
					<a href="monitoringAdmin.php"><span class="fas fa-chart-bar" aria-hidden="true"></span>Grafik Monitoring</a>
				</li>

				<li>
					<a href="logout.php"><span class="fas fa-sign-out-alt" aria-hidden="true"></span>Logout</a>
				</li>
                
                <br><br><br><br><br>
                <img src="img/logo/logo.png" style="width:75%" class="ms-4" alt="">
                <p class="text-center text-warning">Bank Sampah Mliriprowo</p>

			</ul>
		</div>
    
    <div class="box-1 text-center">
        <h2 style="font-size: 30px; color: #262626;">Data Admin</h2>
        
        <div class="card">
          <div class="card-body">
        
            <section>
              <div class="form-group">
                <label class="text-left">Nomor Induk Admin:</label>
                <input type="text" style="cursor: not-allowed;" disabled="disabled" value="<?php echo $biodata["IdAdmin"]; ?>" />
              </div>
              <div class="form-group">
                <label class="">Nama Admin:</label>
                <input type="text" style="cursor: not-allowed;" disabled="disabled" value="<?php echo $biodata["namaAdmin"]; ?>"/>
              </div>
              <div class="form-group">
                <label class="">Username:</label>
                <input type="text" style="cursor: not-allowed;" disabled="disabled" value="<?php echo $biodata["usernameAdmin"]; ?>"/>
              </div>
              <div class="form-group">
                <label class="">Password:</label>
                <input type="text" style="cursor: not-allowed;" disabled="disabled" value="<?php echo $biodata["passwordAdmin"]; ?>"/>
              </div>
              <div class="form-group">
                <label class="">Level:</label>
                <input type="text" style="cursor: not-allowed;" disabled="disabled" value="<?php echo $biodata["level"]; ?>"/>
              </div>
              <a href="editAdmin.php?IdAdmin=<?php echo $biodata["IdAdmin"]; ?>"><input type="button" href="" value="Edit Data" /></a> 
            </section>
          </div>
        </div>
        <br>

        <div class="row text-white">
                <div class="card bg-info ms-3 me-4" style="width: 25rem;">
                    <div class="card-body">
                        <div class="card-body-icon">
                          <i class="fas fa-balance-scale-right"></i>
                        </div>
                        <h5 class="card-title">JUMLAH SALDO BANK</h5>
                        <div class="display-4 fw-bold" style="font-size: 40px"><?php echo "Rp. ".number_format(($saldo['totalSaldo']), 2, ",", ".") ?></div>
                        <a href="saldobankAdmin.php"><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ms-2"></i></p></a>
                    </div>
                </div>

                <div class="card bg-success ms-5 me-4" style="width: 18rem;">
                    <div class="card-body">
                        <div class="card-body-icon">
                          <i class="fas fa-cubes"></i>
                        </div>
                        <h5 class="card-title">JUMLAH STOCK SAMPAH</h5>
                        <div class="display-4 fw-bold">
                          <?php $total = 0; ?>
                          <?php foreach ( $stock as $row)  : ?>
                            <?php $row['stock'] ?>
                            <?php $total += $row['stock'] ?>
                          <?php endforeach; ?>
                          <?php echo $total." KG" ?>
                        </div>
                        <a href="stocksampahAdmin.php"><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ms-2"></i></p></a>
                    </div>
                </div>

                <div class="card bg-danger ms-5" style="width: 18rem;">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-users me-2"></i>
                        </div>
                        <h5 class="card-title">JUMLAH USERS</h5>
                        <div class="display-4 fw-bold">
                          <?php echo $jumlahDataUsers; ?>
                        </div>
                        <a href="pengguna.php"><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ms-2"></i></p></a>
                    </div>
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