<?php 

session_start();
include "koneksi.php";

if (isset($_SESSION['admin_akses'])) {

        if (in_array("penulis", $_SESSION['admin_akses']) OR in_array("admin", $_SESSION['admin_akses'])) {

        } else {
            header('Location: index.php');
            exit();
        }

} else {
    header('Location: index.php');
    exit();
}
$alert="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $judul = $_POST['judulartikel'];
    $deskripsi = $_POST['deskripsi'];
    $isi = $_POST['isiartikel'];

    // Masukkan data ke dalam tabel
    $sql = "INSERT INTO artikel (judulartikel, deskripsi, isiartikel) VALUES ('$judul', '$deskripsi', '$isi')";

    if ($koneksi->query($sql) === TRUE) {
        $alert= '<div class="alert alert-success" role="alert" width="80%">Artikel berhasil disimpan.</div>';
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
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
  Tulis Artikel
  </title>
  <!--     Fonts and icons     -->
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
        
        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 20px;
        }
    </style>
</head>

<?php include "sidebar.php" ?>

<body class="g-sidenav-show  bg-gray-100">
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
<?php include "header.php" ?>

<div class="text-center mt-2">

    <h4 class="text-light mt-2 text-center btn btn-primary"><b>Form Input Artikel</b></h4>

</div>
<div class="container" id="container">
    <div class="form-container shadow-sm">
        <?= $alert ?>
        <form action="#container" method="post">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Artikel:</label>
                <input type="text" class="form-control" id="judul" name="judulartikel" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi:</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="2" required></textarea>
            </div>

            <div class="mb-3">
                <label for="isi" class="form-label">Isi Artikel:</label>
                <textarea class="form-control" id="isi" name="isiartikel" rows="7" required></textarea>
            </div>
<div class="text-left">

<button type="submit" class="btn btn-dark">Submit</button>

</div>
        </form>
    </div>
</div>


    </main>
    <?php include "footer.php"?>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>


