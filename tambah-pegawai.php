<?php
require_once('library.php');

if (!empty($_POST['nama_pegawai'])) {
    $nama_pegawai = $_POST['nama_pegawai'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $keterangan = $_POST['keterangan'];
    $id_jabatan = $_POST['id_jabatan'];

    // Proses upload foto
    $foto = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $upload_directory = 'uploads/'; // Nama folder upload

    if (move_uploaded_file($foto_tmp, $upload_directory . $foto)) {
        // Panggil fungsi createPegawai untuk membuat data pegawai baru
        createPegawai($nama_pegawai, $tgl_lahir, $foto, $keterangan, $id_jabatan);

        echo '<script>alert("Berhasil Tambah Data Pegawai");window.location="index.php"</script>';
    } else {
        echo "Gagal mengunggah foto.";
    }
}

// Ambil data jabatan dari tabel "jabatan" dengan class
$hasil_jabatan = readJabatan();
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Tambah Data Pegawai</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container">
    <br/>
    <h3>Tambah Data Pegawai</h3>
    <br/>
    <div class="row">
        <div class="col-lg-6">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama Pegawai</label>
                    <input type="text" value="" class="form-control" name="nama_pegawai">
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" value="" class="form-control" name="tgl_lahir">
                </div>
                <div class="form-group">
                    <label>Foto</label>
                    <input type="file" value="" class="form-control" name="foto">
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" value="" class="form-control" name="keterangan">
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <select name="id_jabatan" class="form-control">
                        <?php foreach ($hasil_jabatan as $jabatan) { ?>
                            <option value="<?php echo $jabatan['id_jabatan']; ?>"><?php echo $jabatan['nama_jabatan']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button class="btn btn-primary btn-md" name="create"><i class="fa fa-plus"> </i> Tambah</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
