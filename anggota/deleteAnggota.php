<?php
include "../koneksi.php";
$id = $_POST['id_anggota'];
mysqli_query($koneksi, "DELETE FROM anggota WHERE id_anggota = '$id'");
