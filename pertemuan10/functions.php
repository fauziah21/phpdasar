<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

//membuat wadah untuk query sql
function query($query)
{
    global $conn;
    //mengambil data dari tabel mahasiswa
    $result = mysqli_query($conn, $query);
    //membuat wadah baru untuk menampung array dari db
    $rows = [];
    //memasukkan data dari table mahasiswa ke array $rows
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    //mengembalikan nilai
    return $rows;
}

function tambah($data)
{
    global $conn;
    //ambil data dari tiap elemen
    $nrp = $data["nrp"];
    $nama = $data["nama"];
    $email = $data["email"];
    $jurusan = $data["jurusan"];
    $gambar = $data["gambar"];

    //query insert data
    $query = "INSERT INTO mahasiswa
                VALUES
                ('', '$nrp', '$nama', '$email', '$jurusan', '$gambar')
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
