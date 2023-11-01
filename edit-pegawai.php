<?php
require_once('koneksi.php');

// Mengecek apakah form telah disubmit
if(isset($_POST['create'])) {
    // Menangkap data post
    $id_pegawai = $_POST['id_pegawai'];
    $nama_pegawai = $_POST['nama_pegawai'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $foto = $_POST['foto'];
    $keterangan = $_POST['keterangan'];
    $id_jabatan = $_POST['id_jabatan'];

    // Menyiapkan array data
    $data = array(
        ':id_pegawai' => $id_pegawai,
        ':nama_pegawai' => $nama_pegawai,
        ':tgl_lahir' => $tgl_lahir,
        ':foto' => $foto,
        ':keterangan' => $keterangan,
        ':id_jabatan' => $id_jabatan
    );

    // Menyusun query SQL UPDATE
    $sql = 'UPDATE pegawai SET nama_pegawai = :nama_pegawai, tgl_lahir = :tgl_lahir, foto = :foto, keterangan = :keterangan, id_jabatan = :id_jabatan WHERE id_pegawai = :id_pegawai';

    // Menyiapkan pernyataan PDO
    $row = $pdo->prepare($sql);

    // Mengeksekusi pernyataan dengan parameter
    $row->execute($data);

    // Redirect ke halaman utama
    echo '<script>alert("Berhasil Edit Data Pegawai");window.location="index.php"</script>';
}

// Ambil data jabatan dari tabel "jabatan"
$sql_jabatan = "SELECT id_jabatan, nama_jabatan FROM jabatan";
$row_jabatan = $pdo->prepare($sql_jabatan);
$row_jabatan->execute();
$hasil_jabatan = $row_jabatan->fetchAll();

// Menampilkan data pegawai berdasarkan id pegawai
$id = $_GET['id'];

// Mengeksekusi query dengan parameter
$sql = "SELECT * FROM pegawai WHERE id_pegawai = :id";
$row = $pdo->prepare($sql);
$row->execute(array(':id' => $id));
$hasil = $row->fetch();
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
            <form action="" method="POST">
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
                    <input type="file" value="<?php echo $hasil['foto']; ?>" class="form-control" name="foto">
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
