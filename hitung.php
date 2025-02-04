<?php 

session_start();
include 'koneksi.php';
?>

<?php
$tampil_komen ="";
if (isset($_POST['kirim'])) {
function hitungSiklusMenstruasi($tanggalAwal, $durasiSiklus, $lamaMasaMenstruasi) {
    $tanggalAwalBulanDepan = date('Y-m-d', strtotime($tanggalAwal . ' + ' . $durasiSiklus . ' days'));

    $ovulasi = date('Y-m-d', strtotime($tanggalAwalBulanDepan . ' - 14 days'));

    $akhirMenstruasi = date('Y-m-d', strtotime($tanggalAwalBulanDepan . ' + ' . $lamaMasaMenstruasi . ' days'));

    $awalRentang = date('Y-m-d', strtotime($ovulasi . ' - 5 days'));
    $akhirRentang = date('Y-m-d', strtotime($ovulasi . ' + 4 days'));

    $hasil = array(
        'tanggal_awal' => $tanggalAwalBulanDepan,
        'ovulasi' => $ovulasi,
        'akhir_menstruasi' => $akhirMenstruasi,
        'awal_rentang' => $awalRentang,
        'akhir_rentang' => $akhirRentang
    );

    return $hasil;

    
}


if (isset($_POST["tanggal_awal"]) && isset($_POST["durasi_siklus"]) && isset($_POST["lama_masa_menstruasi"])) {
    $tanggalAwal = $_POST["tanggal_awal"]; // Tanggal awal menstruasi
    $durasiSiklus = $_POST["durasi_siklus"]; // Durasi siklus menstruasi dalam hari
    $lamaMasaMenstruasi = $_POST["lama_masa_menstruasi"]; // Lama masa menstruasi dalam hari

    $hasilPerhitungan = hitungSiklusMenstruasi($tanggalAwal, $durasiSiklus, $lamaMasaMenstruasi);

// Contoh penggunaan
$nama = $_SESSION['admin_nama'];
$bulan_depan= $hasilPerhitungan['tanggal_awal'];
$ovulasi= $hasilPerhitungan['ovulasi'];
$ahkir= $hasilPerhitungan['akhir_menstruasi'];
$rentang_awal= $hasilPerhitungan['awal_rentang'] ;
$rentang_ahkir= $hasilPerhitungan['akhir_rentang'];



$sql_cek = "SELECT COUNT(*) AS total FROM kalender WHERE nama='$nama' AND tanggal_awal='$tanggalAwal'";
$result_cek = mysqli_query($koneksi, $sql_cek);
$row = mysqli_fetch_assoc($result_cek);
$total = $row['total'];

if ($total > 0) {
   $tampil_komen = '<span class="text-secondary">Data yang sama sudah ada</span> ';
} else {
    // Insert data ke database
    $sql = "INSERT INTO kalender (nama, tanggal_awal, bulan_depan, ovulasi, ahkir, rentang_awal, rentang_ahkir) 
            VALUES ('$nama','$tanggalAwal','$bulan_depan','$ovulasi','$ahkir','$rentang_awal','$rentang_ahkir')
            ON DUPLICATE KEY UPDATE
            nama=VALUES(nama), tanggal_awal=VALUES(tanggal_awal), bulan_depan=VALUES(bulan_depan), 
            ovulasi=VALUES(ovulasi), ahkir=VALUES(ahkir), rentang_awal=VALUES(rentang_awal), rentang_ahkir=VALUES(rentang_ahkir)";
    $hasil = mysqli_query($koneksi, $sql);

    if ($hasil) {
        echo "<script>alert('Data berhasil disimpan'); window.location = 'kalender.php'</script>";
    } else {
       $tampil_komen = '<span class="text-danger">Gagal menyimpan data  </span>';
    }
}
} else {
$tampil_komen = "Mohon masukkan tanggal awal menstruasi, durasi siklus, dan lama masa menstruasi.";
} 
$koneksi->close();
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
  Penghuting Mens
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

    <?php if (isset($_SESSION['admin_akses'])) { ?>
    <div class="container">
        <div class="form-container">
            <h4 class="text-primary mt-2 text-center">Perkiraan Siklus Menstruasi</h4>
            <form action="" method="POST" role="form">
              <h6><?= $tampil_komen ?></h6>
                <div class="form-floating">
                    <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" required>
                    <label class="text-secondary" for="floatingInput">Tanggal Awal Menstruasi</label>
                </div>
                <div class="form-floating mt-2">
                    <input type="number" class="form-control" id="durasi_siklus" name="durasi_siklus" min="1" required>
                    <label class="text-secondary" for="floatingPassword">Durasi Siklus Menstruasi</label>
                </div>
                <div class="form-floating mt-2">
                    <input type="number" class="form-control" id="lama_masa_menstruasi" name="lama_masa_menstruasi" min="1" required>
                    <label class="text-secondary" for="floatingPassword">Lama Masa Menstruasi</label>
                </div>
                <button type="submit" name="kirim" class="btn btn-primary mt-3">Hitung</button>
                <a class="btn btn-warning mt-3" href="kalender.php">Cek Kalender</a>
            </form>
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
