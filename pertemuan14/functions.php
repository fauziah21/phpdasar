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

    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    //query insert data
    $query = "INSERT INTO mahasiswa
                VALUES
                ('', '$nrp', '$nama', '$email', '$jurusan', '$gambar')
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES["gambar"]['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpFile = $_FILES['gambar']['tmp_name'];

    //cek apakah tidak ada gambar yang di upload
    if ($error === 4) {
        echo "<script>alert('Pilih gambar terlebih dahulu');</script>";
        return false;
    }

    //cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>alert('yang Anda upload bukan gambar!');</script>";
        return false;
    }

    if ($ukuranFile > 1000000) {
        echo "<script>alert('Ukuran gambar lebih dari 1Mb!');</script>";
        return false;
    }

    //sudah divalidasi, file bisa di upload
    //generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpFile, 'img/' . $namaFileBaru);

    return $namaFileBaru;
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
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    //cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }


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

function resgistrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('username sudah terdaftar!');</script>";
        return false;
    }

    //cek apakah password dan password2 sama
    if ($password !== $password2) {
        echo "<script>alert('konfirmasi password salah');</script>";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //masukkan data user ke db
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);
}
