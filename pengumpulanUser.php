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
$conn     = mysqli_connect("localhost", "root", "", "bank_mliriprowo");
$keseluruhan       = mysqli_query($conn, "SELECT * FROM setoran order by idSetor asc");
$jumlahDataKeseluruhan = mysqli_num_rows($keseluruhan);
$pengguna = mysqli_query($conn, "SELECT * FROM setoran WHERE idUser = '$id' order by idSetor asc");
$jumlahDataPengguna = mysqli_num_rows($pengguna);

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Grafik Pengumpulan</title>
    <style>
        .container {
                width: 50%;
                height: 20%;
                margin: 15px auto;
            }
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/manual/styleuser.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/manual/style.css">
    <script src="js/chart/Chart.bundle.js" type="text/javascript"></script>
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

    <div class="box-1 text-center">
        <h2 style="font-size: 30px; color: #262626;">Perbandingan Jumlah Setoran Users</h2>
        <div class="container">
            <canvas id="myChart" width="100" height="50%"></canvas>
        </div>

        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Pengguna", "Keseluruhan"],
                    datasets: [{
                            label: 'Jumlah Pengumpulan',
                            data: ["<?php echo $jumlahDataPengguna?>", "<?php echo $jumlahDataKeseluruhan?>"],
                            backgroundColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',

                            ],
                            borderWidth: 2.5,
                            barPercentage: 0.8
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    stepSize: 10
                                }
                            }]
                    }
                }
            });
        </script>
        
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