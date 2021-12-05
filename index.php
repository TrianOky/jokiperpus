<?php
session_start();
include './koneksi.php';
if (!$_SESSION['username']) {
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('./bootstrap.html') ?>
    <title>Document</title>
</head>

<body>
    <?php include('./navbar.html') ?>

    <div class="container mb-5" style="margin-top: 100px;">
        <div class="tabel-anggota">
            <div class="card col-12 shadow">
                <h2 class="card-title p-3">Data Anggota</h2>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered ">
                            <thead class="table-dark">
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA</th>
                                    <th>KELAS</th>
                                    <th>ALAMAT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $result = mysqli_query($koneksi, 'SELECT * FROM anggota INNER JOIN kelas ON anggota.id_kelas = kelas.id_kelas LIMIT 5');
                                while ($row = mysqli_fetch_assoc($result)) :
                                ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['nama_kelas'] ?></td>
                                        <td><?= $row['alamat'] ?></td>
                                    </tr>
                                <?php $i++;
                                endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <a href="./anggota.php" class="btn btn-primary float-end">
                        Show All
                    </a>
                </div>
            </div>
        </div>



        <div class="tabel-buku mt-5">
            <div class="card col-12 shadow">
                <h2 class="card-title p-3">Data Buku</h2>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered ">
                            <thead class="table-dark">
                                <tr>
                                    <th>NO</th>
                                    <th>JUDUL</th>
                                    <th>PENGARANG</th>
                                    <th>PENERBIT</th>
                                    <th>TAHUN</th>
                                    <th>KATEGORI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $result = mysqli_query($koneksi, 'SELECT * FROM buku INNER JOIN kategori ON buku.id_kategori = kategori.id_kategori LIMIT 5');
                                while ($row = mysqli_fetch_assoc($result)) :
                                ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $row['judul'] ?></td>
                                        <td><?= $row['pengarang'] ?></td>
                                        <td><?= $row['penerbit'] ?></td>
                                        <td><?= $row['tahun'] ?></td>
                                        <td><?= $row['kategori'] ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <a href="./buku.php" class="btn btn-primary float-end">
                        Show All
                    </a>
                </div>
            </div>
        </div>






        <div class="tabel-peminjaman my-5">
            <div class="card col-12 shadow">
                <h2 class="card-title p-3">Data Peminjaman</h2>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered ">
                            <thead class="table-dark">
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA</th>
                                    <th>BUKU</th>
                                    <th>TANGGAL PINJAM</th>
                                    <th>TANGGAL KEMBALI</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $result = mysqli_query($koneksi, 'SELECT * FROM `peminjaman` INNER JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota INNER JOIN buku ON peminjaman.id_buku = buku.id_buku LIMIT 5
                                ');
                                while ($row = mysqli_fetch_assoc($result)) :
                                ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['judul'] ?></td>
                                        <td><?= $row['tanggal'] ?></td>
                                        <td><?= $row['tanggal_kembali'] ?></td>
                                        <td><?php if ($row['status'] == 0) : ?>
                                                <span class="badge bg-danger">DIPINJAM</span>
                                            <?php else : ?>
                                                <span class="badge bg-success">DIKEMBALIKAN</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <a href="./pinjam.php" class="btn btn-primary float-end">
                        Show All
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
<?php include('./footer.html') ?>

</html>