<?php
require_once('koneksi.php');

if (!empty($_POST['nama_pegawai'])) {
    $nama_pegawai = $_POST['nama_pegawai'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $foto = $_POST['foto'];
    $keterangan = $_POST['keterangan'];
    $id_jabatan = $_POST['id_jabatan'];

    $data[] = $nama_pegawai;
    $data[] = $tgl_lahir;
    $data[] = $foto;
    $data[] = $keterangan;
    $data[] = $id_jabatan;

    $sql = 'INSERT INTO pegawai (nama_pegawai, tgl_lahir, foto, keterangan, id_jabatan) VALUES (?, ?, ?, ?, ?)';
    $row = $pdo->prepare($sql);
    $row->execute($data);

    echo '<script>alert("Berhasil Tambah Data Pegawai");window.location="index.php"</script>';
}

// Ambil data jabatan dari tabel "jabatan"
$sql_jabatan = "SELECT id_jabatan, nama_jabatan FROM jabatan";
$row_jabatan = $pdo->prepare($sql_jabatan);
$row_jabatan->execute();
$hasil_jabatan = $row_jabatan->fetchAll();
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
            <form action="" method="POST">
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
