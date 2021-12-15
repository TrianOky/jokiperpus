<?php
include '../koneksi.php';
$id = $_POST['id_pinjam'];
$idBuku = $_POST['id_buku'];
$tanggal = $_POST['tgl_pinjam'];
$tgl_kembali = $_POST['tgl_kembali'];
$statuss = $_POST['statuss'];
$idAnggota = $_POST['id_anggota'];
mysqli_query($koneksi, "UPDATE peminjaman SET id_buku = '$idBuku', tanggal = '$tanggal', tanggal_kembali = '$tgl_kembali',statuss = '$statuss',id_anggota = '$idAnggota' WHERE id_peminjaman = '$id' ");
