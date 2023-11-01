<?php
require_once('koneksi.php');
	// untuk Hapus data jabatan berdasarkan id jabatan
	$id = $_GET['id'];
	$sql = "DELETE FROM jabatan WHERE id_jabatan= ?";
	$row = $pdo->prepare($sql);
	$row->execute(array($id));
	
	echo '<script>alert("Berhasil Hapus Data Jabatan");window.location="jabatan.php"</script>';
?>