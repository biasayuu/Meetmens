<?php 
include "koneksi.php";
session_start();

if(isset($_SESSION["admin_akses"])) {
  header("location: index.php");

  exit();
}


$username = "";
$password = "";


$pesan_login = "";


    if(isset($_POST['login'])) {
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $password =  mysqli_real_escape_string($koneksi, $_POST['password']);
        if ($username == '' OR $password == ''){
            $pesan_login = "Silahkan Masukan Username dan Password";
        }
        if (preg_match("/ / ", $username)) { 
          $pesan_login = "Username tidak boleh Spasi";
        }
        if (preg_match(" / /",$password)) {
          $pesan_login= "Password tidak boleh Spasi";   
        }
        $md_password = md5($password);

        if (empty($pesan_login)) {

        $sql = "SELECT * FROM user WHERE username = '$username' and password = '$md_password'";

        $result = $koneksi->query($sql);
        $q1 = mysqli_query($koneksi, $sql);
        $r1 = mysqli_fetch_array($q1);
        
        }
        if ($result->num_rows > 0) { 
            $data = $result->fetch_assoc(); 
          $_SESSION["nama"] = $data["nama"];
            // $_SESSION["username"] = $data["username"];
        //     $_SESSION["password"] = $data["password"];
        //     // $_SESSION["tlpn"] = $data["no_tlpn"];
        //     // $_SESSION["jenis"] = $data["jenis_kelamin"];

            
        } else {
            $pesan_login = "Akun tidak ditemukan";
            
        }
      
        
        if (empty($r1)) {
            
     
          $pesan_login = "Akun tidak ditemukan";
          die(header ("location: login_user.php" ));
        }
        if (empty($pesan_login)) {
            $username = $r1['username'];
        $sql = "SELECT * FROM user_akses WHERE username = '$username' ";
        $hasil = $koneksi->query($sql);
        $q1 = mysqli_query($koneksi, $sql);
        while($r1 = mysqli_fetch_array($q1)) {
            $akses[] =  $r1 ['akses_id'];
        }
        if(empty($akses)) {
            $pesan_login = "Anda Tidak Memiliki Akses";
        } 
        if ($hasil->num_rows > 0) { 
            $data = $hasil->fetch_assoc(); 
        $_SESSION["admin_nama"] = $data["username"];
      //     $_SESSION["username"] = $data["username"];
      //     $_SESSION["password"] = $data["password"];
      //     // $_SESSION["tlpn"] = $data["no_tlpn"];
      //     // $_SESSION["jenis"] = $data["jenis_kelamin"];

          
      }
        }

        if (empty($pesan_login)) {
        
        // $_SESSION["admin_username"] = true;
        $_SESSION["admin_akses"] =  $akses;
            
        header("location: index.php");

        // $_SESSION["is_login"] = true;
        exit();
        }

    }
    $koneksi->close();





?>





<!doctype html>
<html lang="en">
  <head>
     <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
  MeetMens
  </title>
  <link href="assets/css/signin.css" rel="stylesheet">
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
  </head>
  <body class="text-center">
    



<main class="form-signin w-100 m-auto">
  <form action="login_user.php" method="POST" role="form">

   
    <img class="mb-3" src="foto/profile.png" alt="gambar" width="72" >
    <h1 class="h2 mb-4 fw-normal text-primary"><b>Login User</b></h1>
    <h6 class="text-secondary" ><?=$pesan_login?></h6>
    <div class="form-floating">
    <input class="form-control shadow-sm p-3 rounded" id="floatingInput" type="text" name="username" value="<?= $username ?>" maxlength="30" placeholder="Username" style="height: 64px" required>
      <label class= "text-secondary" for="floatingInput">Username</label>
    </div>
    <div class="form-floating mt-2">
      <input type="password" name="password" class="form-control shadow-sm p-3 rounded" id="floatingPassword" placeholder="Password"  style="height: 64px" required>
      <label class= "text-secondary" for="floatingPassword">Password</label>
    </div>
    <div class="text-end">
    <a href="register_user.php" class="text-underline-primary">Tidak punya Akun? <span class="text-warning">Daftar</span></a>
</div>

   
    <button class="w-100 btn btn-lg btn-primary mt-3" name="login" type="submit">login</button>

      <!-- <input class="btn3" type="button" name="submit3" value="Halaman Awal" onclick="parent.location='../index.php'"> -->
      <input type="button" value="Halaman Awal" class="btn btn-sm mt-3 btn-primary" onclick="parent.location='index.php'">

  </form>
</main>

    
  </body>
</html>
