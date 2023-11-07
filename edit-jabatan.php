<?php
require_once('library.php');

// Menampilkan data jabatan berdasarkan id jabatan
$id = $_GET['id'];
$hasil = readJabatanById($id);

if (isset($_POST['update'])) {
    $id_jabatan = $_POST['id_jabatan'];
    $nama_jabatan = $_POST['nama_jabatan'];

    // Perbarui data jabatan dengan memanggil fungsi updateJabatan
    updateJabatan($id_jabatan, $nama_jabatan);

    // Redirect ke halaman jabatan
    echo '<script>alert("Berhasil Edit Jabatan");window.location="jabatan.php"</script>';
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
                <button class="btn btn-primary btn-md" name="update"><i class="fa fa-edit"> </i> Update</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
