<?php
// Definisikan konstanta untuk informasi koneksi
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '090701');
define('DB_NAME', 'Admin_cs');

// Aktifkan reporting untuk mysqli
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Buat koneksi ke database
    $connect = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Set charset ke utf8 (opsional)
    $connect->set_charset("utf8");

    // Contoh penggunaan koneksi
    // $query = "SELECT * FROM users";
    // $result = $connect->query($query);

    // Tutup koneksi (opsional, karena akan otomatis ditutup saat script selesai)
    // $connect->close();

} catch (mysqli_sql_exception $e) {
    // Tangani error dan tampilkan pesan yang jelas
    die("Koneksi ke database gagal: " . $e->getMessage());
}
?>