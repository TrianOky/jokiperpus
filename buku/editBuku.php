<?php
include '../koneksi.php';
$id = $_POST['id_buku'];
$nama = $_POST['judul'];
$kategori = $_POST['kategori'];
$pengarang = $_POST['pengarang'];
$penerbit = $_POST['penerbit'];
$tahun = $_POST['tahun'];
mysqli_query($koneksi, "UPDATE buku SET judul = '$nama', id_kategori = '$kategori', pengarang = '$pengarang',penerbit = '$penerbit',tahun = '$tahun' WHERE id_buku = '$id' ");
