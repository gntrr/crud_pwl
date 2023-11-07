<?php
	// Include Library
	require_once('library.php');

	// Jika user mengklik tombol Tambah (Create)
	if (isset($_POST['create'])) {
		$nama_jabatan = $_POST['nama_jabatan'];
		
		// Panggil fungsi createJabatan() untuk menambah data jabatan
		createJabatan($nama_jabatan);
		
		// Berikan notifikasi ketika jabatan berhasil ditambahkan
		echo '<script>alert("Berhasil Tambah Data Jabatan");window.location="jabatan.php"</script>';
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Tambah Jabatan</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<div class="container">
			 <br/>
			 <h3>Tambah Jabatan</h3>
			 <br/>
			<div class="row">
				 <div class="col-lg-6">
					 <form action="" method="POST">
						 <div class="form-group">
							 <label>Nama Jabatan</label>
							 <input type="text" value="" class="form-control" name="nama_jabatan">
						 </div>
						 <button class="btn btn-primary btn-md" name="create"><i class="fa fa-plus"> </i> Tambah</button>
					 </form>
				  </div>
			</div>
		</div>
	</body>
</html>