<?php 
// session_start();
require '../functions.php';

// if ( !isset($_SESSION["login"]) ){
// 	echo "<script>
// 			alert('Anda Harus Login Terlebih Dahulu!');
//       document.location.href ='login.php';
// 		</script>";
// }

// $id = $_SESSION["IdAdmin"];
// $biodata = query("SELECT * FROM admins WHERE IdAdmin = '$id'")[0];

$no = mysqli_query($conn, "SELECT * FROM saldo_bank");
$jumlahData = mysqli_num_rows($no);
$hitung = $jumlahData - 1;
$saldo = query("SELECT * FROM saldo_bank")[$hitung];

$stock = query("SELECT stock FROM stock_sampah");
$stock2 = mysqli_query($conn, "SELECT stock FROM stock_sampah order by idStock asc");
$users = mysqli_query($conn, "SELECT * FROM users");
$jumlahDataUsers = mysqli_num_rows($users);
$total = 0;

foreach ($stock as $row){
  $row['stock'];
  $total += $row['stock'] ;
};
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Dashboard</title>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://unicons.iconscout.com/release/v3.0.6/css/line.css'><link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<aside class="sidebar position-fixed top-0 left-0 overflow-auto h-100 float-left" id="show-side-navigation1">
  <i class="uil-bars close-aside d-md-none d-lg-none" data-close="show-side-navigation1"></i>
  <div class="sidebar-header d-flex justify-content-center align-items-center px-3 py-4">
    <img
         class="rounded-pill img-fluid"
         width="65"
         src="../img/logo/user.png"
         alt="">
    <div class="ms-2">
      <h5 class="fs-6 mb-0">
        <a class="text-decoration-none" href="#">Admin 1</a>
      </h5>
      <p class="mt-1 mb-0">Administrator</p>
    </div>
  </div>

  <div class="search position-relative text-center px-4 py-3 mt-2">
    <input type="text" class="form-control w-100 border-0 bg-transparent" placeholder="Search here">
    <i class="fa fa-search position-absolute d-block fs-6"></i>
  </div>

  <ul class="categories list-unstyled">
    <li class="has-dropdown">
      <i class="uil-estate fa-fw"></i><a href="#"> Dashboard</a>
      <ul class="sidebar-dropdown list-unstyled">
        <li><a href="#">Lorem ipsum</a></li>
        <li><a href="#">ipsum dolor</a></li>
        <li><a href="#">dolor ipsum</a></li>
        <li><a href="#">amet consectetur</a></li>
        <li><a href="#">ipsum dolor sit</a></li>
      </ul>
    </li>
    <li class="">
      <i class="uil-folder"></i><a href="#"> File manager</a>
    </li>
    <li class="has-dropdown">
      <i class="uil-panel-add"></i><a href="#"> Charts</a>
      <ul class="sidebar-dropdown list-unstyled">
        <li><a href="#">Lorem ipsum</a></li>
        <li><a href="#">ipsum dolor</a></li>
        <li><a href="#">dolor ipsum</a></li>
        <li><a href="#">amet consectetur</a></li>
        <li><a href="#">ipsum dolor sit</a></li>
      </ul>
    </li>
    <li class="">
      <i class="uil-setting"></i><a href="#"> Settings</a>
      <ul class="sidebar-dropdown list-unstyled">
        <li><a href="#">Lorem ipsum</a></li>
        <li><a href="#">ipsum dolor</a></li>
        <li><a href="#">dolor ipsum</a></li>
        <li><a href="#">amet consectetur</a></li>
        <li><a href="#">ipsum dolor sit</a></li>
      </ul>
    </li>
  </ul>
</aside>

