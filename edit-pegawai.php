<?php
    // Include Library
    require_once('library.php');

    // Menampilkan data pegawai berdasarkan id pegawai
    $id = $_GET['id'];

    // Ambil data pegawai berdasarkan id pegawai
    $hasil = readPegawaiWithJabatan($id);

    $foto = $hasil['foto']; // Menggunakan foto yang ada sebelumnya sebagai default

    if (isset($_POST['create'])) {
        $id_pegawai = $_POST['id_pegawai'];
        $nama_pegawai = $_POST['nama_pegawai'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $keterangan = $_POST['keterangan'];
        $id_jabatan = $_POST['id_jabatan'];

        // Periksa apakah ada file foto yang diunggah
        if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            // File foto baru diunggah
            $upload_directory = 'uploads/';
            $foto = $_FILES['foto']['name'];
            $foto_tmp = $_FILES['foto']['tmp_name'];

            // Pindahkan file foto baru ke folder upload
            move_uploaded_file($foto_tmp, $upload_directory . $foto);
        }

        // Panggil fungsi updatePegawai() untuk mengupdate data pegawai
        updatePegawai($id_pegawai, $nama_pegawai, $tgl_lahir, $foto, $keterangan, $id_jabatan);

        // Redirect ke halaman utama
        echo '<script>alert("Berhasil Edit Data Pegawai");window.location="index.php"</script>';
    }

    // Ambil data jabatan dari tabel "jabatan"
    $hasil_jabatan = readJabatan();
?>


<!DOCTYPE HTML>
<html>
<head>
    <title>Edit Pegawai - <?php echo $hasil['nama_pegawai']; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container">
    <br/>
    <h3>Edit Pegawai - <?php echo $hasil['nama_pegawai']; ?></h3>
    <br/>
    <div class="row">
        <div class="col-lg-6">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama Pegawai</label>
                    <input type="text" value="<?php echo $hasil['nama_pegawai']; ?>" class="form-control" name="nama_pegawai">
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" value="<?php echo $hasil['tgl_lahir']; ?>" class="form-control" name="tgl_lahir">
                </div>
                <div class="form-group">
                    <label>Foto</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="foto">
                            <label class="custom-file-label" for="customFile"><?php echo $foto; ?></label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" value="<?php echo $hasil['keterangan']; ?>" class="form-control" name="keterangan">
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <select name="id_jabatan" class="form-control">
                        <?php foreach ($hasil_jabatan as $jabatan) { ?>
                            <option value="<?php echo $jabatan['id_jabatan']; ?>" <?php if ($jabatan['id_jabatan'] == $hasil['id_jabatan']) echo 'selected'; ?>>
                                <?php echo $jabatan['nama_jabatan']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <input type="hidden" value="<?php echo $hasil['id_pegawai']; ?>" name="id_pegawai">
                <button class="btn btn-primary btn-md" name="create"><i class="fa fa-edit"> </i> Update</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>