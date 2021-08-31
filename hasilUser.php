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

$setoran = query("SELECT * FROM setoran WHERE idUser = '$id' ORDER BY tglSetor ASC");

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Hasil Pengumpulan</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/manual/styleuser.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/manual/style.css">
    <link rel="stylesheet" type="text/css" href="css/datatables/CSS/jquery.dataTables.css">
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

    <div class="box-1 text-center">
      <h2 style="font-size: 30px; color: #262626;">Data Pengumpulan Anda</h2>
      <div class="row text-white">
        <div class="card bg-info ms-3 me-4" style="width: 25rem;">
            <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-balance-scale-right"></i>
                </div>
                <h5 class="card-title">JUMLAH SALDO ANDA</h5><br>
                <div class="display-4 fw-bold" style="font-size: 40px"><?php echo "Rp. ".number_format(($biodata['saldo']), 2, ",", ".") ?></div>
            </div>
        </div>

        <div class="card bg-success ms-5 me-4" style="width: 18rem;">
            <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-cubes"></i>
                </div>
                <h5 class="card-title">JUMLAH SETORAN SAMPAH ANDA</h5>
                <div class="display-4 fw-bold"><?php echo $biodata['jmlSetoran']; ?></div>
            </div>
        </div>

        <div class="card bg-danger ms-5" style="width: 18rem;">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-users me-2"></i>
                </div>
                <h5 class="card-title">JUMLAH PENARIKAN SALDO ANDA</h5>
                <div class="display-4 fw-bold">
                  <?php echo $biodata['jmlPenarikan']; ?>
                </div>
                <a href="setoranUser.php"><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ms-2"></i></p></a>
            </div>
        </div>
      </div>
      <br><br>
      <div class="card">
          <div class="card-body">
        
          <table id="example" class="display" cellspacing="0" width="100%" border="0" >
            <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Setoran</th>
                <th>Nama Sampah</th>
                <th>Berat</th>
                <th>Harga/KG</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
					  <?php foreach ( $setoran as $row)  : ?>
            <?php $kode2 = $row["idSampah"] ?>
            <?php $namaSampah = query("SELECT namaSampah,harga FROM sampah WHERE idSampah = '$kode2' "); ?>
            <tr align="center">
                <td><?php echo $i; ?></td>
                <td><?php echo $row['tglSetor'] ?></td>
                <?php foreach ( $namaSampah as $sampah)  : ?>
                <td><?php echo $sampah['namaSampah']; ?></td>
                <td><?php echo $row['berat']." KG" ?></td>
                <td><?php echo "Rp. ".number_format($sampah['harga'], 2, ",", ".") ?></td>
                <td><?php echo "Rp. ".number_format(($row['total']), 2, ",", ".") ?></td>
                <?php endforeach; ?>
            </tr>
            <?php $i++; ?>
					  <?php endforeach; ?>
            </tbody>
          </table>
          <br>
          <br>
          <script type="text/javascript" src="css/datatables/js/jquery.min.js"></script>
          <script type="text/javascript" src="css/datatables/js/jquery.dataTables.min.js"></script>
          <script>
              $(document).ready(function() {
                $('#example').DataTable();
              } );
          </script>
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