<section id="wrapper">
  <nav class="navbar navbar-expand-md">
    <div class="container-fluid mx-2">
      <div class="navbar-header">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#toggle-navbar" aria-controls="toggle-navbar" aria-expanded="false" aria-label="Toggle navigation">
          <i class="uil-bars text-white"></i>
        </button>
        <a class="navbar-brand" href="#">Halaman<span class="main-color"> Admin</span></a>
      </div>
      <div class="collapse navbar-collapse" id="toggle-navbar">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i data-show="show-side-navigation1" class="uil-bars show-side-btn"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="p-4">
    <div class="welcome">
      <div class="content rounded-3 p-3">
        <h1 class="fs-3">Welcome to Dashboard</h1>
      </div>
    </div>

    <section class="statistics mt-4">
      <div class="row">
        <div class="col-lg-4">
          <div class="box d-flex rounded-2 align-items-center mb-4 mb-lg-0 p-3">
            <i class="uil-envelope-shield fs-2 text-center bg-primary rounded-circle"></i>
            <div class="ms-3">
              <div class="d-flex align-items-center">
                <h3 class="mb-0"><?php echo "Rp. ".number_format(($saldo['totalSaldo']), 2, ",", ".") ?></h3> <span class="d-block ms-2">Sisa Saldo</span>
              </div>
              <p class="fs-normal mb-0">Jumlah Saldo Bank</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="box d-flex rounded-2 align-items-center mb-4 mb-lg-0 p-3">
            <i class="uil-file fs-2 text-center bg-danger rounded-circle"></i>
            <div class="ms-3">
              <div class="d-flex align-items-center">
                <h3 class="mb-0"><?php echo $total ?></h3> <span class="d-block ms-2">Kg</span>
              </div>
              <p class="fs-normal mb-0">Jumlah Stock Sampah</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="box d-flex rounded-2 align-items-center p-3">
            <i class="uil-users-alt fs-2 text-center bg-success rounded-circle"></i>
            <div class="ms-3">
              <div class="d-flex align-items-center">
                <h3 class="mb-0"><?php echo $jumlahDataUsers; ?></h3> <span class="d-block ms-2">Users</span>
              </div>
              <p class="fs-normal mb-0">Jumlah User Yang Aktif</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <section class="charts mt-4">
      <div class="chart-container p-3">
            <h3 class="fs-6 mb-3">Chart title number one</h3>
            <div style="height: 300px">
            <canvas id="myChart" width="100%"></canvas>
          </div>
        </div>
    </section>

    <section class="admins mt-4">
      <div class="row">
        <div class="col-md-6">
          <div class="box">
            <!-- <h4>Admins:</h4> -->
            <div class="admin d-flex align-items-center rounded-2 p-3 mb-4">
              <div class="img">
                <img class="img-fluid rounded-pill"
                     width="75" height="75"
                     src="https://uniim1.shutterfly.com/ng/services/mediarender/THISLIFE/021036514417/media/23148906966/small/1501685402/enhance"
                     alt="admin">
              </div>
              <div class="ms-3">
                <h3 class="fs-5 mb-1">Joge Lucky</h3>
                <p class="mb-0">Lorem ipsum dolor sit amet consectetur elit.</p>
              </div>
            </div>
            <div class="admin d-flex align-items-center rounded-2 p-3 mb-4">
              <div class="img">
                <img class="img-fluid rounded-pill"
                     width="75" height="75"
                     src="https://uniim1.shutterfly.com/ng/services/mediarender/THISLIFE/021036514417/media/23148907137/small/1501685404/enhance"
                     alt="admin">
              </div>
              <div class="ms-3">
                <h3 class="fs-5 mb-1">Joge Lucky</h3>
                <p class="mb-0">Lorem ipsum dolor sit amet consectetur elit.</p>
              </div>
            </div>
            <div class="admin d-flex align-items-center rounded-2 p-3">
              <div class="img">
                <img class="img-fluid rounded-pill"
                     width="75" height="75"
                     src="https://uniim1.shutterfly.com/ng/services/mediarender/THISLIFE/021036514417/media/23148907019/small/1501685403/enhance"
                     alt="admin">
              </div>
              <div class="ms-3">
                <h3 class="fs-5 mb-1">Joge Lucky</h3>
                <p class="mb-0">Lorem ipsum dolor sit amet consectetur elit.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="box">
            <!-- <h4>Moderators:</h4> -->
            <div class="admin d-flex align-items-center rounded-2 p-3 mb-4">
              <div class="img">
                <img class="img-fluid rounded-pill"
                     width="75" height="75"
                     src="https://uniim1.shutterfly.com/ng/services/mediarender/THISLIFE/021036514417/media/23148907114/small/1501685404/enhance"
                     alt="admin">
              </div>
              <div class="ms-3">
                <h3 class="fs-5 mb-1">Joge Lucky</h3>
                <p class="mb-0">Lorem ipsum dolor sit amet consectetur elit.</p>
              </div>
            </div>
            <div class="admin d-flex align-items-center rounded-2 p-3 mb-4">
              <div class="img">
                <img class="img-fluid rounded-pill"
                     width="75" height="75"
                     src="https://uniim1.shutterfly.com/ng/services/mediarender/THISLIFE/021036514417/media/23148907086/small/1501685404/enhance"
                     alt="admin">
              </div>
              <div class="ms-3">
                <h3 class="fs-5 mb-1">Joge Lucky</h3>
                <p class="mb-0">Lorem ipsum dolor sit amet consectetur elit.</p>
              </div>
            </div>
            <div class="admin d-flex align-items-center rounded-2 p-3">
              <div class="img">
                <img class="img-fluid rounded-pill"
                     width="75" height="75"
                     src="https://uniim1.shutterfly.com/ng/services/mediarender/THISLIFE/021036514417/media/23148907008/medium/1501685726/enhance"
                     alt="admin">
              </div>
              <div class="ms-3">
                <h3 class="fs-5 mb-1">Joge Lucky</h3>
                <p class="mb-0">Lorem ipsum dolor sit amet consectetur elit.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="statis mt-4 text-center">
      <div class="row">
        <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
          <div class="box bg-primary p-3">
            <i class="uil-eye"></i>
            <h3>5,154</h3>
            <p class="lead">Page views</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
          <div class="box bg-danger p-3">
            <i class="uil-user"></i>
            <h3>245</h3>
            <p class="lead">User registered</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
          <div class="box bg-warning p-3">
            <i class="uil-shopping-cart"></i>
            <h3>5,154</h3>
            <p class="lead">Product sales</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="box bg-success p-3">
            <i class="uil-feedback"></i>
            <h3>5,154</h3>
            <p class="lead">Transactions</p>
          </div>
        </div>
      </div>
    </section>
  </div>
