<?php
$mahasiswa = [
    [
        "nama" => "Fauziah Aulia",
        "npm" => "12345043",
        "email" => "fauzia@gmail.com",
        "jurusan" => "Teknik Informatika",
        "gambar" => "umaru.png"
    ],
    [
        "nama" => "Bernard",
        "npm" => "76236456",
        "email" => "bernard@gmail.com",
        "jurusan" => "Teknik Industri",
        "gambar" => "elsa.jpg"
    ]
];

// echo $mahasiswa[1]["jurusan"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Associative Array PHP</title>
</head>

<h1>Daftar Mahasiswa</h1>
<?php foreach ($mahasiswa as $mhs) : ?>
    <ul>
        <li>
            <img src="img/<?php echo $mhs['gambar']; ?>" alt="">
        </li>
        <li>Nama: <?= $mhs["nama"]; ?></li>
        <li>NPM: <?= $mhs["npm"]; ?></li>
        <li>Email: <?= $mhs["email"]; ?></li>
        <li>Jurusan: <?= $mhs["jurusan"]; ?></li>
    </ul>
<?php endforeach; ?>

</body>

</html>