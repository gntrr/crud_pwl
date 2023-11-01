<?php
	require_once('koneksi.php');
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
						$sql = "SELECT * FROM jabatan";
						$row = $pdo->prepare($sql);
						$row->execute();
						$hasil = $row->fetchAll();
						$a =1;
						foreach($hasil as $isi){
					 ?>
					<tr>
						<td><?php echo $a ?></td>
						<td><?php echo $isi['nama_jabatan'];?></td>
						<td style="text-align: center;">
							<a href="edit-jabatan.php?id=<?php echo $isi['id_jabatan'];?>" class="btn btn-success btn-md">
							<span class="fa fa-edit"></span></a>
							<a onclick="return confirm('Apakah yakin ingin menghapus jabatan ini?')" href="hapus-jabatan.php?id=<?php echo $isi['id_jabatan'];?>" 
							class="btn btn-danger btn-md"><span class="fa fa-trash"></span></a>
						</td>
					</tr>
					<?php
						$a++;
						}
					?>
				 </table>
			  </div>
			</div>
		</div>
	</body>
</html>