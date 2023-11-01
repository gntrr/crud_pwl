<?php
require_once('koneksi.php');
	// untuk Hapus data pegawai berdasarkan id pegawai
	$id = $_GET['id'];
	$sql = "DELETE FROM pegawai WHERE id_pegawai= ?";
	$row = $pdo->prepare($sql);
	$row->execute(array($id));
	
	echo '<script>alert("Berhasil Hapus Data Pegawai");window.location="index.php"</script>';
?>