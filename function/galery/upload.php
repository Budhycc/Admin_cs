<?php
function uploadImage($file, $uploadDir = "../../img/Galery/")
{
    // Pastikan folder upload ada
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    $fileName = basename($file["name"]);
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Validasi tipe file
    if (!in_array($fileExt, $allowedTypes)) {
        return ["status" => false, "message" => "Format gambar tidak didukung!"];
    }

    // Buat nama unik untuk file
    $newFileName = uniqid() . "." . $fileExt;
    $targetFilePath = $uploadDir . $newFileName;

    // Pindahkan file ke folder upload
    if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
        return ["status" => true, "filePath" => $targetFilePath];
    } else {
        return ["status" => false, "message" => "Gagal mengupload gambar!"];
    }
}
?>
