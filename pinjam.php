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
    <title>Peminjaman | PERPUS JALAN</title>
</head>

<body>
    <?php include('./navbar.html') ?>
    <div class="container mb-5" style="margin-top: 100px; height: 100vh;">
        <div class="tabel-anggota">
            <div class="card col-12 shadow">
                <div class="p-3 d-flex justify-content-between">

                    <h2 class="">Data Peminjaman</h2>
                    <button onclick="tambah()" class="btn btn-dark">
                        Tambah Peminjaman
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered ">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>NO</th>
                                    <th>JUDUL BUKU</th>
                                    <th>NAMA PEMINJAM</th>
                                    <th>KELAS</th>
                                    <th>TANGGAL</th>
                                    <th>TANGGAL KEMBALI</th>
                                    <th>STATUS</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $result = mysqli_query($koneksi, 'SELECT * FROM peminjaman INNER JOIN buku ON peminjaman.id_buku = buku.id_buku INNER JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota INNER JOIN kelas ON anggota.id_kelas = kelas.id_kelas');
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
                                            <?= $row['nama'] ?>
                                        </td>
                                        <td>
                                            <?= $row['nama_kelas'] ?>
                                        </td>
                                        <td>
                                            <?= $row['tanggal'] ?>
                                        </td>
                                        <td>
                                            <?= $row['tanggal_kembali'] ?>
                                        </td>
                                        <td>
                                            <?php if($row['statuss'] == 1) {
                                                echo $statuss = '<span class="badge bg-success">DIKEMBALIKAN</span>';
                                                }
                                                else if($row['statuss'] == 0) {
                                                    echo $statuss = '<span class="badge bg-danger">DIPINJAM</span>';
                                                }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-warning my-1 my-md-0" onclick="edit('<?= $row['tanggal'] ?>','<?= $row['tanggal_kembali'] ?>',<?= $row['id_peminjaman']?>)">Edit</button>
                                            <button onclick="hapus(<?= $row['id_peminjaman']; ?>)" class="btn btn-danger my-1 my-md-0">Hapus</button>
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
                            <input type="hidden" name="id_pinjam" id="id_pinjam">
                            <label class="form-label">Nama Buku</label>
                            <select class="form-control" name="id_buku"> 
                                <?php
                                $result = mysqli_query($koneksi, 'SELECT * from buku');
                                while ($row = mysqli_fetch_assoc($result)) :
                                ?>
                                    <option value="<?= $row['id_buku'] ?>"><?= $row['judul'] ?> - <?= $row['tahun'] ?> - <?= $row['pengarang'] ?> - <?= $row['penerbit'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Peminjam</label>
                            <select class="form-control" name="id_anggota">
                                <?php
                                $result = mysqli_query($koneksi, 'SELECT * from anggota INNER JOIN kelas ON anggota.id_kelas = kelas.id_kelas');
                                while ($row = mysqli_fetch_assoc($result)) :
                                ?>
                                    <option value="<?= $row['id_anggota'] ?>"><?= $row['nama'] ?> - <?= $row['nama_kelas'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select id="idStatus" class="form-control" name="statuss">
                               <option value="0">DIPINJAM</option>
                               <option value="1">DIKEMBALIKAN</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlinput1" class="form-label">Tanggal Pinjam</label>
                            <input id="editTglPinjam" type="date" name="tgl_pinjam" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlinput1" class="form-label">Tanggal Kembali</label>
                            <input id="editTglKembali" type="date" name="tgl_kembali" class="form-control">
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
                    <h5 class="modal-title">Data Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambah">
                        <div class="mb-3">
                            <label class="form-label">Judul Buku</label>
                            <select list="buku" class="form-control" name="id_buku"> 
                                <?php
                                $result = mysqli_query($koneksi, 'SELECT * from buku');
                                while ($row = mysqli_fetch_assoc($result)) :
                                ?>
                                    <option value="<?= $row['id_buku'] ?>"><?= $row['judul'] ?> - <?= $row['tahun'] ?> - <?= $row['pengarang'] ?> - <?= $row['penerbit'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Peminjam</label>
                            <select class="form-control" name="id_anggota" placeholder="Ketik untuk mencari data">
                                <?php
                                $result = mysqli_query($koneksi, 'SELECT * from anggota INNER JOIN kelas ON anggota.id_kelas = kelas.id_kelas');
                                while ($row = mysqli_fetch_assoc($result)) :
                                ?>
                                    <option value="<?= $row['id_anggota'] ?>"><?= $row['nama'] ?> - <?= $row['nama_kelas'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d'); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Tanggal Kembali</label>
                            <input type="date" name="tanggal_kembali" class="form-control">
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
        const edit = (tglPinjam,tglKembali, id) => {
            var myModal = new bootstrap.Modal(document.getElementById('edit'), {
                keyboard: false
            })
            myModal.show()
            $('#editTglPinjam').val(tglPinjam)
            $('#editTglKembali').val(tglKembali)
            $('#id_pinjam').val(id)
        }
        $('#tombolEdit').on('click', () => {
            const data = $('#formEdit').serialize()
            $.ajax({
                url: './buku/editPinjaman.php',
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
                url: './buku/tambahPinjaman.php',
                method: 'post',
                data,
                success: () => window.location.reload()
            })
        })
        const hapus = (id_pinjaman) => {
            $.ajax({
                url: './buku/deletePinjaman.php',
                method: 'post',
                data: `id_pinjaman=${id_pinjaman}`,
                success: () => window.location.reload()
            })
        }
    </script>


</body>
<?php include('./footer.html') ?>

</html>