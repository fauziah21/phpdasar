<?php
require "functions.php";


//ambil data di url
$id = $_GET["id"];
// var_dump($id);

//query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];
// var_dump($mhs);

//cek apakah button sudah di klik
if (isset($_POST["submit"])) {
    // var_dump($_POST);
    //cek apakah data berhasil diubah
    if (ubah($_POST, $id) > 0) {
        echo "<script>alert('Data berhasil diubah!')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    } else {
        echo "<script>alert('Data gagal diubah!')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Mahasiswa</title>
</head>

<body>
    <h1>Ubah Data Mahasiswa</h1>

    <form action="" method="post">
        <ul>
            <li>
                <label for="nrp">NRP : </label>
                <input type="text" name="nrp" id="nrp" value="<?= $mhs['nrp']; ?>">
            </li>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" value="<?= $mhs['nama']; ?>">
            </li>
            <li>
                <label for=" email">Email : </label>
                <input type="text" name="email" id="email" value="<?= $mhs['email']; ?>">
            </li>
            <li>
                <label for=" jurusan">Jurusan : </label>
                <input type="text" name="jurusan" id="jurusan" value="<?= $mhs['jurusan']; ?>">
            </li>
            <li>
                <label for=" gambar">Gambar : </label>
                <input type="text" name="gambar" id="gambar" value="<?= $mhs['gambar']; ?>">
            </li>
            <li>
                <button type="submit" name="submit">Ubah</button>
            </li>

        </ul>
        <a href="index.php">home</a>
    </form>
</body>

</html>