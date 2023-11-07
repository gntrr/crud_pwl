<?php
    // Membuat koneksi ke database
    $host = "localhost";
    $dbname = "crud_pwl";
    $username = "root";
    $password = "";
    
    // Membuat instance PDO baru
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, $options);
    } catch (PDOException $e) {
        die("Koneksi gagal: " . $e->getMessage());
    }

    // KUMPULAN LIBRARY YANG BERISI FUNGSI-FUNGSI UNTUK OPERASI CRUD PADA DATABASE
    
    // Query untuk mengambil semua data dari tabel "pegawai"
    function readPegawai()
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM pegawai");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Query untuk mengambil semua data dari tabel "jabatan"
    function readJabatan()
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM jabatan");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Query untuk mengambil data dari tabel "pegawai" berdasarkan ID
    function readPegawaiById($id)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM pegawai WHERE id_pegawai=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Menampilkan data pegawai dengan relasi tabel "pegawai" dan "jabatan"
    function readPegawaiWithJabatan($id = null)
    {
        global $pdo;

        $query = "SELECT * FROM pegawai INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan";
        
        if ($id !== null) {
            $query .= " WHERE pegawai.id_pegawai = :id";
        }

        $stmt = $pdo->prepare($query);

        if ($id !== null) {
            $stmt->bindParam(":id", $id);
        }

        $stmt->execute();

        if ($id !== null) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    // Query untuk memasukkan data ke dalam tabel "pegawai"
    function createPegawai($nama_pegawai, $tgl_lahir, $foto, $keterangan, $id_jabatan)
    {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO pegawai (nama_pegawai, tgl_lahir, foto, keterangan, id_jabatan) VALUES (:nama_pegawai, :tgl_lahir, :foto, :keterangan, :id_jabatan)");
        $stmt->bindParam(":nama_pegawai", $nama_pegawai);
        $stmt->bindParam(":tgl_lahir", $tgl_lahir);
        $stmt->bindParam(":foto", $foto);
        $stmt->bindParam(":keterangan", $keterangan);
        $stmt->bindParam(":id_jabatan", $id_jabatan);
        $stmt->execute();
    }

    // Query untuk memperbarui data di tabel "pegawai" berdasarkan ID
    function updatePegawai($id, $nama_pegawai, $tgl_lahir, $foto, $keterangan, $id_jabatan)
    {
        global $pdo;

        // Periksa apakah ada foto yang diunggah
        if (!empty($foto)) {
            // Jika ada foto yang diunggah, gunakan foto baru
            $stmt = $pdo->prepare("UPDATE pegawai SET nama_pegawai=:nama_pegawai, tgl_lahir=:tgl_lahir, foto=:foto, keterangan=:keterangan, id_jabatan=:id_jabatan WHERE id_pegawai=:id");
        } else {
            // Jika tidak ada foto yang diunggah, gunakan foto yang ada sebelumnya
            $stmt = $pdo->prepare("UPDATE pegawai SET nama_pegawai=:nama_pegawai, tgl_lahir=:tgl_lahir, keterangan=:keterangan, id_jabatan=:id_jabatan WHERE id_pegawai=:id");
        }

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nama_pegawai", $nama_pegawai);
        $stmt->bindParam(":tgl_lahir", $tgl_lahir);
        $stmt->bindParam(":foto", $foto);
        $stmt->bindParam(":keterangan", $keterangan);
        $stmt->bindParam(":id_jabatan", $id_jabatan);
        $stmt->execute();
    }

    // Query untuk menghapus data dari tabel "pegawai" berdasarkan ID
    function deletePegawai($id)
    {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM pegawai WHERE id_pegawai=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    // Query untuk mengambil data dari tabel "jabatan" berdasarkan ID
    function readJabatanById($id)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM jabatan WHERE id_jabatan=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Query untuk memasukkan data ke dalam tabel "jabatan"
    function createJabatan($nama_jabatan)
    {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO jabatan (nama_jabatan) VALUES (:nama_jabatan)");
        $stmt->bindParam(":nama_jabatan", $nama_jabatan);
        $stmt->execute();
    }

    // Query untuk memperbarui data di tabel "jabatan" berdasarkan ID
    function updateJabatan($id, $nama_jabatan)
    {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE jabatan SET nama_jabatan=:nama_jabatan WHERE id_jabatan=:id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nama_jabatan", $nama_jabatan);
        $stmt->execute();
    }

    // Query untuk menghapus data dari tabel "jabatan" berdasarkan ID
    function deleteJabatan($id)
    {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM jabatan WHERE id_jabatan=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
?>