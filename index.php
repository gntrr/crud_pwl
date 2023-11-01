<?php
	require_once('koneksi.php');
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
            <p>Kelompok: <br>
                1. Afidz Bangun Prastya <br>
                2. Zaky Luthfirana Roihan Nafi' <br>
                3. Wima Alif Harianto <br>
                4. Ryan Erlangga Ardyansyah <br>
                5. Danang Suminar Dwi Cahyo <br>
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
						$sql = "SELECT pegawai.*, jabatan.nama_jabatan FROM pegawai
                        INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan";
						$row = $pdo->prepare($sql);
						$row->execute();
						$hasil = $row->fetchAll();

						$a =1;
						foreach($hasil as $isi){
					 ?>
					<tr>
						<td><?php echo $a ?></td>
						<td><?php echo $isi['nama_pegawai'];?></td>
						<td><?php echo $isi['tgl_lahir'];?></td>
						<td><?php echo $isi['foto'];?></td>
                        <td><?php echo $isi['keterangan'];?></td>
                        <td><?php echo $isi['nama_jabatan'];?></td>
						<td style="text-align: center;">
							<a href="edit-pegawai.php?id=<?php echo $isi['id_pegawai'];?>" class="btn btn-success btn-md">
							<span class="fa fa-edit"></span></a>
							<a onclick="return confirm('Apakah yakin ingin menghapus data ini?')" href="hapus-pegawai.php?id=<?php echo $isi['id_pegawai'];?>" 
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