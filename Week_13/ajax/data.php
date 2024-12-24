<table id="example" class="table table-striped table-bordered" style="width: 100%;">
    <thead>
        <tr>
            <td>No</td>
            <td>Nama</td>
            <td>Jenis Kelamin</td>
            <td>Alamat</td>
            <td>No Telpon</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <?php
            include 'koneksi.php';
            $no = 1;
            $query = "SELECT * FROM anggota ORDER BY id DESC";
            $sql = $mydb->prepare($query);
            $sql->execute();
            $result = $sql->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $nama = $row['nama'];
                    $jenis_kelamin = ($row['jenis_kelamin'] == 'L') ? 'Laki-laki' : 'Perempuan';
                    $alamat = $row['alamat'];
                    $no_telp = $row['no_telp'];
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $nama ?></td>
                    <td><?= $jenis_kelamin ?></td>
                    <td><?= $alamat ?></td>
                    <td><?= $no_telp ?></td>
                    <td>
                        <button id="<?= $id ?>" class="btn btn-success btn-sm edit-data">
                            <i class="fa fa-edit"></i> Edit
                        </button>
                        <button id="<?= $id ?>" class="btn btn-danger btn-sm hapus-data">
                            <i class="fa fa-trash"></i> Hapus
                        </button>
                    </td>
                </tr>
            <?php
                }
            } else {
            ?>
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data ditemukan</td>
                </tr>
            <?php
            }
        ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });

    function reset() {
        document.getElementById('err_nama').innerHTML = '';
        document.getElementById('err_alamat').innerHTML = '';
        document.getElementById('err_no_telp').innerHTML = '';
        document.getElementById('err_jenis_kelamin').innerHTML = '';
    }

    $('.edit-data').click(function() {
        $('html', 'body').animate({ scrollTop: 0 }, 'slow');
        let id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: 'get_data.php',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                reset();
                $('html', 'body').animate({ scrollTop: 30 }, 'slow');
                document.getElementById('id').value = response.id;
                document.getElementById('nama').value = response.nama;
                document.getElementById('alamat').value = response.alamat;
                document.getElementById('no_telp').value = response.no_telp;

                if (response.jenis_kelamin === 'L') {
                    document.getElementById('jenkel1').checked = true;
                } else {
                    document.getElementById('jenkel2').checked = true;
                }
            },
            error: function(response) {
                console.log(response.responseText);
            }
        });
    });

    $('.hapus-data').click(function() {
        let id = $(this).attr('id');

        $.ajax({
            type: 'POST',
            url: 'hapus_data.php',
            data: {
                id: id
            },
            success: function() {
                $('.data').load('data.php');
            },
            error: function(response) {
                console.log(response.responseText);
            }
        });
    });
</script>