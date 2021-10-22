<?php
require 'functions.php';

// var_dump($_GET["id"]);
$id = $_GET['id'];

if (hapus($id) > 0) {
    echo "<script>alert('Data berhasil dihapus!')</script>";
    echo "<script>window.open('index.php','_self')</script>";
} else {
    echo "<script>alert('Data gagal dihapus!')</script>";
    echo "<script>window.open('index.php','_self')</script>";
}
