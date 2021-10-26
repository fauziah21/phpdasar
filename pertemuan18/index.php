<?php
session_start();
//menghubungkan file index.php dengan functions.php
require 'functions.php';

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

//pagination
//konfigurasi
$jumlahDataPerHalaman = 2;
$jumlahData = count(query('SELECT * FROM mahasiswa'));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET['halaman'] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerHalaman");

//cek apakah tombil cari di klik
if (isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&family=Roboto:wght@100;300;400;500&display=swap" rel="stylesheet">

    <!-- custom css -->
    <link rel="stylesheet" href="style/index.css">
</head>

<body>
    <a href="logout.php" class="btn-logout">Logout</a>

    <h1>Daftar Mahasiswa</h1>
    <a href="tambah.php">Tambah Data Mahasiswa</a>
    <br><br>

    <form action="" method="post">
        <input type="text" name="keyword" placeholder="Masukkan data yang ingin dicari" size="40" autocomplete="off">
        <button type="submit" name="cari">Cari</button>
    </form> <br>

    <!-- navigasi pagination -->
    <?php if ($halamanAktif > 1) : ?>
        <a href="?halaman=<?= $halamanAktif - 1 ?>">&laquo;</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
        <?php if ($i == $halamanAktif) : ?>

            <a href="?halaman=<?= $i; ?>" style="font-weight: bold;color:red"><?= $i; ?></a>
        <?php else : ?>
            <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ($halamanAktif < $jumlahHalaman) : ?>
        <a href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a>
    <?php endif; ?>
    <br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>ERP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>

        <?php foreach ($mahasiswa as $key => $row) : ?>
            <tr>
                <td><?php echo $key + 1 ?></td>
                <td>
                    <a href="ubah.php?id=<?= $row["id"]; ?>">edit</a> |
                    <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin ingin menghapus data?');">delete</a>
                </td>
                <td>
                    <img src="img/<?= $row["gambar"]; ?>" width="50" alt="">
                </td>
                <td>
                    <?= $row["nrp"]; ?>
                </td>
                <td><?= $row["nama"]; ?></td>
                <td><?= $row["email"]; ?></td>
                <td><?= $row["jurusan"]; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>