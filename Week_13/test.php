<?php
include('koneksi.php');

// Query untuk mengambil data
$query = "SELECT * FROM anggota ORDER BY id DESC";
$stmt = sqlsrv_query($koneksi, $query);

// Cek apakah query berhasil
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Ambil data menggunakan sqlsrv_fetch_assoc()
while ($row = sqlsrv_fetch_assoc($stmt)) {
    echo "Nama: " . $row['nama'] . "<br>";
    echo "Jenis Kelamin: " . $row['jenis_kelamin'] . "<br>";
    echo "Alamat: " . $row['alamat'] . "<br>";
    echo "No Telp: " . $row['no_telp'] . "<br>";
}

// Menutup koneksi
sqlsrv_free_stmt($stmt);
sqlsrv_close($koneksi);
?>
