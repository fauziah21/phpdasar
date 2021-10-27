<?php
session_start();
//menghubungkan file index.php dengan functions.php
require 'functions.php';

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}


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
        <input id="keyword" type="text" name="keyword" placeholder="Masukkan data yang ingin dicari" size="40" autocomplete="off">
        <button type="submit" name="cari" id="tombol-cari">Cari</button>
    </form>
    <br>

    <div id="container">
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
    </div>

    <script src="js/script.js"></script>
</body>

</html>