<?php
    session_start();
    include 'koneksi.php';
    // include 'csrf.php';

    $id = $_POST['id'];
    $query = "SELECT * FROM anggota WHERE id = $id ORDER BY id DESC";
    $sql = $mydb->prepare($query);
    $sql->execute();
    $result = $sql->get_result();
    while ($row = $result->fetch_assoc()) {
        $h['id'] = $row['id'];
        $h['nama'] = $row['nama'];
        $h['jenis_kelamin'] = $row['jenis_kelamin'];
        $h['alamat'] = $row['alamat'];
        $h['no_telp'] = $row['no_telp'];
    }

    echo json_encode($h);
    $mydb->close();
?>