<?php
require __DIR__ . '/../../include/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST["id"]);
    $jutul = $_POST["jutul"];
    $deskripsi = $_POST["deskripsi"];
    $kategori = $_POST["kategori"];

    // Periksa apakah ada file yang diunggah
    if (!empty($_FILES["img"]["name"])) {
        // Ambil file lama untuk dihapus
        $query = "SELECT img FROM Galery WHERE id = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($old_img);
        $stmt->fetch();
        $stmt->close();

        // Hapus file lama
        if ($old_img && file_exists(__DIR__ . "/../../img/Galery/" . $old_img)) {
            unlink(__DIR__ . "/../../img/Galery/" . $old_img);
        }

        // Simpan file baru
        $img = time() . "_" . basename($_FILES["img"]["name"]);
        move_uploaded_file($_FILES["img"]["tmp_name"], __DIR__ . "/../../img/Galery/" . $img);
    } else {
        // Jika tidak ada file baru, gunakan file lama
        $query = "SELECT img FROM Galery WHERE id = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($img);
        $stmt->fetch();
        $stmt->close();
    }

    // Update data di database
    $query = "UPDATE Galery SET img=?, jutul=?, deskripsi=?, kategori=? WHERE id=?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("ssssi", $img, $jutul, $deskripsi, $kategori, $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Data berhasil diperbarui"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal memperbarui data"]);
    }
}
?>
