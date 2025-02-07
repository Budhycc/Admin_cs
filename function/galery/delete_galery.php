<?php
require __DIR__ . '/../../include/config.php'; // Hubungkan ke database

function deleteGalery($id) {
    global $connect;

    // Ambil informasi gambar sebelum dihapus
    $query = "SELECT img FROM Galery WHERE id = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($img);
    $stmt->fetch();
    $stmt->close();

    if ($img) {
        // Hapus file gambar dari folder (pastikan path benar)
        $filePath = __DIR__ . '/../../img/Galery/' . $img;
        if (file_exists($filePath)) {
            unlink($filePath); // Hapus file dari server
        }
        
        // Hapus data dari database
        $query = "DELETE FROM Galery WHERE id = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        return ["status" => "success", "message" => "Data berhasil dihapus"];
    } else {
        return ["status" => "error", "message" => "Data tidak ditemukan"];
    }
}

// Jika menerima request dengan parameter 'id'
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $response = deleteGalery($id);
    echo json_encode($response);
}
?>
