<?php 
session_start();
include "koneksi.php";

if (isset($_SESSION['admin_akses'])) {
    if (!in_array("admin", $_SESSION['admin_akses'])){
        header('Location: index.php');
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}

// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM `user` WHERE `id` = '$delete_id'";
    mysqli_query($koneksi, $delete_query);
    header('Location: tampilakun.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="assets/img/favicon.png">
<title>
Tampil Akun
</title>
<!-- Fonts and icons -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<!-- Nucleo Icons -->
<link href="assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="assets/css/nucleo-svg.css" rel="stylesheet" />
<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<link href="assets/css/nucleo-svg.css" rel="stylesheet" />
<!-- CSS Files -->
<link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
<!-- Nepcha Analytics (nepcha.com) -->
<!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
<script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<style>
    .custom-table th, .custom-table td {
        border: 2px solid #dee2e6;
    }
    .custom-table thead th {
        background-color: #f8f9fa;
    }
</style>
</head>

<?php include "sidebar.php" ?>

<body class="g-sidenav-show bg-gray-100">
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
<?php include "header.php" ?>

<div class="container mt-4">
<?php 
if (isset($_SESSION['admin_akses'])) {
    $query = "SELECT * FROM `user` WHERE 1";
    $tampil = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($tampil) > 0) {
        echo '<table class="table table-striped custom-table">';
        echo '<thead><tr><th>Nama</th><th>Username</th><th>Jenis Kelamin</th><th>Aksi</th></tr></thead>';
        echo '<tbody>';

        while ($a = mysqli_fetch_array($tampil)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($a['nama']) . '</td>';
            echo '<td>' . htmlspecialchars($a['username']) . '</td>';
            echo '<td>' . htmlspecialchars($a['jenis_kelamin']) . '</td>';
            echo '<td><a href="?delete_id=' . htmlspecialchars($a['id']) . '" class="btn btn-danger btn-sm">Hapus</a></td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<div class="alert alert-warning" role="alert">Tidak ada data akun yang ditemukan.</div>';
    }
} else {
?>
<div class="container text-center">
    <a class="btn btn-primary m-5" href="login_user.php">Silahkan Login Terlebih Dahulu</a>
</div>
<?php
}
?>
</div>

</main>
<?php include "footer.php"?>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
