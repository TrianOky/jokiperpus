<?php
include '../koneksi.php';
$judul = $_POST['judul'];
$kategori = $_POST['kategori'];
$pengarang = $_POST['pengarang'];
$penerbit = $_POST['penerbit'];
$tahun = $_POST['tahun'];
mysqli_query($koneksi, "INSERT INTO buku (judul,id_kategori,pengarang,penerbit,tahun) VALUES ('$judul','$kategori','$pengarang','$penerbit','$tahun')");
