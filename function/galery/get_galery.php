<?php
//require '../../include/config.php';
require __DIR__ . '/../../include/config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "SELECT * FROM Galery WHERE id = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        echo json_encode($row);
    } else {
        echo json_encode(["status" => "error", "message" => "Data tidak ditemukan"]);
    }
}
function getGaleryTable()
{
    global $connect;

    // Query untuk mengambil data dari database
    $sql = "SELECT * FROM Galery ORDER BY id DESC";
    $result = $connect->query($sql);

    // Cek apakah ada data
    if ($result->num_rows > 0) {
        $table = '<table class="table table-bordered">';
        $table .= '<thead>
                    <tr>
                        <th>ID</th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                  </thead>';
        $table .= '<tbody>';

        // Loop untuk menampilkan data
        while ($row = $result->fetch_assoc()) {
            $table .= '<tr>';
            $table .= '<td>' . $row['id'] . '</td>';
            $table .= '<td><img src="../img/Galery/' . $row['img'] . '" width="100"></td>';
            $table .= '<td>' . htmlspecialchars($row['jutul']) . '</td>';
            $table .= '<td>' . htmlspecialchars($row['deskripsi']) . '</td>';
            $table .= '<td>' . htmlspecialchars($row['kategori']) . '</td>';
            $table .= '<td>
            <button class="btn btn-warning btn-sm edit-btn" data-id="' . $row['id'] . '">Edit</button>
            <button class="btn btn-danger btn-sm delete-btn" data-id="' . $row['id'] . '">Hapus</button>
                    </td>';
            $table .= '</tr>';
        }

        $table .= '</tbody></table>';
    } else {
        $table = '<p class="text-center">Tidak ada data galeri.</p>';
    }

    return $table;
}

// Jika dipanggil langsung lewat AJAX, kirim output JSON
if (isset($_GET['fetch'])) {
    echo json_encode(["status" => true, "html" => getGaleryTable()]);
}
?>