<?php
include '../koneksi.php';
$kategori = $_POST['kategori'];
mysqli_query($koneksi, "INSERT INTO kategori (kategori) VALUES ('$kategori')");
