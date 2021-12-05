<?php
include '../koneksi.php';
$id = $_POST['id'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$alamat = $_POST['alamat'];
mysqli_query($koneksi, "UPDATE anggota SET nama = '$nama', id_kelas = '$kelas', alamat = '$alamat' WHERE id_anggota = '$id' ");
