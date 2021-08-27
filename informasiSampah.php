<?php 
require 'functions.php';
$jumlahBeritaPerhalaman = 3;
$jumlahBerita = count(query("SELECT * FROM berita"));
$jumlahHalaman = ceil($jumlahBerita / $jumlahBeritaPerhalaman);
$halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awalBerita = ( $jumlahBeritaPerhalaman * $halamanAktif ) - $jumlahBeritaPerhalaman;
$halamanAktif = intval($halamanAktif);

$postingan = query("SELECT * FROM berita ORDER BY idBerita LIMIT $awalBerita, $jumlahBeritaPerhalaman");
?>


<!doctype html>
<html lang="en">
  <head>
    <title>Informasi Sampah</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/manual/style.css">
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
      <img src="img/aset/spiner.gif" width="80">
    </div>
  </div>

  <!--Navbar-->
  <hr class="bg-danger fw-bold fixed-top" style="height: 13px; margin: top 15px;">
    <nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="img/logo/logo.png" alt="" style="width:130px;"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto fw-bold fs-5">
            <li class="nav-item">
                <a class="nav-link active text-white" aria-current="page" href="index.php"><i class="fas fa-home"></i> Beranda</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active text-white" aria-current="page" href="informasiSampah.php"><i class="fas fa-info-circle"></i> Informasi Sampah</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active text-white" aria-current="page" href="setoranSampah.php"><i class="fas fa-trash-restore-alt"></i> Setoran Sampah</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle active text-white" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user-circle"></i> Account
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                <li><a class="dropdown-item text-white" href="registrasi.php" target="_blank"><i class="fas fa-registered"></i> Registration</a></li>
                <li><a class="dropdown-item text-white" href="login.php" target="_blank"><i class="fas fa-sign-in-alt"></i> Login</a></li>
              </ul>
            </li>
                <!-- <a class="nav-link active text-white" aria-current="page" href="#">Beranda</a> -->
            </li>
        </ul>
        </div>
    </div>
    </nav>

    <br><br><br><br><br>

    <div class="row mx-5 px-5 text-center">
    <h1> <b> INFORMASI TERKAIT SAMPAH </b></h1>
    <hr style="width:75%; height: 5px;" class="mx-auto bg-primary">
    <!-- Blog Entries Column -->
        <?php foreach ($postingan as $row) : ?>
        <div class="card my-4">
            <img class="card-img-top" style="display: block;margin-left: auto;margin-right: auto;width: 10%;" src="img/berita/<?= $row['gambar'] ?>" alt="<?= $row['judul']; ?>">
              <div class="card-body">
                <h2 class="card-title"><?= $row['judul']; ?></h2>
                <p>
                      <?php 
                        $a = $row['isi'];
                        // echo $a;
                        if (strlen($a) > 250) {
                            echo substr($a, 0, 250), " (...)";
                        } else {
                            echo $a;
                        }
                    ?>
                </p>
                <a href="<?= $row['sumber']; ?>/" target="_blank" class="btn btn-primary">Read More &rarr;</a>
              </div>
        </div>
        <?php endforeach; ?>

        <!-- bagian pagination -->
        <div class="pagination" style="margin-left: 45%;">
            <?php if($halamanAktif != 1){ 
                $a = $halamanAktif -1;
                echo "<a class='page-link' href='?halaman=$a'>Previous</a>";
            } ?>
            
            <?php for( $i = 1; $i <= $jumlahHalaman; $i++ ) : 
            // var_dump($i);
                ?>

                <?php if($halamanAktif != $i) : ?>
                    <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                <?php else : ?>

                    <a class="page-link bg-primary text-white" href="?halaman=<?= $i; ?>" ><?= $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if($halamanAktif < $jumlahHalaman){ 
                $a = $halamanAktif +1;
                echo "<a class='page-link' href='?halaman=$a'>Next</a>";
            } ?>
        </div>
      
      </div>
      
      

    <!--footer-->
    <br>
    <footer class="footer-distributed">

      <div class="footer-left">
        
        <div class="logo">
          <img src="img/logo/kementrian.png" alt="" style="width: 125px;">
          <img src="img/logo/logo.png" alt="" style="width: 225px;">
        </div>

        <br>

        <p class="footer-company-about">
          <span>Kementerian Lingkungan Hidup dan Kehutanan <br>
                Direktorat Jenderal Pengelolaan Sampah, Limbah dan B3 <br>
                Direktorat Pengelolaan Sampah
          </span>
        </p>
        <h3>BANK SAMPAH MLIRIPROWO</h3>

      </div>

      <div class="footer-center">

        <div>
          <i class="fa fa-map-marker"></i>
          <p><span>Dusun Pilang</span> Mliriprowo, Tarik, Kabupaten Sidoarjo.</p>
        </div>

        <div>
          <i class="fa fa-phone"></i>
          <p><a href="sms:(+62)85749469501">(+62)85749469501</a></p>
        </div>

        <div>
          <i class="fa fa-envelope"></i>
          <p><a href="mailto:bank_mliriprowo@gmail.com">bank_mliriprowo@gmail.com</a></p>
        </div>

      </div>

      <div class="footer-right">

        <p class="footer-company-about">
          <span>Kunjungi Sosial Media Kami!</span>
          Untuk yang ingin lebih dekat dengan Bank Sampah Mliriprowo, silahkan kunjungi sosial media kami dibawah ini!
        </p>

        <div class="footer-icons">
          <a href="#" target="_blank"><i class="fab fa-instagram-square"></i></a>
          <a href="#" target="_blank"><i class="fab fa-facebook-square"></i></a>
          <a href="#" target="_blank"><i class="fab fa-twitter-square"></i></a>
        </div>
      </div>

    </footer>
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