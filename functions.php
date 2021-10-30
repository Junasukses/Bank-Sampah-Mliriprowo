<?php 
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "bank_mliriprowo");

function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	return $rows;
}

function registrasi($data){
	global $conn;

    $no = mysqli_query($conn, "SELECT * FROM users");
    $jumlahData = mysqli_num_rows($no);
    $hitung = $jumlahData + 1;

    if(strlen($hitung) == 1){
        $format = "USR"."00".$hitung;
    }else if (strlen($hitung) == 2) {
        $format = "USR"."0".$hitung;
    }else{
        $format = "USR".$hitung;
    }

	$namalengkap = (stripslashes($data["nama"]));
    $nik = (stripslashes($data["nik"]));
    $alamat = (stripslashes($data["alamat"]));
    $telepon = (stripslashes($data["telepon"]));
    $username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $jmlSetoran = $_POST['jmlSetoran'];
	$jmlPenarikan = 0;
    $saldo = $_POST['saldo'];

	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT idUser FROM users WHERE idUser = '$format'");

	if ( mysqli_fetch_assoc($result) ){
		echo "<script>
				alert('Akun anda sudah terdaftar!');
				</script>";
		return false;
	}

	// untuk mengatasi username kosong
	if (empty(trim($username))){
		echo "<script>
				alert('Dimohon untuk mengisi username');
				</script>";
		return false;
	}

	// cek konfirmasi password
	if ( $password !== $password2 ) {
		echo "<script>
				alert ('Konfirmasi password tidak sesuai!');
			</script>";
		return false;
	}

	// tambahkan user baru ke database
	mysqli_query($conn, "INSERT INTO users VALUES('$format', '$namalengkap', '$nik', '$alamat', '$telepon', '$username', '$password', '$jmlSetoran', '$jmlPenarikan', '$saldo')");
	
	return mysqli_affected_rows($conn);
}

 function tambahbio ($data){
	global $conn;
	$id = $_SESSION['id'];
	$nama = htmlspecialchars( $data["nama"]);
	$email = htmlspecialchars($data["email"]);
	$birthday = htmlspecialchars($data["birthday"]);
	$alamat = htmlspecialchars($data["alamat"]);

$query = "INSERT INTO biodata_users
		   VALUES
	   ('$id', '$nama', '$email', '$birthday', '$alamat', 'Silver')
	   ";
mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function tambahpenarikan($data){
	global $conn;

	$no = mysqli_query($conn, "SELECT * FROM penarikan");
    $jumlahData = mysqli_num_rows($no);
    $hitung = $jumlahData + 1;

    if(strlen($hitung) == 1){
        $format = "TRK"."00".$hitung;
    }else if (strlen($hitung) == 2) {
        $format = "TRK"."0".$hitung;
    }else{
        $format = "TRK".$hitung;
    }

	$penarik = (stripslashes($data["penarik"]));
	$ambildatauser = mysqli_query($conn, "SELECT * FROM users WHERE namaUser = '$penarik'");
	$id1 = mysqli_fetch_array($ambildatauser);
    $tanggal = (stripslashes($data["tanggal"]));
    $saldoPenarikan = (stripslashes($data["saldoPenarikan"]));

	$idUser = $id1['idUser'];
	$namaUser = $id1['namaUser'];
	$saldoUser = $id1['saldo'];

	$totalDataBank = mysqli_query($conn, "SELECT * FROM saldo_bank ORDER BY idTransaksi DESC LIMIT 1");
	$ambilSaldo = mysqli_fetch_array($totalDataBank);
	$totalSaldo = $ambilSaldo['totalSaldo'];
	if ($saldoPenarikan > $totalSaldo) {
		return 0;
	} elseif($saldoPenarikan > $saldoUser) {
		return 0;
	} else {
		$query = "INSERT INTO penarikan
		   VALUES
	   ('$format', '$idUser', '$namaUser', '$tanggal', '$saldoPenarikan')
	   ";
	   mysqli_query($conn, $query);
	   return mysqli_affected_rows($conn);
	}

}

function updateUsers2($data){
	global $conn;

	$penarik = (stripslashes($data["penarik"]));
	$ambildatauser = mysqli_query($conn, "SELECT * FROM users WHERE namaUser = '$penarik'");
	$id1 = mysqli_fetch_array($ambildatauser);
    $tanggal = (stripslashes($data["tanggal"]));
    $saldoPenarikan = (stripslashes($data["saldoPenarikan"]));

	$idUser = $id1['idUser'];
	$namaUser = $id1['namaUser'];

	$jmlPenarikan = $id1['jmlPenarikan'] + 1;
	$saldo = $id1['saldo'] - $saldoPenarikan;
	

$query ="UPDATE users SET 
			jmlPenarikan = '$jmlPenarikan',
			saldo = '$saldo'
		WHERE idUser = '$idUser'
		";
mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function tambahpenjualan($data){
	global $conn;

	$no = mysqli_query($conn, "SELECT * FROM penjualan");
    $jumlahData = mysqli_num_rows($no);
    $hitung = $jumlahData + 1;

    if(strlen($hitung) == 1){
        $format = "JUL"."00".$hitung;
    }else if (strlen($hitung) == 2) {
        $format = "JUL"."0".$hitung;
    }else{
        $format = "JUL".$hitung;
    }

    $sampah = (stripslashes($data["sampah"]));
	$ambildatasampah = mysqli_query($conn, "SELECT * FROM sampah WHERE namaSampah = '$sampah'");
	$id2 = mysqli_fetch_array($ambildatasampah);
	$idSampah = $id2['idSampah'];

	$berat = (stripslashes($data["berat"]));

    $tanggal = (stripslashes($data["tanggal"]));

	$namaPembeli = (stripslashes($data["nama"]));
	
    $nomorPembeli = (stripslashes($data["nomor"]));
    
	$harga = (stripslashes($data["harga"]));

	$totalPendapatan = $berat * $harga;
	

$query = "INSERT INTO penjualan
		   VALUES
	   ('$format', '$idSampah', '$berat', '$tanggal', '$namaPembeli', '$nomorPembeli', '$harga', '$totalPendapatan')
	   ";
mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function tambahsaldo($data){
	global $conn;

	$no = mysqli_query($conn, "SELECT * FROM saldo_bank");
    $jumlahData = mysqli_num_rows($no);
    $hitung = $jumlahData + 1;
	$hitung2 = $jumlahData;

    if(strlen($hitung) == 1){
        $format = "SLD"."00".$hitung;
    }else if (strlen($hitung) == 2) {
        $format = "SLD"."0".$hitung;
    }else{
        $format = "SLD".$hitung;
    }

	if(strlen($hitung2) == 1){
        $kodeformat = "SLD"."00".$hitung2;
    }else if (strlen($hitung2) == 2) {
        $kodeformat = "SLD"."0".$hitung2;
    }else{
        $kodeformat = "SLD".$hitung2;
    }

    $aksi = ("Penambahan");

	$tanggal = (stripslashes($data["tanggal"]));

	$aktor = ("ADM001");

	$berat = (stripslashes($data["berat"]));
    
	$harga = (stripslashes($data["harga"]));

	$jumlah = $berat * $harga;

	$ambildatasaldo = mysqli_query($conn, "SELECT * FROM saldo_bank WHERE idTransaksi = '$kodeformat'");
	$id1 = mysqli_fetch_array($ambildatasaldo);
	$totalSaldo = $jumlah + $id1['totalSaldo'];
	

$query = "INSERT INTO saldo_bank
		   VALUES
	   ('$format', 'Penambahan', '$tanggal', '$aktor', '$jumlah', '$totalSaldo')
	   ";
mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function pengurangansaldo($data){
	global $conn;

	$no = mysqli_query($conn, "SELECT * FROM saldo_bank");
    $jumlahData = mysqli_num_rows($no);
    $hitung = $jumlahData + 1;
	$hitung2 = $jumlahData;

    if(strlen($hitung) == 1){
        $format = "SLD"."00".$hitung;
    }else if (strlen($hitung) == 2) {
        $format = "SLD"."0".$hitung;
    }else{
        $format = "SLD".$hitung;
    }

	if(strlen($hitung2) == 1){
        $kodeformat = "SLD"."00".$hitung2;
    }else if (strlen($hitung2) == 2) {
        $kodeformat = "SLD"."0".$hitung2;
    }else{
        $kodeformat = "SLD".$hitung2;
    }

    $aksi = ("Pengurangan");

	$tanggal = (stripslashes($data["tanggal"]));

	$penarik = (stripslashes($data["penarik"]));
	$ambildatauser = mysqli_query($conn, "SELECT * FROM users WHERE namaUser = '$penarik'");
	$id1 = mysqli_fetch_array($ambildatauser);
	$idUser = $id1['idUser'];

	$saldoPenarikan = (stripslashes($data["saldoPenarikan"]));

	$ambildatasaldo = mysqli_query($conn, "SELECT * FROM saldo_bank WHERE idTransaksi = '$kodeformat'");
	$id2 = mysqli_fetch_array($ambildatasaldo);
	$totalSaldo = $id2['totalSaldo'] - $saldoPenarikan;
	

$query = "INSERT INTO saldo_bank
		   VALUES
	   ('$format', 'Pengurangan', '$tanggal', '$idUser', '$saldoPenarikan', '$totalSaldo')
	   ";
mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function penguranganstock($data){
	global $conn;

	$sampah = (stripslashes($data["sampah"]));
	$ambildatasampah = mysqli_query($conn, "SELECT * FROM stock_sampah WHERE namaSampah = '$sampah'");
	$id2 = mysqli_fetch_array($ambildatasampah);
    $namaSampah = $id2['namaSampah'];
    $berat = (stripslashes($data["berat"]));
	$updatestock = $id2['stock'] - $berat;

$query ="UPDATE stock_sampah SET 
		stock = '$updatestock'
	WHERE namaSampah = '$namaSampah'
	";
mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function tambahsetoran($data){
	global $conn;

	$no = mysqli_query($conn, "SELECT * FROM setoran");
    $jumlahData = mysqli_num_rows($no);
    $hitung = $jumlahData + 1;

    if(strlen($hitung) == 1){
        $format = "STR"."00".$hitung;
    }else if (strlen($hitung) == 2) {
        $format = "STR"."0".$hitung;
    }else{
        $format = "STR".$hitung;
    }

	$penyetor = (stripslashes($data["penyetor"]));
	$ambildatauser = mysqli_query($conn, "SELECT * FROM users WHERE namaUser = '$penyetor'");
	$id1 = mysqli_fetch_array($ambildatauser);
    $sampah = (stripslashes($data["sampah"]));
	$ambildatasampah = mysqli_query($conn, "SELECT * FROM sampah WHERE namaSampah = '$sampah'");
	$id2 = mysqli_fetch_array($ambildatasampah);
    $tanggal = (stripslashes($data["tanggal"]));
    $berat = (stripslashes($data["berat"]));
	$ambilhargasampah = mysqli_query($conn, "SELECT * FROM sampah WHERE namaSampah = '$sampah'");
	$id3 = mysqli_fetch_array($ambilhargasampah);

	$idUser = $id1['idUser'];
	$idSampah = $id2['idSampah'];
	$harga = $id3['harga'];
	$total = $berat * $harga;
	

$query = "INSERT INTO setoran
		   VALUES
	   ('$format', '$idUser', '$idSampah', '$tanggal', '$berat', '$total')
	   ";
mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function updatestock($data){
	global $conn;

    $sampah = (stripslashes($data["sampah"]));
	$ambildatasampah = mysqli_query($conn, "SELECT * FROM stock_sampah WHERE namaSampah = '$sampah'");
	$id2 = mysqli_fetch_array($ambildatasampah);
    $namaSampah = $id2['namaSampah'];
    $berat = (stripslashes($data["berat"]));
	$updatestock = $berat + $id2['stock'];

$query ="UPDATE stock_sampah SET 
		stock = '$updatestock'
	WHERE namaSampah = '$namaSampah'
	";
mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function tambahstock($data){
	global $conn;

	$no = mysqli_query($conn, "SELECT * FROM stock_sampah");
    $jumlahData = mysqli_num_rows($no);
    $hitung = $jumlahData + 1;

    if(strlen($hitung) == 1){
        $format = "STK"."00".$hitung;
    }else if (strlen($hitung) == 2) {
        $format = "STK"."0".$hitung;
    }else{
        $format = "STK".$hitung;
    }

    $nama = (stripslashes($data["namaSampah"]));
	$ambildatasampah = mysqli_query($conn, "SELECT * FROM sampah WHERE namaSampah = '$nama'");
	$id2 = mysqli_fetch_array($ambildatasampah);
	$namaSampah = $id2['namaSampah'];
    $stock = 0;

$query = "INSERT INTO stock_sampah
		   VALUES
	   ('$format', '$namaSampah', '$stock')
	   ";
mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function updateUsers($data){
	global $conn;

	$penyetor = (stripslashes($data["penyetor"]));
	$ambildatauser = mysqli_query($conn, "SELECT * FROM users WHERE namaUser = '$penyetor'");
	$id1 = mysqli_fetch_array($ambildatauser);
    $sampah = (stripslashes($data["sampah"]));
	$ambildatasampah = mysqli_query($conn, "SELECT * FROM sampah WHERE namaSampah = '$sampah'");
	$id2 = mysqli_fetch_array($ambildatasampah);
    $tanggal = (stripslashes($data["tanggal"]));
    $berat = (stripslashes($data["berat"]));
	$ambilhargasampah = mysqli_query($conn, "SELECT * FROM sampah WHERE namaSampah = '$sampah'");
	$id3 = mysqli_fetch_array($ambilhargasampah);

	$idUser = $id1['idUser'];
	$idSampah = $id2['idSampah'];
	$harga = $id3['harga'];
	$total = $berat * $harga;
	$jmlSetoran = $id1['jmlSetoran'] + 1;
	$saldo = $id1['saldo'] + $total;
	

$query ="UPDATE users SET 
			jmlSetoran = '$jmlSetoran',
			saldo = '$saldo'
		WHERE idUser = '$idUser'
		";
mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function tambahsampah($data){
	global $conn;

	$no = mysqli_query($conn, "SELECT * FROM sampah");
    $jumlahData = mysqli_num_rows($no);
    $hitung = $jumlahData + 1;

    if(strlen($hitung) == 1){
        $format = "SMP"."00".$hitung;
    }else if (strlen($hitung) == 2) {
        $format = "SMP"."0".$hitung;
    }else{
        $format = "SMP".$hitung;
    }

	$jenisSampah = (stripslashes($data["jenisSampah"]));
    $nama = (stripslashes($data["namaSampah"]));
    $satuan = (stripslashes($data["satuan"]));
    $harga = (stripslashes($data["harga"]));
	$gambar = upload();
	if (!$gambar){
		return false;
	}
	$keterangan = (stripslashes($data["keterangan"]));

$query = "INSERT INTO sampah
		   VALUES
	   ('$format', '$jenisSampah', '$nama', '$satuan', '$harga', '$gambar', '$keterangan')
	   ";
mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function upload(){

	$namaFile = $_FILES['foto']['name'];
	$ukuranFile = $_FILES['foto']['size'];
	$error = $_FILES['foto']['error'];
	$tmpName = $_FILES['foto']['tmp_name'];

	//cek apakah tidak ada gambar yang diupload
	if ($error == 4){
		echo "<script>
				alert('Pilih gambar terlebih dahulu!');
			  </script>";
		return false;
	}

	//cek apakah yang diupload gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'jfif'];
	$ekstensigambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensigambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid) ) {
 		echo "<script>
 				alert('Yang anda upload bukan gambar!');
 			  </script>";
 		return false;
 	}

	//cek jika ukurannya terlalu besar
	if ($ukuranFile > 2000000) {
		echo "<script>
				alert('Ukuran gambar terlaliu besar!');
			  </script>";
		return false;
	}

	//lolos penngecekan gambar, siap diupload
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;
	move_uploaded_file($tmpName, 'img/sampah/' . $namaFileBaru);
	return $namaFileBaru;

}

function tambahberita($data){
	global $conn;

	$no = mysqli_query($conn, "SELECT * FROM berita");
    $jumlahData = mysqli_num_rows($no);
    $hitung = $jumlahData + 1;

    if(strlen($hitung) == 1){
        $format = "BRT"."00".$hitung;
    }else if (strlen($hitung) == 2) {
        $format = "BRT"."0".$hitung;
    }else{
        $format = "BRT".$hitung;
    }

	$judul = (stripslashes($data["judul"]));
    $isi = (stripslashes($data["isi"]));
    $sumber = (stripslashes($data["sumber"]));
	$gambar = uploadberita();
	if (!$gambar){
		return false;
	}

$query = "INSERT INTO berita
		   VALUES
	   ('$format', '$judul', '$isi', '$gambar', '$sumber')
	   ";
mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function uploadberita(){

	$namaFile = $_FILES['foto']['name'];
	$ukuranFile = $_FILES['foto']['size'];
	$error = $_FILES['foto']['error'];
	$tmpName = $_FILES['foto']['tmp_name'];

	//cek apakah tidak ada gambar yang diupload
	if ($error == 4){
		echo "<script>
				alert('Pilih gambar terlebih dahulu!');
			  </script>";
		return false;
	}

	//cek apakah yang diupload gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'jfif'];
	$ekstensigambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensigambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid) ) {
 		echo "<script>
 				alert('Yang anda upload bukan gambar!');
 			  </script>";
 		return false;
 	}

	//cek jika ukurannya terlalu besar
	if ($ukuranFile > 2000000) {
		echo "<script>
				alert('Ukuran gambar terlaliu besar!');
			  </script>";
		return false;
	}

	//lolos penngecekan gambar, siap diupload
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;
	move_uploaded_file($tmpName, 'img/berita/' . $namaFileBaru);
	return $namaFileBaru;

}

function uploadGambar(){
	$namafile = $_FILES['gambar']['name'];
	$ukuranfile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpname = $_FILES['gambar']['tmp_name'];	

	// cek apaakadah  ada gambar yg di upload
	if ($error === 4){
		echo "<script>
				alert('pilih gambar terlebih dahulu');
				</script>
				";
	}
	// cek apakah yang di uypload gambar
	$ekstensigambarvalid = ['jpg','jpeg','png'];
	$ekstensigambar = explode('.', $namafile);
	$ekstensigambar = strtolower(end($ekstensigambar));
	if (!in_array($ekstensigambar, $ekstensigambarvalid)){
		echo "<script>
				alert('yang anda upload bukan gambar');
				</script>
				";
		return false;
	}

	// cek ukuran gambar 
	if ($ukuranfile > 1000000){
		echo "<script>
				alert('ukuran gambar terlalu besar');
				</script>
				";
		return false;
	}
	// generate nama file
	$namafilebaru = uniqid();
	$namafilebaru .=  '.';
	$namafilebaru .= $ekstensigambar;
	// lolos pengecekan semua
	move_uploaded_file($tmpname, 'img/user/' . $namafilebaru);

	return $namafilebaru;


}

function ubah($data) {

	global $conn;

	$idUser = $_GET["idUser"];
 	$namaUser = htmlspecialchars( $data["nama"]);
	$nik = htmlspecialchars($data["nik"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$telepon = htmlspecialchars($data["telepon"]);
	$username = htmlspecialchars($data["username"]);
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);
	$jmlSetoran = $_POST['jmlSetoran'];
    $saldo = $_POST['saldo'];
	$gambarlama = htmlspecialchars($data["gambarlama"]);
	// cek apakah user milih gambar baru atau tidak
	if($_FILES['gambar']['error']===4){
		$gambar = $gambarlama;
	}else{
		$gambar =  uploadGambar();
	}
	
	if ( $password !== $password2 ) {
		echo "<script>
				alert ('Konfirmasi password tidak sesuai!');
			</script>";
		return false;
	}

	$query ="UPDATE users SET 
				namaUser = '$namaUser',
				gambar = '$gambar',
				nik = '$nik',
				alamat = '$alamat',
				telepon = '$telepon',
				username = '$username',
				passwordUser = '$password',
				jmlSetoran = '$jmlSetoran',
				saldo = '$saldo'
			WHERE idUser = '$idUser'
		";
	mysqli_query($conn, $query);

return mysqli_affected_rows($conn);

}

function ubahAdmin($data) {

	global $conn;

	$idAdmin = $_GET["IdAdmin"];
 	$namaAdmin = htmlspecialchars( $data["nama"]);
	$username = htmlspecialchars($data["username"]);
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	if ( $password !== $password2 ) {
		echo "<script>
				alert ('Konfirmasi password tidak sesuai!');
			</script>";
		return false;
	}

	$query ="UPDATE admins SET 
				namaAdmin = '$namaAdmin',
				usernameAdmin = '$username',
				passwordAdmin = '$password'
			WHERE IdAdmin = '$idAdmin'
		";
	mysqli_query($conn, $query);

return mysqli_affected_rows($conn);

}

function editPengguna($data) {

	global $conn;

	$idUser = $_GET["idUser"];
 	$namaUser = htmlspecialchars( $data["nama"]);
	$nik = htmlspecialchars($data["nik"]);
	$alamat = htmlspecialchars( $data["alamat"]);
	$telepon = htmlspecialchars($data["telepon"]);
	$setoran = htmlspecialchars( $data["setoran"]);
	$saldo = htmlspecialchars($data["saldo"]);

	$query ="UPDATE users SET 
				namaUser = '$namaUser',
				nik = '$nik',
				alamat = '$alamat',
				telepon = '$telepon',
				jmlSetoran = '$setoran',
				saldo = '$saldo'
			WHERE idUser = '$idUser'
		";
	mysqli_query($conn, $query);

return mysqli_affected_rows($conn);

}

function editSampah($data) {

	global $conn;

	$idSampah = $_GET["idSampah"];
 	$jenisSampah = htmlspecialchars( $data["jenisSampah"]);
	$namaSampah = htmlspecialchars($data["namaSampah"]);
	$satuan = htmlspecialchars( $data["satuan"]);
	$harga = htmlspecialchars($data["harga"]);
	$gambar = upload();
	if (!$gambar){
		return false;
	}
	$keterangan = htmlspecialchars($data["keterangan"]);

	$query ="UPDATE sampah SET 
				jenisSampah = '$jenisSampah',
				namasampah = '$namaSampah',
				satuan = '$satuan',
				harga = '$harga',
				gambar = '$gambar',
				deskripsi = '$keterangan'
			WHERE idSampah = '$idSampah'
		";
	mysqli_query($conn, $query);

return mysqli_affected_rows($conn);

}

function editBerita($data) {

	global $conn;

	$idBerita = $_GET["idBerita"];
 	$judul = htmlspecialchars( $data["judul"]);
	$isi = htmlspecialchars($data["isi"]);
	$sumber = htmlspecialchars( $data["sumber"]);
	$gambar = uploadberita();
	if (!$gambar){
		return false;
	}

	$query ="UPDATE berita SET 
				judul = '$judul',
				isi = '$isi',
				gambar = '$gambar',
				sumber = '$sumber'
			WHERE idBerita = '$idBerita'
		";
	mysqli_query($conn, $query);

return mysqli_affected_rows($conn);

}

function editSetoran($data) {

	global $conn;

	$idSetor = $_GET["idSetoran"];
	$penyetor = (stripslashes($data["penyetor"]));
	$ambildatauser = mysqli_query($conn, "SELECT * FROM users WHERE namaUser = '$penyetor'");
	$id1 = mysqli_fetch_array($ambildatauser);
    $sampah = (stripslashes($data["sampah"]));
	$ambildatasampah = mysqli_query($conn, "SELECT * FROM sampah WHERE namaSampah = '$sampah'");
	$id2 = mysqli_fetch_array($ambildatasampah);
    $tanggal = (stripslashes($data["tanggal"]));
    $berat = (stripslashes($data["berat"]));
	$ambilhargasampah = mysqli_query($conn, "SELECT * FROM sampah WHERE namaSampah = '$sampah'");
	$id3 = mysqli_fetch_array($ambilhargasampah);

	$idUser = $id1['idUser'];
	$idSampah = $id2['idSampah'];
	$harga = $id3['harga'];
	$total = $berat * $harga;

	$query ="UPDATE setoran SET 
				idUser = '$idUser',
				idSampah = '$idSampah',
				tglSetor = '$tanggal',
				berat = '$berat',
				total = '$total'
			WHERE idSetor = '$idSetor'
		";
	mysqli_query($conn, $query);

return mysqli_affected_rows($conn);

}

function editSetoranBerat($data) {

	global $conn;

    $idSetor = $_GET["idSetoran"];
	$ambildatasetoran = mysqli_query($conn, "SELECT * FROM setoran WHERE idSetor = '$idSetor'");
	$id1 = mysqli_fetch_array($ambildatasetoran);
	$beratsetoran = $id1['berat'];
	$sampah = (stripslashes($data["sampah"]));
	$ambildatasampah = mysqli_query($conn, "SELECT * FROM stock_sampah WHERE namaSampah = '$sampah'");
	$id2 = mysqli_fetch_array($ambildatasampah);
	$namaSampah = $id2['namaSampah'];
	$stock = $id2['stock'];
    $berat = (stripslashes($data["berat"]));
	if($beratsetoran > $berat) {
		$beratfix = $beratsetoran - $berat;
		$sisaStock = $stock - $beratfix;
	} elseif($beratsetoran < $berat) {
		$beratfix = $berat - $beratsetoran;
		$sisaStock = $stock + $beratfix;
	} elseif($beratsetoran = $berat) {
		$sisaStock = $stock + 0;
	}

	

	$query ="UPDATE stock_sampah SET 
				stock = '$sisaStock'
			WHERE namaSampah = '$namaSampah'
		";
	mysqli_query($conn, $query);

return mysqli_affected_rows($conn);

}

function editSetoranHarga($data) {

	global $conn;

	$idSetor = $_GET["idSetoran"];
	$ambildatasetoran = mysqli_query($conn, "SELECT * FROM setoran WHERE idSetor = '$idSetor'");
	$id5 = mysqli_fetch_array($ambildatasetoran);
	$totalSetor = $id5['total'];
	$penyetor = (stripslashes($data["penyetor"]));
	$ambildatauser = mysqli_query($conn, "SELECT * FROM users WHERE namaUser = '$penyetor'");
	$id1 = mysqli_fetch_array($ambildatauser);
	$idUser = $id1['idUser'];
	$saldoUser = $id1['saldo'];
    $sampah = (stripslashes($data["sampah"]));
	$ambildatasampah = mysqli_query($conn, "SELECT * FROM sampah WHERE namaSampah = '$sampah'");
	$id2 = mysqli_fetch_array($ambildatasampah);
    $berat = (stripslashes($data["berat"]));
	$ambilhargasampah = mysqli_query($conn, "SELECT * FROM sampah WHERE namaSampah = '$sampah'");
	$id3 = mysqli_fetch_array($ambilhargasampah);

	
	$idSampah = $id2['idSampah'];
	$harga = $id3['harga'];
	$total = $berat * $harga;
	if($totalSetor > $total) {
		$totalfix = $totalSetor - $total;
		$sisaSaldo = $saldoUser - $totalfix;
	} elseif($totalSetor < $total) {
		$totalfix = $total - $totalSetor;
		$sisaSaldo = $saldoUser + $totalfix;
	} elseif($totalSetor = $total) {
		$sisaSaldo = $saldoUser + 0;
	}

	$query ="UPDATE users SET 
				saldo = '$sisaSaldo'
			WHERE idUser = '$idUser'
		";
	mysqli_query($conn, $query);

return mysqli_affected_rows($conn);

}

function editPenarikan($data) {

	global $conn;

	$idTarik = $_GET["idPenarikan"];
	$penarik = (stripslashes($data["penarik"]));
	$ambildatauser = mysqli_query($conn, "SELECT * FROM users WHERE namaUser = '$penarik'");
	$id1 = mysqli_fetch_array($ambildatauser);
    $tanggal = (stripslashes($data["tanggal"]));
    $jumlahPenarikan = (stripslashes($data["jmlPenarikan"]));

	$idUser = $id1['idUser'];
	$namaUser = $id1['namaUser'];

	$query ="UPDATE penarikan SET 
				idUser = '$idUser',
				namaUser = '$namaUser',
				tglTarik = '$tanggal',
				jmlPenarikan = '$jumlahPenarikan'
			WHERE idTarik = '$idTarik'
		";
	mysqli_query($conn, $query);

return mysqli_affected_rows($conn);

}

function editPenarikanSaldoUser($data) {

	global $conn;

	$idTarik = $_GET["idPenarikan"];
	$ambildatapenarikan = mysqli_query($conn, "SELECT * FROM penarikan WHERE idTarik = '$idTarik'");
	$id1 = mysqli_fetch_array($ambildatapenarikan);
	$penarikanAwal = $id1['jmlPenarikan'];
	$penarik = (stripslashes($data["penarik"]));
	$ambildatauser = mysqli_query($conn, "SELECT * FROM users WHERE namaUser = '$penarik'");
	$id2 = mysqli_fetch_array($ambildatauser);
	$idUser = $id2['idUser'];
	$saldoUser = $id2['saldo'];
    $jumlahPenarikan = (stripslashes($data["jmlPenarikan"]));

	if($penarikanAwal > $jumlahPenarikan) {
		$totalfix = $penarikanAwal - $jumlahPenarikan;
		$sisaSaldo = $saldoUser + $totalfix;
	} elseif($penarikanAwal < $jumlahPenarikan) {
		$totalfix = $jumlahPenarikan - $penarikanAwal;
		$sisaSaldo = $saldoUser - $totalfix;
	} elseif($penarikanAwal = $jumlahPenarikan) {
		$sisaSaldo = $saldoUser + 0;
	}

	$query ="UPDATE users SET 
				saldo = '$sisaSaldo'
			WHERE idUser = '$idUser'
		";
	mysqli_query($conn, $query);

return mysqli_affected_rows($conn);

}

function editPenarikanSaldoBank($data) {

	global $conn;

	$idTarik = $_GET["idPenarikan"];
	$ambildatapenarikan = mysqli_query($conn, "SELECT * FROM penarikan WHERE idTarik = '$idTarik'");
	$id1 = mysqli_fetch_array($ambildatapenarikan);
	$penarikanAwal = $id1['jmlPenarikan'];
	$penarik = (stripslashes($data["penarik"]));
	$ambildatauser = mysqli_query($conn, "SELECT * FROM users WHERE namaUser = '$penarik'");
	$id2 = mysqli_fetch_array($ambildatauser);
	$idUser = $id2['idUser'];
	$saldoUser = $id2['saldo'];
	$tanggal = (stripslashes($data["tanggal"]));
    $jumlahPenarikan = (stripslashes($data["jmlPenarikan"]));
	$ambildatabank = mysqli_query($conn, "SELECT * FROM saldo_bank WHERE aktor = '$idUser' AND tanggal = '$tanggal'");
	$id3 = mysqli_fetch_array($ambildatabank);
	$saldoBank = $id3['totalSaldo'];

	if($penarikanAwal > $jumlahPenarikan) {
		$totalfix = $penarikanAwal - $jumlahPenarikan;
		$sisaSaldo = $saldoBank + $totalfix;
	} elseif($penarikanAwal < $jumlahPenarikan) {
		$totalfix = $jumlahPenarikan - $penarikanAwal;
		$sisaSaldo = $saldoBank - $totalfix;
	} elseif($penarikanAwal = $jumlahPenarikan) {
		$sisaSaldo = $saldoBank + 0;
	}


	$query ="UPDATE saldo_bank SET 
				jumlah = '$jumlahPenarikan',
				totalSaldo = '$sisaSaldo'
			WHERE aktor = '$idUser' AND tanggal = '$tanggal'
		";
	mysqli_query($conn, $query);

return mysqli_affected_rows($conn);

}

function editPenjualan($data) {

	global $conn;

	$idJual = $_GET["idPenjualan"];
	$sampah = (stripslashes($data["sampah"]));
	$ambildatasampah = mysqli_query($conn, "SELECT * FROM sampah WHERE namaSampah = '$sampah'");
	$id1 = mysqli_fetch_array($ambildatasampah);
	$idSampah = $id1['idSampah'];
	$berat = (stripslashes($data["berat"]));
    $tanggal = (stripslashes($data["tanggal"]));
    $nama = (stripslashes($data["nama"]));
	$nomor = (stripslashes($data["nomor"]));
    $harga = (stripslashes($data["harga"]));
    $totalPendapatan = $berat * $harga;

	

	$query ="UPDATE penjualan SET 
				idSampah = '$idSampah',
				berat = '$berat',
				tglPenjualan = '$tanggal',
				namaPembeli = '$nama',
				nomorPembeli = '$nomor',
				harga = '$harga',
				totalPendapatan = '$totalPendapatan'
			WHERE idJual = '$idJual'
		";
	mysqli_query($conn, $query);

return mysqli_affected_rows($conn);

}

function editPenjualanStock($data) {

	global $conn;

	$idJual = $_GET["idPenjualan"];
	$ambildatapenjualan = mysqli_query($conn, "SELECT * FROM penjualan WHERE idJual = '$idJual'");
	$id1 = mysqli_fetch_array($ambildatapenjualan);
	$beratpenjualan = $id1['berat'];
	$sampah = (stripslashes($data["sampah"]));
	$ambildatasampah = mysqli_query($conn, "SELECT * FROM stock_sampah WHERE namaSampah = '$sampah'");
	$id2 = mysqli_fetch_array($ambildatasampah);
	$namaSampah = $id2['namaSampah'];
	$stock = $id2['stock'];
	$berat = (stripslashes($data["berat"]));

	if($beratpenjualan > $berat) {
		$beratfix = $beratpenjualan - $berat;
		$sisaStock = $stock + $beratfix;
	} elseif($beratpenjualan < $berat) {
		$beratfix = $berat - $beratpenjualan;
		$sisaStock = $stock - $beratfix;
	} elseif($beratpenjualan = $berat) {
		$sisaStock = $stock + 0;
	}

	

	$query ="UPDATE stock_sampah SET 
				stock = '$sisaStock'
			WHERE namaSampah = '$namaSampah'
		";
	mysqli_query($conn, $query);

return mysqli_affected_rows($conn);

}

function editPenjualanSaldo($data) {

	global $conn;

	$idJual = $_GET["idPenjualan"];
	$ambildatapenjualan = mysqli_query($conn, "SELECT * FROM penjualan WHERE idJual = '$idJual'");
	$id1 = mysqli_fetch_array($ambildatapenjualan);
	$totalPendapatanPenjualan = $id1['totalPendapatan'];

	$tanggal = (stripslashes($data["tanggal"]));
	$ambildatabank = mysqli_query($conn, "SELECT * FROM saldo_bank WHERE jumlah = '$totalPendapatanPenjualan' AND tanggal = '$tanggal'");
	$id3 = mysqli_fetch_array($ambildatabank);
	$saldoBank = $id3['totalSaldo'];
	$berat = (stripslashes($data["berat"]));
    $harga = (stripslashes($data["harga"]));
    $totalPendapatan = $berat * $harga;

	if($totalPendapatanPenjualan > $totalPendapatan) {
		$totalfix = $totalPendapatanPenjualan - $totalPendapatan;
		$sisaSaldo = $saldoBank - $totalfix;
	} elseif($totalPendapatanPenjualan < $totalPendapatan) {
		$totalfix = $totalPendapatan - $totalPendapatanPenjualan;
		$sisaSaldo = $saldoBank + $totalfix;
	} elseif($totalPendapatanPenjualan = $totalPendapatan) {
		$sisaSaldo = $saldoBank + 0;
	}

	$query ="UPDATE saldo_bank SET 
				jumlah = '$totalPendapatan',
				totalSaldo = '$sisaSaldo'
			WHERE jumlah = '$totalPendapatanPenjualan' AND tanggal = '$tanggal'
		";
	mysqli_query($conn, $query);

return mysqli_affected_rows($conn);

}

function hapus($id){
 	global $conn;
 	mysqli_query($conn, "DELETE FROM users WHERE idUser = '$id'");
 	return mysqli_affected_rows($conn);
}

function hapus2($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM sampah WHERE idSampah = '$id'");
	return mysqli_affected_rows($conn);
}

function hapus3($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM setoran WHERE idSetor = '$id'");
	return mysqli_affected_rows($conn);
}

function deletesetoranberat($id){
	global $conn;
	$ambildatasetoran = mysqli_query($conn, "SELECT * FROM setoran WHERE idSetor = '$id'");
	$id1 = mysqli_fetch_array($ambildatasetoran);
	$idSampah = $id1['idSampah'];
	$ambildatasampah = mysqli_query($conn, "SELECT * FROM sampah WHERE idSampah = '$idSampah'");
	$id2 = mysqli_fetch_array($ambildatasampah);
	$namaSampah= $id2['namaSampah'];
	$ambildatastock = mysqli_query($conn, "SELECT * FROM stock_sampah WHERE namaSampah = '$namaSampah'");
	$id3 = mysqli_fetch_array($ambildatastock);
	$stock = $id3['stock'];
	$berat = $id1['berat'];
	$sisaStock = $stock - $berat;

	$query ="UPDATE stock_sampah SET 
				stock = '$sisaStock'
			WHERE namaSampah = '$namaSampah'
		";
	mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function deletesetoransaldo($id){
	global $conn;
	$ambildatasetoran = mysqli_query($conn, "SELECT * FROM setoran WHERE idSetor = '$id'");
	$id1 = mysqli_fetch_array($ambildatasetoran);
	$idUser = $id1['idUser'];
	$ambildatauser = mysqli_query($conn, "SELECT * FROM users WHERE idUser = '$idUser'");
	$id2 = mysqli_fetch_array($ambildatauser);
	$saldo= $id2['saldo'];
	$setoran= $id2['jmlSetoran'] - 1;
	$total = $id1['total'];
	$sisaSaldo = $saldo - $total;

	$query ="UPDATE users SET 
				jmlSetoran = '$setoran',
				saldo = '$sisaSaldo'
			WHERE idUser = '$idUser'
		";
	mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function hapus4($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM penarikan WHERE idTarik = '$id'");
	return mysqli_affected_rows($conn);
}

function deletepenarikanuser($id){
	global $conn;
	$ambildatapenarikan = mysqli_query($conn, "SELECT * FROM penarikan WHERE idTarik = '$id'");
	$id1 = mysqli_fetch_array($ambildatapenarikan);
	$idUser = $id1['idUser'];
	$ambildatauser = mysqli_query($conn, "SELECT * FROM users WHERE idUser = '$idUser'");
	$id2 = mysqli_fetch_array($ambildatauser);
	$saldo = $id2['saldo'];
	$penarikan = $id2['jmlPenarikan'] - 1;
	$jmlPenarikan =$id1['jmlPenarikan'];
	$sisaSaldo = $saldo + $jmlPenarikan;

	$query ="UPDATE users SET
				jmlPenarikan = '$penarikan', 
				saldo = '$sisaSaldo'
			WHERE idUser = '$idUser'
		";
	mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function deletepenarikanbank($id){
	global $conn;
	$no = mysqli_query($conn, "SELECT * FROM saldo_bank");
    $jumlahData = mysqli_num_rows($no);
    $hitung = $jumlahData + 1;
	$hitung2 = $jumlahData;

    if(strlen($hitung) == 1){
        $format = "SLD"."00".$hitung;
    }else if (strlen($hitung) == 2) {
        $format = "SLD"."0".$hitung;
    }else{
        $format = "SLD".$hitung;
    }

	$ambildatapenarikan = mysqli_query($conn, "SELECT * FROM penarikan WHERE idTarik = '$id'");
	$id1 = mysqli_fetch_array($ambildatapenarikan);
	$jumlah = $id1['jmlPenarikan'];
	$tanggal = $id1['tglTarik'];

	if(strlen($hitung2) == 1){
        $kodeformat = "SLD"."00".$hitung2;
    }else if (strlen($hitung2) == 2) {
        $kodeformat = "SLD"."0".$hitung2;
    }else{
        $kodeformat = "SLD".$hitung2;
    }

	$ambildatasaldo = mysqli_query($conn, "SELECT * FROM saldo_bank WHERE idTransaksi = '$kodeformat'");
	$id2 = mysqli_fetch_array($ambildatasaldo);
	$saldo = $id2['totalSaldo'];

	$saldoBank = $saldo + $jumlah;

    $aksi = ("Penambahan");

	$aktor = ("ADM001");

$query = "INSERT INTO saldo_bank
		   VALUES
	   ('$format', '$aksi', '$tanggal', '$aktor', '$jumlah', '$saldoBank')
	   ";
	mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function hapus5($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM stock_sampah WHERE idStock = '$id'");
	return mysqli_affected_rows($conn);
}

function hapus6($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM penjualan WHERE idJual = '$id'");
	return mysqli_affected_rows($conn);
}

function hapus7($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM berita WHERE idBerita = '$id'");
	return mysqli_affected_rows($conn);
}

function deletepenjualanbank($id){
	global $conn;
	$no = mysqli_query($conn, "SELECT * FROM saldo_bank");
    $jumlahData = mysqli_num_rows($no);
    $hitung = $jumlahData + 1;
	$hitung2 = $jumlahData;

    if(strlen($hitung) == 1){
        $format = "SLD"."00".$hitung;
    }else if (strlen($hitung) == 2) {
        $format = "SLD"."0".$hitung;
    }else{
        $format = "SLD".$hitung;
    }

	$ambildatapenjualan = mysqli_query($conn, "SELECT * FROM penjualan WHERE idJual = '$id'");
	$id1 = mysqli_fetch_array($ambildatapenjualan);
	$jumlah = $id1['totalPendapatan'];
	$tanggal = $id1['tglPenjualan'];

	if(strlen($hitung2) == 1){
        $kodeformat = "SLD"."00".$hitung2;
    }else if (strlen($hitung2) == 2) {
        $kodeformat = "SLD"."0".$hitung2;
    }else{
        $kodeformat = "SLD".$hitung2;
    }

	$ambildatasaldo = mysqli_query($conn, "SELECT * FROM saldo_bank WHERE idTransaksi = '$kodeformat'");
	$id2 = mysqli_fetch_array($ambildatasaldo);
	$saldo = $id2['totalSaldo'];

	$saldoBank = $saldo - $jumlah;

    $aksi = ("Pengurangan");

	$aktor = ("ADM001");

$query = "INSERT INTO saldo_bank
		   VALUES
	   ('$format', '$aksi', '$tanggal', '$aktor', '$jumlah', '$saldoBank')
	   ";
	mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function deletepenjualanberat($id){
	global $conn;
	$ambildatapenjualan = mysqli_query($conn, "SELECT * FROM penjualan WHERE idJual = '$id'");
	$id1 = mysqli_fetch_array($ambildatapenjualan);
	$idSampah = $id1['idSampah'];
	$ambildatasampah = mysqli_query($conn, "SELECT * FROM sampah WHERE idSampah = '$idSampah'");
	$id2 = mysqli_fetch_array($ambildatasampah);
	$namaSampah= $id2['namaSampah'];
	$ambildatastock = mysqli_query($conn, "SELECT * FROM stock_sampah WHERE namaSampah = '$namaSampah'");
	$id3 = mysqli_fetch_array($ambildatastock);
	$stock = $id3['stock'];
	$berat = $id1['berat'];
	$sisaStock = $stock + $berat;

	$query ="UPDATE stock_sampah SET 
				stock = '$sisaStock'
			WHERE namaSampah = '$namaSampah'
		";
	mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}
?>