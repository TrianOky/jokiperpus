<?php
include '../koneksi.php';
$tanggal = $_POST['tanggal'];
$id_buku = $_POST['id_buku'];
$id_anggota = $_POST['id_anggota'];
$statuss = 0;
$tanggal_kembali = $_POST['tanggal_kembali'];
mysqli_query($koneksi, "INSERT INTO peminjaman (tanggal,id_buku,id_anggota,statuss,tanggal_kembali) VALUES ('$tanggal','$id_buku','$id_anggota','$statuss','$tanggal_kembali')");
