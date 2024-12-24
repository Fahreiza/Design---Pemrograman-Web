<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container mt-4">
        <h2>Data Anggota</h2>
        <a class="btn btn-success mt-2" href="create.php">Tambah Data</a>
        <br><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('koneksi.php');

                $query = "SELECT * FROM anggota ORDER BY id DESC";
                $stmt = $koneksi->query($query);
                if ($stmt->rowCount() === 0) {
                ?>
                    <tr>
                        <td colspan="6" class="text-center text-danger">Tidak ada data anggota.</td>
                    </tr>
                <?php
                } else {
                    $no = 1;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $kelamin = ($row['jenis_kelamin'] === 'L') ? 'Laki-laki' : 'Perempuan';
                ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $kelamin ?></td>
                            <td><?= $row['alamat'] ?></td>
                            <td><?= $row['no_telp'] ?></td>
                            <td>
                                <a class="btn btn-primary" href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                                <a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $row['id'] ?>">Hapus</a>
                            </td>
                        </tr>
                        <div class="modal fade" id="hapusModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="hapusModal<?= $row['id'] ?>Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="hapusModal<?= $row['id'] ?>Label">Konfirmasi Hapus!</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?= "Apakah anda yakin ingin menghapus anggota <b>'" . $row['nama'] . "'</b>?" ?>
                                    </div>
                                    <div class="modal-footer">
                                        <a class="btn btn-danger" href="proses.php?aksi=hapus&id=<?= $row['id'] ?>">Hapus</a>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>
