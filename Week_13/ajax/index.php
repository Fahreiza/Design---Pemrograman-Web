<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anggota</title>
    <script src="https://kit.fontawesome.com/255fd51aa4.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
</head>
<body>
    <div class="navbar navbar-dark bg-primary">
        <a href="index.php" class="navbar-brand" style="color: white;">CRUD dengan AJAX</a>
    </div>

    <div class="container">
        <h2 align="center" style="margin: 30px;">Data Anggota</h2>
        <form method="POST" class="form-data" id="form-data">
            <div class="row mt-2">
                <div class="col-sm-9">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="hidden" name="id" id="id">
                        <input type="text" name="nama" id="nama" class="form-control" required>
                        <span class="text-danger" id="err_nama"></span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <input type="radio" name="jenis_kelamin" id="jenkel1" value="L" required>
                        <input type="radio" name="jenis_kelamin" id="jenkel2" value="P" required>
                    </div>
                    <span class="text-danger" id="err_jenis_kelamin"></span>
                </div>
            </div>
            <div class="form-group mt-2">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                <span class="text-danger" id="err_alamat"></span>
            </div>
            <div class="form-group mt-2">
                <label for="no_telp">No. Telpon</label>
                <input type="number" name="no_telp" id="no_telp" class="form-control" required>
                <span class="text-danger" id="err_no_telp"></span>
            </div>
            <div class="form-group mt-4">
                <button type="button" name="simpan" id="simpan" class="btn btn-primary">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </div>
        </form>
        <hr>
        <div class="data"></div>
    </div>

    <div class="text-center">
        &copy; <?= date('Y') ?> Copyright: <a href="https://www.malasngoding.com">Desain dan Pemrograman Web</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'Csrf-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.data').load("data.php");
        });

        $('#simpan').click(function() {
            let data = $('.form-data').serialize();
            let jenkel1 = document.getElementById('jenkel1');
            let jenkel2 = document.getElementById('jenkel2');
            let nama = document.getElementById('nama');
            let alamat = document.getElementById('alamat');
            let no_telp = document.getElementById('no_telp');

            if (nama === "") {
                document.getElementById('err_nama').innerHTML = "Nama harus diisi";
            } else {
                document.getElementById('err_nama').innerHTML = "";
            }

            if (alamat === "") {
                document.getElementById('err_alamat').innerHTML = "Alamat harus diisi";
            } else {
                document.getElementById('err_alamat').innerHTML = "";
            }

            if (no_telp === "") {
                document.getElementById('err_no_telp').innerHTML = "No. Telp harus diisi";
            } else {
                document.getElementById('err_no_telp').innerHTML = "";
            }

            if (jenkel1.checked === false && jenkel2.checked === false) {
                document.getElementById('err_jenis_kelamin').innerHTML = "Jenis Kelamin harus diisi";
            } else {
                document.getElementById('err_jenis_kelamin').innerHTML = "";
            }

            if (nama !== "" && alamat !== "" && no_telp !== "" && (jenkel1.checked === true || jenkel2.checked === true)) {
                $.ajax({
                    type: 'POST',
                    url: 'form_action.php',
                    data: data,
                    success: function() {
                        $('.data').load("data.php");
                        document.getElementById('id').value = "";
                        document.getElementById('form-data').reset();
                    },
                    error: function(response) {
                        console.log(response.responseText);
                    }
                });
            }
        });
    </script>
</body>
</html>