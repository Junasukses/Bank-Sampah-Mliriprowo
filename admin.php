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

if($hitung < 0){
  $saldoAkhir = 0;
} else {
  $saldo = query("SELECT * FROM saldo_bank")[$hitung];
  $saldoAkhir = ($saldo['totalSaldo']);
}


$stock = query("SELECT stock FROM stock_sampah");

$users = mysqli_query($conn, "SELECT * FROM users");
$jumlahDataUsers = mysqli_num_rows($users);
$total = 0;
foreach ($stock as $row){
  $row['stock'];
  $total += $row['stock'] ;
};

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Admin</title>
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
        <h2 style="font-size: 30px; color: #262626;" class="text-center">Data Admin</h2>
        
        <div class="card">
          <div class="card-body">
        
            <section>
              <div class="form-group">
                <label class="">Nomor Induk Admin:</label>
                <input type="text" style="cursor: not-allowed; width: 100%;" disabled="disabled" value="<?php echo $biodata["IdAdmin"]; ?>" />
              </div>
              <div class="form-group">
                <label class="">Nama Admin:</label>
                <input type="text" style="cursor: not-allowed; width: 100%;" disabled="disabled" value="<?php echo $biodata["namaAdmin"]; ?>"/>
              </div>
              <div class="form-group">
                <label class="">Username:</label>
                <input type="text" style="cursor: not-allowed; width: 100%;" disabled="disabled" value="<?php echo $biodata["usernameAdmin"]; ?>"/>
              </div>
              <div class="form-group">
                <label class="">Level:</label>
                <input type="text" style="cursor: not-allowed; width: 100%;" disabled="disabled" value="<?php echo $biodata["level"]; ?>"/>
              </div>
              <a href="editAdmin.php?IdAdmin=<?php echo $biodata["IdAdmin"]; ?>">
              <button type="submit" name="submit" class="btn btn-primary btn-lg" style="width: 100%;">Edit Data</button></a> 
            </section>
          </div>
        </div>
        <br>
    <section class="statis mt-4 text-center">
      <div class="row">
        <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
          <div class="box bg-warning p-3">
            <i class="uil-eye"></i>
            <h3><?php echo "Rp. ".number_format(($saldoAkhir), 2, ",", ".") ?></h3>
            <p class="lead">Jumlah Saldo Bank</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
          <div class="box bg-danger p-3">
            <i class="fas fa-cubes"></i>
            <h3><?php echo $total." KG" ?></h3>
            <p class="lead">Jumlah Stock Sampah</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="box bg-success p-3">
            <i class="uil-user"></i>
            <h3><?php echo $jumlahDataUsers; ?></h3>
            <p class="lead">Jumlah User Yang Aktif</p>
          </div>
        </div>
      </div>
    </section>
        <!-- <div class="row text-white">
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
              </div> -->

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