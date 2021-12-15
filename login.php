<?php
session_start();
if (isset($_SESSION['username'])) {
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('./bootstrap.html') ?>
    <title>LOGIN | PERPUS JALAN</title>
</head>

<body>
    <div class="container-fluid container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card col-6 p-3 shadow">
            <img src="./library.png" alt="" class="img-fluid img-thumbnail rounded mx-auto w-25 my-3 img">
            <h3 class="card-title text-center">
                Login Boss
            </h3>
            <div class="card-body">
                <div class="container-fluid">
                    <form id="login" action="./ceklogin.php" method="POST">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Username</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name='username' aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name='password'>
                        </div>
                        <button type="submit" id="submit" class="mt-3 btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>