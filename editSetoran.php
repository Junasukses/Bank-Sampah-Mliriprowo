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
$id = $_GET["idSetoran"];
$setor = query("SELECT * FROM setoran WHERE idSetor = '$id'")[0];
$idu = $setor['idUser'];
$users = query("SELECT * FROM users WHERE idUser = '$idu'")[0];
$ids = $setor['idSampah'];
$sampah = query("SELECT * FROM sampah WHERE idSampah = '$ids'")[0];

if (isset($_POST["submit"]) ){

	
	if (editSetoranBerat($_POST) > 0 ) {
        if (editSetoranHarga($_POST) > 0 ) {
            if (editSetoran($_POST) > 0 ) {
                echo "
                <script>
                    alert('Setoran Berhasil Diedit');
                    document.location.href = 'setoranAdmin.php';
                </script>
            ";
            }else {
                echo "	
                    <script>
                        alert('Setoran Gagal Diedit!');
                        document.location.href = 'setoranAdmin.php';
                    </script>
                ";
            }
        
            
        }
            
    } 
    
}

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Edit Setoran</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/manual/styletambahsampah.css">
    <link rel="stylesheet" href="css/manual/stylelogin.css">
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
					<a href="beritaAdmin.php"><span class="far fa-newspaper" aria-hidden="true"></span>Data Berita</a>
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
            <h2 style="font-size: 30px; color: #262626;">Tambah Setoran</h2>
            <div class="card">
            <div class="card-body">
            <form action="" method="post" class="mt-3" enctype="multipart/form-data">
                <label for="penyetor">Nama Penyetor :</label><br>
                <select name="penyetor" id="penyetor" required="required" class="form-order">
                        <option value="">
                            <?php echo $users["namaUser"]; ?>
                        </option>
                    <?php  
                        $no = mysqli_query($conn, "SELECT * FROM users");
                        $jumlahData = mysqli_num_rows($no);
                    ?>
                    <?php for ($i = 0; $i < $jumlahData; $i++) { ?>
                        <?php   $namapenyetor = query("SELECT namaUser FROM users")[$i]; ?>
                        <?php foreach ( $namapenyetor as $nmp)  : ?>
                        <option value="<?php echo $nmp; ?>">
                            <?php echo $nmp; ?>
                        </option>
                        <?php endforeach; ?>
                    <?php } ?>			
                </select><br>

                <label for="sampah">Nama Sampah :</label><br>
                <select name="sampah" id="sampah" required="required" class="form-order">
                        <option value="">
                            <?php echo $sampah["namaSampah"]; ?>
                        </option>
                    <?php  
                        $no = mysqli_query($conn, "SELECT * FROM sampah");
                        $jumlahData = mysqli_num_rows($no);
                    ?>
                    <?php for ($i = 0; $i < $jumlahData; $i++) { ?>
                        <?php   $namasampah = query("SELECT namaSampah FROM sampah")[$i]; ?>
                        <?php foreach ( $namasampah as $ns)  : ?>
                        <option value="<?php echo $ns; ?>">
                            <?php echo $ns; ?>
                        </option>
                        <?php endforeach; ?>
                    <?php } ?>			
                </select><br>

                <label for="tanggal">Tanggal Setoran :</label>
                <input type="date" name="tanggal" id="tanggal" required="required" class="form-order" value="<?php echo $setor["tglSetor"]; ?>"><br>

                <label for="berat">Berat :</label>
                <input type="text" name="berat" id="berat" required="required" class="form-order" value="<?php echo $setor["berat"]; ?>"><br>

                <button type="submit" name="submit" class="btn-regist btn-primary mt-3 me-2 ms-1" style="width: 100%;">SUBMIT</button>
               
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