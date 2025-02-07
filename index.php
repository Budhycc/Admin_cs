<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

    <div class="wrapper">
        <!-- Include Sidebar -->
        <?php include 'include/sidebar.php'; ?>

        <!-- Page Content -->
        <div id="content">
            <!-- Include Navbar -->
            <?php include 'include/navbar.php'; ?>

            <!-- Include Main Content -->
            <div id="main-content">
                <?php include 'content/home.php'; ?>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Custom JS -->
    <script src="js/script.js"></script>
    <script>
        $(document).ready(function() {
            // Menangani klik pada menu sidebar
            $('#sidebar a').on('click', function(e) {
                e.preventDefault(); // Mencegah perilaku default link

                var target = $(this).data('target'); // Ambil nilai data-target

                if (target) {
                    // Muat konten ke dalam #main-content
                    $('#main-content').load(target);
                }
            });
        });
    </script>
</body>
</html>