<?php
include '../koneksi.php';
$nama = $_POST['nama_anggota'];
$kelas = $_POST['kelas'];
$alamat = $_POST['alamat'];
mysqli_query($koneksi, "INSERT INTO anggota (nama,id_kelas,alamat) VALUES ('$nama','$kelas','$alamat')");
