<?php
	// Include library
	require_once('library.php');

	// Mendapatkan data pegawai dan jabatan dari library
	$hasil = readPegawaiWithJabatan();

	// Jika user mengklik tombol Hapus (delete)
	if (isset($_GET['delete_idPegawai'])) {
		$delete_idPegawai = $_GET['delete_idPegawai'];
	
		// Panggil fungsi deletePegawai dari library.php untuk menghapus pegawai
		deletePegawai($delete_idPegawai);

		// Berikan notifikasi ketika pegawai berhasil dihapus
		echo '<script>alert("Berhasil Hapus Data Pegawai");window.location="index.php"</script>';
	}	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Tugas Membuat CRUD Native PHP dengan PDO MySQL</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<div class="container">
            <br>
            <h1>Tugas Membuat CRUD Native PHP dengan PDO MySQL</h1>
            <p>By kelompok 2 <br>
            </p>
			<div class="row">
				 <div class="col-lg-12">
				 <br/>
				 <a href="tambah-pegawai.php" class="btn btn-primary btn-md"><span class="fa fa-plus"></span> Tambah Data</a>
                 <a href="jabatan.php" class="btn btn-success btn-md"><span class="fa fa-briefcase"></span> Daftar Jabatan</a>
				 <table class="table table-hover table-bordered" style="margin-top: 10px">
					<tr class="success">
						<th width="50px">Id</th>
						<th>Nama Pegawai</th>
						<th>Tanggal Lahir</th>
						<th>Foto</th>
                        <th>Keterangan</th>
                        <th>Jabatan</th>
						<th style="text-align: center;">Actions</th>
					</tr>
					 <?php
						foreach($hasil as $isi){
					 ?>
					<tr>
						<td><?php echo $isi['id_pegawai'];?></td>
						<td><?php echo $isi['nama_pegawai'];?></td>
						<td><?php echo $isi['tgl_lahir'];?></td>
						<td><img src="uploads/<?php echo ($isi['foto']); ?>" width="100" height="100" /></td>
                        <td><?php echo $isi['keterangan'];?></td>
                        <td><?php echo $isi['nama_jabatan'];?></td>
						<td style="text-align: center;">
							<a href="edit-pegawai.php?id=<?php echo $isi['id_pegawai'];?>" class="btn btn-success btn-md">
							<span class="fa fa-edit"></span></a>
							<a onclick="return confirm('Apakah yakin ingin menghapus data ini?')" href="?delete_idPegawai=<?php echo $isi['id_pegawai'];?>" 
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