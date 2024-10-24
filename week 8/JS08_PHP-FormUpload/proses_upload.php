<?php
if (isset($_POST["submit"])) {
    $targetdir = "uploads/"; // Direktori untuk menyimpan file yang diunggah

    // Periksa apakah direktori penyimpanan ada, jika tidak maka buat
    if (!file_exists($targetdir)) {
        mkdir($targetdir, 0777, true);
    }

    $totalFiles = count($_FILES["myfile"]["name"]);
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    $maxsize = 5 * 1024 * 1024;

    // Loop untuk menangani beberapa file
    for ($i = 0; $i < $totalFiles; $i++) {
        $fileName = basename($_FILES["myfile"]["name"][$i]);
        $targetfile = $targetdir . $fileName;
        $fileType = strtolower(pathinfo($targetfile, PATHINFO_EXTENSION));

        if (in_array($fileType, $allowedExtensions) && $_FILES["myfile"]["size"][$i] <= $maxsize) {
            if (move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], $targetfile)) {
                echo "File $fileName berhasil diunggah.<br>";

                // Generate thumbnail image
                $thumbnailWidth = 200;
                $thumbnailHeight = 0; // Otomatis hitung tinggi
                $thumbnailFile = $targetdir . "thumb_" . $fileName;

                $sourceImage = imagecreatefromstring(file_get_contents($targetfile));
                $sourceWidth = imagesx($sourceImage);
                $sourceHeight = imagesy($sourceImage);

                if ($sourceWidth > $thumbnailWidth) {
                    $thumbnailHeight = round(($thumbnailWidth / $sourceWidth) * $sourceHeight);
                } else {
                    $thumbnailWidth = $sourceWidth;
                    $thumbnailHeight = $sourceHeight;
                }

                // Buat gambar thumbnail
                $thumbnailImage = imagecreatetruecolor((int)$thumbnailWidth, (int)$thumbnailHeight);
                imagecopyresampled($thumbnailImage, $sourceImage, 0, 0, 0, 0, (int)$thumbnailWidth, (int)$thumbnailHeight, $sourceWidth, $sourceHeight);

                // Simpan gambar thumbnail
                if (imagejpeg($thumbnailImage, $thumbnailFile, 90)) {
                    echo "Thumbnail $fileName berhasil dibuat.<br>";
                    echo "<img src='$thumbnailFile' width='$thumbnailWidth' height='$thumbnailHeight' alt='Thumbnail Image'><br>";
                } else {
                    echo "Gagal membuat thumbnail $fileName.<br>";
                }

                imagedestroy($sourceImage);
                imagedestroy($thumbnailImage);
            } else {
                echo "Gagal mengunggah file $fileName.<br>";
            }
        } else {
            echo "File $fileName tidak valid atau melebihi ukuran maksimum.<br>";
        }
    }
}
?>
