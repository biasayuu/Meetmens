<?php 

date_default_timezone_set("Asia/jakarta");

session_start();
include 'koneksi.php';

if (isset($_SESSION['admin_akses'])) {
    $user = $_SESSION['admin_nama'];

    if (isset($_POST['kirim'])) {
        $usr = $_SESSION['admin_nama'];
        $nama = $_SESSION['nama'];
        $waktu = date('Y-m-d H:i:s');
        $chat = $_POST['chat']; 

        $sql = "INSERT INTO chat(id, username, nama, chat, waktu) VALUES ('','$usr','$nama','$chat','$waktu')";
        if (!mysqli_query($koneksi, $sql)) {
            die("Error: " . mysqli_error($koneksi));
        }
    }

    $query = "SELECT * FROM chat WHERE 1";
    $hasil = mysqli_query($koneksi, $query);
    if (!$hasil) {
        die("Error: " . mysqli_error($koneksi));
    }

    $query1 = "SELECT * FROM chat ORDER BY id DESC LIMIT 1";
    $hasil1 = mysqli_query($koneksi, $query1);
    if (!$hasil1) {
        die("Error: " . mysqli_error($koneksi));
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
<title>Curhatan Gadis</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<link href="assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="assets/css/nucleo-svg.css" rel="stylesheet" />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
<script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
<style>
.bubble {
    position: relative;
    display: inline-block;
    background-color: #EEEEEE;
    border-radius: 20px;
    padding: 15px 20px;
    margin-bottom: 20px;
    margin-top: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    word-wrap: break-word;
    text-align: right;
}

.bubble::before {
    content: '';
    position: absolute;
    top: -10px;
    left: 20px;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0 10px 10px 10px;
    border-color: transparent transparent #EEEEEE transparent;
}

.kiri {
    margin-right: 4px;
}
.kanan {
    margin-right: 4px;
}
</style>
</head>

<?php include "sidebar.php" ?>

<body class="g-sidenav-show bg-gray-100">
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
<?php include "header.php" ?>

<?php
if (isset($hasil)) {
    $no = 1;
    while ($a = mysqli_fetch_array($hasil)) {
        $tanggal = $a['waktu'];
        $tanggal2 = date('d F Y, H:i', strtotime($tanggal));
        $tampil_tanggal = explode(',', $tanggal2);
        $no++;
        $ag = ($a['nama'] == $user) ? "right" : "left";
        echo '<h6 align="'.$ag.'" class="card-title text-dark '.$ag.'"><strong>'.$a['nama'].'</strong> |<sup> <span class="text-secondary">'.$tampil_tanggal[0].'</sup></span></h6>';
        echo '<div align="'.$ag.'" id="'.$a['id'].'">'.$a['chat'].'<sub align="'.$ag.'" class="kiri">'.$tampil_tanggal[1].'</sub></div>';
        echo '<hr align="right" class="horizontal dark my-1">';
    }
}
?>
<?php if (isset($_SESSION["admin_akses"])) { ?>

<form action="" method="POST">
    <input type="text" name="chat" placeholder="Masukkan chat">
    <input type="submit" name="kirim" value="kirim">
</form>

<?php } else { ?>
    <center> <a href="login_user.php" class="btn btn-danger">Silahkan Login Terlebih Dahulu!</a></center>
   <?php } ?>



<!-- Uncomment if you need to use the $hasil1 result -->
<!-- <?php while ($b = mysqli_fetch_array($hasil1)) { ?>
    #<?= $b['id'] ?>
<?php } ?> -->

</main>
<?php include "footer.php"?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
