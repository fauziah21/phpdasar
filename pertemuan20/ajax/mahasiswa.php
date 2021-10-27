<?php
require '../functions.php';

$keyword = $_GET["keyword"];

$query = "SELECT * FROM mahasiswa
                WHERE
                nama LIKE '%$keyword%' OR 
                nrp LIKE '%$keyword%' OR
                email LIKE '%$keyword%' OR
                jurusan LIKE '%$keyword%'
                ";
$mahasiswa = query($query);
?>
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