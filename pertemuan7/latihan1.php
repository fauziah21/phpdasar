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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GET</title>
</head>

<body>
    <ul>
        <?php foreach ($mahasiswa as $key => $mhs) : ?>
            <li>
                <a href="latihan2.php?nama=<?= $mhs["nama"]; ?>&npm=<?= $mhs["npm"]; ?>&email=<?= $mhs["email"]; ?>&jurusan=<?= $mhs["jurusan"]; ?>&gambar=<?= $mhs["gambar"]; ?>"><?= $mhs["nama"]; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>