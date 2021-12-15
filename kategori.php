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
    <title>Kategori | PERPUS JALAN</title>
</head>

<body>
    <?php include('./navbar.html') ?>
    <div class="container mb-5" style="margin-top: 100px; height: 100vh;">
        <div class="tabel-anggota">
            <div class="card col-12 shadow">
                <div class="p-3 d-flex justify-content-between">

                    <h2 class="">Data Kategori</h2>
                    <button onclick="tambah()" class="btn btn-primary">
                        Tambah Kategori
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered ">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA KATEGORI</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $result = mysqli_query($koneksi, 'SELECT * FROM kategori;');
                                while ($row = mysqli_fetch_assoc($result)) :
                                ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $row['kategori'] ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-warning my-1 my-md-0" onclick="edit('<?= $row['kategori'] ?>','<?= $row['id_kategori'] ?>')">Edit</button>
                                            <button onclick="hapus(<?= $row['id_kategori']; ?>)" class="btn btn-danger my-1 my-md-0">Hapus</button>
                                        </td>
                                    </tr>
                                <?php $i++;
                                endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="edit" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEdit">
                        <div class="mb-3">
                            <input type="hidden" name="id_kategori" id="idKategori">
                            <label class="form-label">NAMA KATEGORI</label>
                            <input type="text" class="form-control" id="editKategori" name="kategori" aria-describedby="emailHelp">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="tombolEdit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="tambah" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambah">
                        <div class="mb-3">
                            <label class="form-label">NAMA KATEGORI</label>
                            <input type="text" class="form-control" name="kategori" aria-describedby="emailHelp">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="tombolSave" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        const edit = (kategori, id) => {
            var myModal = new bootstrap.Modal(document.getElementById('edit'), {
                keyboard: false
            })
            myModal.show()
            $('#editKategori').val(kategori)
            $('#idKategori').val(id)
        }
        $('#tombolEdit').on('click', () => {
            const data = $('#formEdit').serialize()
            $.ajax({
                url: './buku/editKategori.php',
                method: 'post',
                data,
                success: () => window.location.reload()
            })
        })
        const tambah = () => {
            var myModal = new bootstrap.Modal(document.getElementById('tambah'), {
                keyboard: false
            })
            myModal.show();
        }
        $('#tombolSave').on('click', () => {
            const data = $('#formTambah').serialize()
            $.ajax({
                url: './buku/tambahKategori.php',
                method: 'post',
                data,
                success: () => window.location.reload()
            })
        })
        const hapus = (id_buku) => {
            $.ajax({
                url: './buku/deleteKategori.php',
                method: 'post',
                data: `id_kategori=${id_buku}`,
                success: () => window.location.reload()
            })
        }
    </script>


</body>
<?php include('./footer.html') ?>

</html>