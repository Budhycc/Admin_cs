function loadGaleryTable() {
    $.get("function/galery/get_galery.php?fetch=1", function(response) {
        let data = JSON.parse(response);
        if (data.status) {
            $(".table-responsive").html(data.html);
        }
    });
}

// Panggil saat halaman selesai dimuat
$(document).ready(function() {
    loadGaleryTable();
});

function hapusGalery(id) {
    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        fetch(`function/galery/delete_galery.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                location.reload(); // Refresh halaman setelah menghapus
            })
            .catch(error => console.error("Error:", error));
    }
}
