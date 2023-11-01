<?php
require_once('koneksi.php');

if (isset($_POST['create'])) {
    $id_jabatan = $_POST['id_jabatan'];
    $nama_jabatan = $_POST['nama_jabatan'];

    // Perbarui data jabatan berdasarkan ID
    $sql = 'UPDATE jabatan SET nama_jabatan = :nama_jabatan WHERE id_jabatan = :id_jabatan';
    $row = $pdo->prepare($sql);
    $row->execute(array(':nama_jabatan' => $nama_jabatan, ':id_jabatan' => $id_jabatan));

    // Redirect ke halaman jabatan
    echo '<script>alert("Berhasil Edit Jabatan");window.location="jabatan.php"</script>';
}

$id_jabatan = $_GET['id']; // Ambil ID jabatan yang akan diubah

// Ambil data jabatan dari tabel "jabatan" berdasarkan ID
$sql_jabatan = "SELECT id_jabatan, nama_jabatan FROM jabatan WHERE id_jabatan = :id_jabatan";
$row_jabatan = $pdo->prepare($sql_jabatan);
$row_jabatan->execute(array(':id_jabatan' => $id_jabatan));
$hasil = $row_jabatan->fetch(); // Ambil data jabatan

if (!$hasil) {
    // Handle jika ID jabatan tidak ditemukan
    echo 'Jabatan tidak ditemukan';
    exit;
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Edit Jabatan - <?php echo $hasil['nama_jabatan']; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container">
    <br/>
    <h3>Edit Jabatan - <?php echo $hasil['nama_jabatan']; ?></h3>
    <br/>
    <div class="row">
        <div class="col-lg-6">
            <form action="" method="POST">
                <div class="form-group">
                    <label>Nama Jabatan</label>
                    <input type="text" value="<?php echo $hasil['nama_jabatan']; ?>" class="form-control" name="nama_jabatan">
                </div>
                <input type="hidden" value="<?php echo $hasil['id_jabatan']; ?>" name="id_jabatan">
                <button class="btn btn-primary btn-md" name="create"><i class="fa fa-edit"> </i> Update</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
