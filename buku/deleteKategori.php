<?php
include "../koneksi.php";
$id = $_POST['id_kategori'];
mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori= '$id'");
