<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedBuah = $_POST['buah'];

    if (isset($_POST['warna'])) {
        $selectedWarna = $_POST['warna'];
    } else {
        $selectedWarna = [];
    }

    $selectedJenisKelamin = $_POST['jenis_kelamin'];

    echo "Anda memilih buah: " . $selectedBuah . "<br>";

    if (empty($selectedWarna)) {
        echo "Anda tidak memilih warna favorit.<br>";
    } else {
        echo "Warna favorit Anda: " . implode(", ", $selectedWarna) . "<br>";
    }

    echo "Jenis kelamin Anda: " . $selectedJenisKelamin;
}
?>