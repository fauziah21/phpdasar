<?php
//menghubungkan file index.php dengan functions.php
require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

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
</head>

<body>

    <h1>Daftar Mahasiswa</h1>
    <a href="tambah.php">Tambah Data Mahasiswa</a>
    <br><br>

    <form action="" method="post">
        <input type="text" name="keyword" placeholder="Masukkan data yang ingin dicari" size="40" autocomplete="off">
        <button type="submit" name="cari">Cari</button>
    </form>
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