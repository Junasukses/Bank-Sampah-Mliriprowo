<?php 

session_start();

if ( !isset($_SESSION["login"]) ){
	header("Location: login.php");
	exit;
}

require 'functions.php';
$id = $_GET["id"];


if(deletepenjualanbank($id) > 0 && deletepenjualanberat($id) > 0 && hapus6($id) > 0 ){
	echo "
	<script>
		alert('Data berhasil dihapus');
		document.location.href = 'penjualanAdmin.php';
	</script>
";
}else{
	echo "
		<script>
			alert('Data gagal dihapus');
			document.location.href = 'penjualanAdmin.php';
		</script>
	";
}   

?>