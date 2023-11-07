<?php
	// Include Library
	require_once('library.php');

	// Mendapatkan data jabatan dari library
	$hasil = readJabatan();

	// Jika user mengklik tombol Hapus (delete)
	if (isset($_GET['delete_idJabatan'])) {
		$delete_idJabatan = $_GET['delete_idJabatan'];
	
		// Panggil fungsi deleteJabatan dari library.php untuk menghapus jabatan
		deleteJabatan($delete_idJabatan);
		
		// Berikan notifikasi ketika jabatan berhasil dihapus
		echo '<script>alert("Berhasil Hapus Data Jabatan");window.location="jabatan.php"</script>';
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Daftar Jabatan</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<div class="container">
            <br>
            <h1>Daftar Jabatan</h1>
			<div class="row">
				 <div class="col-lg-12">
				 <br/>
				 <a href="tambah-jabatan.php" class="btn btn-primary btn-md"><span class="fa fa-plus"></span> Tambah Data</a>
                 <a href="./" class="btn btn-success btn-md"><span class="fa fa-user"></span> Daftar Pegawai</a>
				 <table class="table table-hover table-bordered" style="margin-top: 10px">
					<tr class="success">
						<th width="50px">Id</th>
						<th>Nama Jabatan</th>
						<th style="text-align: center;">Actions</th>
					</tr>
					 <?php
						foreach($hasil as $isi){
					 ?>
					<tr>
						<td><?php echo $isi['id_jabatan'];?></td>
						<td><?php echo $isi['nama_jabatan'];?></td>
						<td style="text-align: center;">
							<a href="edit-jabatan.php?id=<?php echo $isi['id_jabatan'];?>" class="btn btn-success btn-md">
							<span class="fa fa-edit"></span></a>
							<a onclick="return confirm('Apakah yakin ingin menghapus jabatan ini?')" href="?delete_idJabatan=<?php echo $isi['id_jabatan'];?>" 
   							class="btn btn-danger btn-md"><span class="fa fa-trash"></span></a>
						</td>
					</tr>
					<?php
						}
					?>
				 </table>
			  </div>
			</div>
		</div>
	</body>
</html>