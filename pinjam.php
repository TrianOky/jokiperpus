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
    <div class="container mb-5" style="margin-top: 100px; height: 100vh;">
        <div class="tabel-anggota">
            <div class="card col-12 shadow">
                <div class="p-3 d-flex justify-content-between">

                    <h2 class="">Data </h2>
                    <button onclick="tambah()" class="btn btn-primary">
                        Tambah Buku
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered ">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>NO</th>
                                    <th>JUDUL</th>
                                    <th>PENGARANG</th>
                                    <th>PENERBIT</th>
                                    <th>TAHUN</th>
                                    <th>KATEGORI</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $result = mysqli_query($koneksi, 'SELECT * FROM buku INNER JOIN kategori ON buku.id_kategori = kategori.id_kategori');
                                while ($row = mysqli_fetch_assoc($result)) :
                                ?>
                                <tr>
                                    <td>
                                        <?= $i ?>
                                    </td>
                                    <td>
                                        <?= $row['judul'] ?>
                                    </td>
                                    <td>
                                        <?= $row['pengarang'] ?>
                                    </td>
                                    <td>
                                        <?= $row['penerbit'] ?>
                                    </td>
                                    <td>
                                        <?= $row['tahun'] ?>
                                    </td>
                                    <td>
                                        <?= $row['kategori'] ?>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-warning my-1 my-md-0"
                                            onclick="edit('<?= $row['judul'] ?>','<?= $row['kategori'] ?>', '<?= $row['pengarang'] ?>', '<?= $row['penerbit'] ?>','<?= $row['tahun'] ?>', '<?= $row['id_buku'] ?>')">Edit</button>
                                        <button onclick="hapus(<?= $row['id_buku']; ?>)"
                                            class="btn btn-danger my-1 my-md-0">Hapus</button>
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
                            <input type="hidden" name="id_buku" id="idBuku">
                            <label class="form-label">JUDUL</label>
                            <input type="text" class="form-control" id="editJudul" name="judul"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">KATEGORI</label>
                            <select class="form-select" name="kategori" aria-label="Default select example">
                                <?php
                                $result = mysqli_query($koneksi, 'SELECT * from kategori');
                                while ($row = mysqli_fetch_assoc($result)) :
                                ?>
                                <option value="<?= $row['id_kategori'] ?>">
                                    <?= $row['kategori'] ?>
                                </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">PENGARANG</label>
                            <input type="text" id="editPengarang" name="pengarang" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlinput1" class="form-label">PENERBIT</label>
                            <input id="editPenerbit" type="text" name="penerbit" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlinput1" class="form-label">TAHUN</label>
                            <input id="editTahun" type="text" name="tahun" class="form-control">
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
                    <h5 class="modal-title">Data Anggota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambah">
                        <div class="mb-3">
                            <label class="form-label">JUDUL</label>
                            <input type="text" class="form-control" name="judul" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">KATEGORI</label>
                            <select class="form-select" name="kategori" aria-label="Default select example">
                                <?php
                                $result = mysqli_query($koneksi, 'SELECT * from kategori');
                                while ($row = mysqli_fetch_assoc($result)) :
                                ?>
                                <option value="<?= $row['id_kategori'] ?>">
                                    <?= $row['kategori'] ?>
                                </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">PENGARANG</label>
                            <input type="text" name="pengarang" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">PENERBIT</label>
                            <input type="text" name="penerbit" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">TAHUN</label>
                            <input type="text" name="tahun" class="form-control">
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
        const edit = (judul, kategori, pengarang, penerbit, tahun, id) => {
            var myModal = new bootstrap.Modal(document.getElementById('edit'), {
                keyboard: false
            })
            myModal.show()
            $('#editJudul').val(judul)
            $('#editKategori select').val(kategori)
            $('#editPengarang').val(pengarang)
            $('#editPenerbit').val(penerbit)
            $('#editTahun').val(tahun)
            $('#idBuku').val(id)
        }
        $('#tombolEdit').on('click', () => {
            const data = $('#formEdit').serialize()
            $.ajax({
                url: './buku/editBuku.php',
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
                url: './buku/tambahBuku.php',
                method: 'post',
                data,
                success: () => window.location.reload()
            })
        })
        const hapus = (id_buku) => {
            $.ajax({
                url: './buku/deleteBuku.php',
                method: 'post',
                data: `id_buku=${id_buku}`,
                success: () => window.location.reload()
            })
        }
    </script>


</body>
<?php include('./footer.html') ?>

</html>