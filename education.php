<?php 

session_start();
include 'koneksi.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
  Education
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    
</head>
<?php include "sidebar.php" ?>

<body class="g-sidenav-show  bg-gray-100">
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
<?php include "header.php" ?>

    <?php if (isset($_SESSION['admin_akses'])) { ?>
    
  <div class="container">
  <div class="row">
    <div class="col-lg-7 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="embed-responsive embed-responsive-16by9">
          <iframe width="500" height="315" src="https://www.youtube.com/embed/Pg9neJRGnaY?si=je1Uc5cQFb5vpYO_?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
          </div>
          <h5 class="card-title">5 PENYAKIT ORGAN REPRODUKSI, INI CARA MENGOBATI DAN MENCEGAHNYA - KATA DOKTER BETTER</h5>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-lg-7 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="embed-responsive embed-responsive-16by9">
          <iframe width="500" height="315" src="https://www.youtube.com/embed/YhE-Iq435E0?si=DpsvlgTfeAdhMsBu" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
          </div>
          <h5 class="card-title">MITOS DAN FAKTA KANKER SERVIKS | MOEWARDI CARE TO CANCER</h5>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-lg-7 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="embed-responsive embed-responsive-16by9">
          <iframe width="500" height="315" src="https://www.youtube.com/embed/xYN6vuQzpvg?si=gWruue5GQSznQQlv" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
          </div>
          <h5 class="card-title">Video Edukasi "Pengenalan Kesehatan Reproduksi untuk Anak"</h5>
        </div>
      </div>
    </div>
    <!-- Menambahkan kolom-kolom lainnya seperti di contoh Anda -->
  </div>
</div>


<div class="container">
  <div class="row">
    <div class="col-lg-7 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="embed-responsive embed-responsive-16by9">
          <iframe width="500" height="315" src="https://www.youtube.com/embed/EetIBkWcQZw?si=bAXzr0Nr_7u0SNQs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
          </div>
          <h5 class="card-title">Cara Menjaga Organ Reproduksi Wanita - Sehatpedia</h5>
        </div>
      </div>
    </div>
    <!-- Menambahkan kolom-kolom lainnya seperti di contoh Anda -->
  </div>
</div>



    <?php } else { ?>
    <div class="container text-center">
        <a class="btn btn-primary m-5" href="login_user.php">Silahkan Login Terlebih Dahulu</a>
    </div>
    <?php } ?>
    </main>
    <?php include "footer.php"?>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>