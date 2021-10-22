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
    $nrp = htmlspecialchars($data["nrp"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambar = htmlspecialchars($data["gambar"]);

    //query insert data
    $query = "INSERT INTO mahasiswa
                VALUES
                ('', '$nrp', '$nama', '$email', '$jurusan', '$gambar')
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = '$id'");

    return mysqli_affected_rows($conn);
}

function ubah($data, $id)
{
    global $conn;
    //ambil data dari tiap elemen
    $nrp = htmlspecialchars($data["nrp"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambar = htmlspecialchars($data["gambar"]);

    //query insert data
    $query = "UPDATE mahasiswa SET
                nrp = '$nrp',
                nama = '$nama',
                email = '$email',
                jurusan = '$jurusan',
                gambar = '$gambar'
                WHERE id = $id
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM mahasiswa
                WHERE
                nama LIKE '%$keyword%' OR 
                nrp LIKE '%$keyword%' OR
                email LIKE '%$keyword%' OR
                jurusan LIKE '%$keyword%'
                ";

    return query($query);
}
