<?php
require 'upload.php';
require '../../include/config.php'; // File koneksi database

if ($_FILES['img']) {
    $uploadResult = uploadImage($_FILES['img']);

    if ($uploadResult['status']) {
        $imgPath = $uploadResult['filePath'];
        $judul = $_POST['jutul'];
        $deskripsi = $_POST['deskripsi'];
        $kategori = $_POST['kategori'];

        // Simpan ke database
        $stmt = $connect->prepare("INSERT INTO Galery (img, jutul, deskripsi, kategori) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $imgPath, $judul, $deskripsi, $kategori);

        if ($stmt->execute()) {
            echo json_encode(["status" => true, "message" => "Data berhasil disimpan!"]);
        } else {
            echo json_encode(["status" => false, "message" => "Gagal menyimpan data ke database!"]);
        }

        $stmt->close();
    } else {
        echo json_encode($uploadResult);
    }
}
?>
