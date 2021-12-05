<?php
include "../koneksi.php";
$id = $_POST['id_buku'];
mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku= '$id'");
