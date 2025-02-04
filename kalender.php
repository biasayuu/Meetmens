<?php 
session_start();
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
  Kalender
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
            margin-top: 50px;
        }
    </style>
</head>

<?php include "sidebar.php" ?>

<body class="g-sidenav-show  bg-gray-100">
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
<?php include "header.php" ?>
<?php 
if (isset($_SESSION['admin_akses'])) {
$nama =  $_SESSION['admin_nama'];
$sql = "SELECT * FROM kalender order by nama = '$nama' desc";
$hasil = mysqli_query($koneksi, $sql);


$no=1;
while ($d = mysqli_fetch_array($hasil)) { 
$tanggal= explode("-", $d["tanggal_awal"]);
// print_r($tanggal);
?>
    <div class="container mt-5">
        <h2> <?= $no ?>. Perhitungan Siklus Menstruasi <span class="text-primary"><?= $tanggal['2']."-".$tanggal['1']."-".$tanggal['0']?></span></h2>
        <form>
            <div class="mb-3">
                <label for="perkiraan_menstruasi" class="form-label">Perkiraan menstruasi bulan depan:</label>
                <input type="text" class="form-control" id="perkiraan_menstruasi" value="<?= $d['bulan_depan'] ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="ovulasi" class="form-label">Perkiraan ovulasi:</label>
                <input type="text" class="form-control" id="ovulasi" value="<?= $d['ovulasi'] ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="akhir_menstruasi" class="form-label">Perkiraan hari terakhir menstruasi:</label>
                <input type="text" class="form-control" id="akhir_menstruasi" value="<?= $d['ahkir'] ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="rentang_waktu" class="form-label">Rentang waktu yang dihindari untuk kehamilan:</label>
                <input type="text" class="form-control" id="rentang_waktu" value="<?= $d['rentang_awal'] ?> sampai <?= $d['rentang_ahkir'] ?>" readonly>
            </div>
        </form>
    </div>

<?php 
$no++; }

} else { ?>
  <div class="container text-center">
        <a class="btn btn-primary m-5" href="login_user.php">Silahkan Login Terlebih Dahulu</a>
    </div>
<?php
}
?>



    </main>
    <?php include "footer.php"?>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>


