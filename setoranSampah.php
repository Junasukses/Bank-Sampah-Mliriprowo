<?php 
require 'functions.php';
$setoran = query("SELECT * FROM setoran ORDER BY idSetor ASC");

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Setoran Sampah</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/style-enfold.css">
    <link rel="stylesheet" type="text/css" href="css/style-schedule.css">
    <link rel="stylesheet" href="css/manual/style.css">
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
      <img src="img/aset/spiner.gif" width="80">
    </div>
  </div>

  <!--Navbar-->
  <hr class="bg-danger fw-bold fixed-top" style="height: 13px; margin: top 15px;">
    <nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="img/logo/logo.png" alt="" style="width:130px; height: auto; object-fit: contain;"></a>
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
                <li><a class="dropdown-item text-white" href="registrasi.php"><i class="fas fa-registered"></i> Registration</a></li>
                <li><a class="dropdown-item text-white" href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
              </ul>
            </li>
                <!-- <a class="nav-link active text-white" aria-current="page" href="#">Beranda</a> -->
            </li>
        </ul>
        </div>
    </div>
    </nav>
    <!--konten2-->
    <div class="container-about">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h3 class="title-un" style="margin-top: 90px;">JADWAL HARIAN SETORAN SAMPAH</h3>
                  <div class="title-un-icon"><i class="fas fa-calendar-alt"></i></div>
                  <p class="title-un-des">Berikut merupakan jenis sampah yang dapat disetorkan berdasarkan harinya, jadwal penyetoran dapat dilakukan pada hari senin - sabtu (hari minggu libur).<!-- <div class="blockquote-footer text-center" style="margin-top: -45px; font-weight: bold;">Catatan: Diharapkan menyetorkan jenis sampah sesuai dengan hari yang telah ditentukan.</div> --></p>
                  <!-- start css -->
                  <div id="generic_price_table">   
                      <section>
                        <div class="container">
                          <div class="row">
                            <!-- start tabel -->
                            <div class="col-md-4">
                              <div class="generic_content active clearfix">
                                  <div class="generic_head_price clearfix">
                                      <div class="generic_head_content clearfix">
                                        <div class="head_bg"></div>
                                        <div class="head">
                                            <span>SENIN</span>
                                        </div>
                                      </div>
                                  </div>                            
                                  <div class="generic_feature_list">
                                      <ul>
                                          <li><span>Sampah Hasil Masak</span></li>
                                          <li><span>Dedaunan</span></li>
                                          <li><span>Kresek</span></li>
                                          <li><span>Plastik</span></li>
                                      </ul>
                                  </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="generic_content active clearfix">
                                  <div class="generic_head_price clearfix">
                                      <div class="generic_head_content clearfix">
                                        <div class="head_bg"></div>
                                        <div class="head">
                                            <span>SELASA</span>
                                        </div>
                                      </div>
                                  </div>                            
                                  <div class="generic_feature_list">
                                      <ul>
                                          <li><span>Sampah Hasil Masak</span></li>
                                          <li><span>Botol Mineral Plastik</span></li>
                                          <li><span>Botol Mineral Kaca</span></li>
                                          <li><span>Sepatu/Sandal</span></li>
                                      </ul>
                                  </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="generic_content active clearfix">
                                  <div class="generic_head_price clearfix">
                                      <div class="generic_head_content clearfix">
                                        <div class="head_bg"></div>
                                        <div class="head">
                                            <span>RABU</span>
                                        </div>
                                      </div>
                                  </div>                            
                                  <div class="generic_feature_list">
                                      <ul>
                                          <li><span>Sampah Hasil Masak</span></li>
                                          <li><span>Dedaunan</span></li>
                                          <li><span>Gelas Mineral Plastik</span></li>
                                          <li><span>Karah Warna</span></li>
                                      </ul>
                                  </div>
                              </div>
                            </div>
                          <div class="col-md-4">
                              <div class="generic_content jarak active clearfix">
                                  <div class="generic_head_price clearfix">
                                      <div class="generic_head_content clearfix">
                                        <div class="head_bg"></div>
                                        <div class="head">
                                            <span>KAMIS</span>
                                        </div>
                                      </div>
                                  </div>                            
                                  <div class="generic_feature_list">
                                      <ul>
                                          <li><span>Sampah Hasil Masak</span></li>
                                          <li><span>Keleng</span></li>
                                          <li><span>Kardus/Karton</span></li>
                                          <li><span>Kain</span></li>
                                      </ul>
                                  </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="generic_content jarak active clearfix">
                                  <div class="generic_head_price clearfix">
                                      <div class="generic_head_content clearfix">
                                        <div class="head_bg"></div>
                                        <div class="head">
                                            <span>JUMAT</span>
                                        </div>
                                      </div>
                                  </div>                            
                                  <div class="generic_feature_list">
                                      <ul>
                                          <li><span>Sampah Hasil Masak</span></li>
                                          <li><span>Dedaunan</span></li>
                                          <li><span>Besi</span></li>
                                          <li><span>Baja</span></li>
                                      </ul>
                                  </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="generic_content jarak active clearfix">
                                  <div class="generic_head_price clearfix">
                                      <div class="generic_head_content clearfix">
                                        <div class="head_bg"></div>
                                        <div class="head">
                                            <span>SABTU</span>
                                        </div>
                                      </div>
                                  </div>                            
                                  <div class="generic_feature_list">
                                      <ul>
                                          <li><span>Sampah Hasil Masak</span></li>
                                          <li><span>Zeng</span></li>
                                          <li><span>Aluminium</span></li>
                                          <li><span>Tembaga</span></li>
                                      </ul>
                                  </div>
                              </div>
                            </div>
                            <!-- end tabel  -->
                          </div>  
                        </div>
                      </section>             
                  </div>
                  <!-- end css table -->
                </div>
            </div>
          </div>
    </div>
    <div class="container-newsletter">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h3 class="title-un">RINCIAN SETORAN SAMPAH</h3>
                  <div class="title-un-icon"><i class="fas fa-book"></i></div>
                  <p class="title-un-des" style="text-align: center;">Berikut adalah rincian dari setoran penggona</p>
                    <table id="example" class="display" cellspacing="0" width="100%" border="0" >
                      <thead>
                      <tr>
                          <th>No</th>
                          <th>Tanggal Setoran</th>
                          <th>Nama Penyetor</th>
                          <th>Nama Sampah</th>
                          <th>Berat</th>
                          <th>Harga/KG</th>
                          <th>Total</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php $i = 1; ?>
                      <?php foreach ( $setoran as $row)  : ?>
                      <?php $kode = $row["idUser"] ?>
                      <?php $namaUser = query("SELECT namaUser FROM users WHERE idUser = '$kode' "); ?>
                      <?php $kode2 = $row["idSampah"] ?>
                      <?php $namaSampah = query("SELECT namaSampah,harga FROM sampah WHERE idSampah = '$kode2' "); ?>
                      <tr align="center">
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row['tglSetor'] ?></td>
                          <?php foreach ( $namaUser as $user)  : ?>
                          <td><?php echo $user['namaUser']; ?></td>
                          <?php endforeach; ?>
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
            </div>
          </div>
      </div>

    <!--footer-->
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