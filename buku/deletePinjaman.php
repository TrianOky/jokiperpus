<?php
include "../koneksi.php";
$id = $_POST['id_pinjaman'];
mysqli_query($koneksi, "DELETE FROM peminjaman WHERE id_peminjaman= '$id'");