</section>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.jshttps://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script>
  <script  src="./script.js"></script>
  <script>
    
// Global defaults
Chart.defaults.global.animation.duration = 2000; // Animation duration
Chart.defaults.global.title.display = false; // Remove title
Chart.defaults.global.defaultFontColor = '#71748c'; // Font color
Chart.defaults.global.defaultFontSize = 13; // Font size for every label

// Tooltip global resets
Chart.defaults.global.tooltips.backgroundColor = '#111827'
Chart.defaults.global.tooltips.borderColor = 'blue'

// Gridlines global resets
Chart.defaults.scale.gridLines.zeroLineColor = '#3b3d56'
Chart.defaults.scale.gridLines.color = '#3b3d56'
Chart.defaults.scale.gridLines.drawBorder = false

// Legend global resets
Chart.defaults.global.legend.labels.padding = 0;
Chart.defaults.global.legend.display = false;

// Ticks global resets
Chart.defaults.scale.ticks.fontSize = 12
Chart.defaults.scale.ticks.fontColor = '#71748c'
Chart.defaults.scale.ticks.beginAtZero = false
Chart.defaults.scale.ticks.padding = 10

// Elements globals
Chart.defaults.global.elements.point.radius = 0

// Responsivess
Chart.defaults.global.responsive = true
Chart.defaults.global.maintainAspectRatio = false

// The bar chart
var myChart = new Chart(document.getElementById('myChart'), {
  type: 'bar',
  data: {
    labels: ["Kresek", "Plastik", "Karah Warna", "Botol mineral plastik", "Botol mineral kaca", "Gelas mineral plastik", "Kaleng", "Kardus/Karton", "Dedaunan", "Sampah hasil masak", "Besi", "Baja", "Tembaga", "Aluminium", "Zeng", "Kain", "Sandal dan Sepatu", "Lampu"],
    datasets: [{
      label: "Jumlah Stock",
      data: [<?php while ($p = mysqli_fetch_array($stock2)) { echo '"' . $p['stock'] . '",';}?>],
      backgroundColor: "#0d6efd",
      borderColor: 'transparent',
      borderWidth: 2.5,
      barPercentage: 0.8,
    }]
  },
  options: {
    scales: {
      yAxes: [{
        gridLines: {},
        ticks: {
          stepSize: 15,
        },
      }],
      xAxes: [{
        gridLines: {
          display: false,
        }
      }]
    }
  }
})

  </script>
</body>
</html>
