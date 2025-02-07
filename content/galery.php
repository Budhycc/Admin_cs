<div class="container-fluid">
    <?php
    require '../function/galery/get_galery.php';
    ?>
    <h1 class="text-center mt-4">Galery</h1>

    <!-- Form untuk Create/Update -->
    <form id="galeryForm" class="mb-4 p-4 bg-light rounded">
        <input type="hidden" id="id" name="id">
        <div class="mb-3">
            <label for="img" class="form-label">File Gambar</label>
            <input type="file" class="form-control" id="img" name="img" accept="image/*" required>
        </div>
        <div class="mb-3">
            <label for="jutul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="jutul" name="jutul" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <input type="text" class="form-control" id="kategori" name="kategori" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    <!-- Tabel untuk Read -->
    <div class="table-responsive p-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="galeryTableBody">
                <!-- Data akan dimasukkan di sini melalui JavaScript -->
                <?php echo getGaleryTable(); ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Edit Galeri -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Galeri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editGaleryForm">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-3">
                        <label for="edit_img" class="form-label">File Gambar (Kosongkan jika tidak ingin mengganti)</label>
                        <input type="file" class="form-control" id="edit_img" name="img" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="edit_jutul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="edit_jutul" name="jutul" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="edit_deskripsi" name="deskripsi" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_kategori" class="form-label">Kategori</label>
                        <input type="text" class="form-control" id="edit_kategori" name="kategori" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <script>
        document.getElementById("galeryForm").addEventListener("submit", function (event) {
            event.preventDefault();

            let formData = new FormData(this);

            fetch("function/galery/save_galery.php", {
                method: "POST",
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.status) {
                        location.reload();
                    }
                })
                .catch(error => console.error("Error:", error));
        });

        // Event listener untuk tombol Hapus
        document.addEventListener("click", function (event) {
            if (event.target.classList.contains("delete-btn")) {
                let id = event.target.getAttribute("data-id");

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
        });

        document.addEventListener("click", function (event) {
            // Jika tombol Edit ditekan
            if (event.target.classList.contains("edit-btn")) {
                let id = event.target.getAttribute("data-id");

                // Ambil data dari server
                fetch(`function/galery/get_galery.php?id=${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("edit_id").value = data.id;
                        document.getElementById("edit_jutul").value = data.jutul;
                        document.getElementById("edit_deskripsi").value = data.deskripsi;
                        document.getElementById("edit_kategori").value = data.kategori;

                        // Tampilkan modal
                        var editModal = new bootstrap.Modal(document.getElementById("editModal"));
                        editModal.show();
                    })
                    .catch(error => console.error("Error:", error));
            }
        });

        // Tangani submit form edit
        document.getElementById("editGaleryForm").addEventListener("submit", function (event) {
            event.preventDefault();

            let formData = new FormData(this);

            fetch("function/galery/update_galery.php", {
                method: "POST",
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload(); // Refresh halaman setelah update
                })
                .catch(error => console.error("Error:", error));
        });

    </script>
    <script src="../function/galery/script.js"></script>

</div>