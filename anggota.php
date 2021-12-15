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
    <title>Anggota | PERPUS JALAN</title>
</head>

<body>
    <?php include('./navbar.html') ?>
    <div class="container mb-5" style="margin-top: 100px; height: 100vh;">
        <div class="tabel-anggota">
            <div class="card col-12 shadow">
                <div class="p-3 d-flex justify-content-between">

                    <h2 class="">Data Anggota</h2>
                    <button onclick="tambah()" class="btn btn-primary">
                        Tambah Anggota
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered ">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA</th>
                                    <th>KELAS</th>
                                    <th>ALAMAT</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $result = mysqli_query($koneksi, 'SELECT * FROM anggota INNER JOIN kelas ON anggota.id_kelas = kelas.id_kelas');
                                while ($row = mysqli_fetch_assoc($result)) :
                                ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['nama_kelas'] ?></td>
                                        <td><?= $row['alamat'] ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-warning my-1 my-md-0" onclick="edit('<?= $row['nama'] ?>', '<?= $row['nama_kelas'] ?>', '<?= $row['alamat'] ?>', '<?= $row['id_anggota'] ?>')">Edit</button>
                                            <button onclick="hapus(<?= $row['id_anggota']; ?>)" class="btn btn-danger my-1 my-md-0">Hapus</button>
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




    <div class="modal fade" id="tambah" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambah">
                        <div class="mb-3">
                            <label class="form-label">NAMA</label>
                            <input type="text" class="form-control" name="nama_anggota" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">KELAS</label>
                            <select class="form-select" name="kelas" aria-label="Default select example">
                                <?php
                                $result = mysqli_query($koneksi, 'SELECT * from kelas');
                                while ($row = mysqli_fetch_assoc($result)) :
                                ?>
                                    <option value="<?= $row['id_kelas'] ?>"><?= $row['nama_kelas'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">ALAMAT</label>
                            <textarea name="alamat" class="form-control" rows="3"></textarea>
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




    <div class="modal fade" id="edit" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Anggota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEdit">
                        <div class="mb-3">
                            <label class="form-label">NAMA</label>
                            <input type="text" class="form-control" id="editNama" name="nama" aria-describedby="emailHelp">
                            <input type="hidden" class="form-control" id="editId" name="id">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">KELAS</label>
                            <select class="form-select" id="editKelas" name="kelas" aria-label="Default select example">
                                <?php
                                $result = mysqli_query($koneksi, 'SELECT * from kelas');
                                while ($row = mysqli_fetch_assoc($result)) :
                                ?>
                                    <option value="<?= $row['id_kelas'] ?>"><?= $row['nama_kelas'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">ALAMAT</label>
                            <textarea name="alamat" class="form-control" id="editAlamat" rows="3"></textarea>
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


    <script>
        const edit = (nama, kelas, alamat, id) => {
            var myModal = new bootstrap.Modal(document.getElementById('edit'), {
                keyboard: false
            })
            myModal.show()
            $('#editNama').val(nama)
            $('#editKelas select').val(kelas)
            $('#editAlamat').val(alamat)
            $('#editId').val(id)
        }
        $('#tombolEdit').on('click', () => {
            const data = $('#formEdit').serialize()
            $.ajax({
                url: './anggota/editAnggota.php',
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
                url: './anggota/tambahAnggota.php',
                method: 'post',
                data,
                success: () => window.location.reload()
            })
        })
        const hapus = (id_anggota) => {
            $.ajax({
                url: './anggota/deleteAnggota.php',
                method: 'post',
                data: `id_anggota=${id_anggota}`,
                success: () => window.location.reload()
            })
        }
    </script>


</body>
<?php include('./footer.html') ?>

</html>