<?php
include 'koneksi.php';
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

if ($username && $password) {
    $md5pwd = md5($password);
    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username' AND passsword = '$md5pwd'");
    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        header('location: index.php');
    } else {
        echo "<script>alert('Anda gagal login');window.location='login.php'</script>";
    }
} else {
    echo "<script>alert('Anda gagal login');window.location='login.php'";
}
