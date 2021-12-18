<?php 

session_start();

if ( !isset($_SESSION["login"]) ){
	header("Location: login.php");
	exit;
}

require 'functions.php';
$id = $_GET["id"];


if (hapususer($id) > 0){
	echo "
		<script>
			alert('Data berhasil dihapus');
			document.location.href = 'pengguna.php';
		</script>
	";
}elseif(hapussampah($id) > 0){
	echo "
	<script>
		alert('Data berhasil dihapus');
		document.location.href = 'sampahAdmin.php';
	</script>
";
}elseif(hapus5($id) > 0){
	echo "
	<script>
		alert('Data berhasil dihapus');
		document.location.href = 'stocksampahAdmin.php';
	</script>
";
}elseif(hapus7($id) > 0){
	echo "
	<script>
		alert('Data berhasil dihapus');
		document.location.href = 'beritaAdmin.php';
	</script>
";
}else{
	echo "
		<script>
			alert('Data gagal dihapus');
			document.location.href = 'pengguna.php';
		</script>
	";
}   

?>