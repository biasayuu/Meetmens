<?php
include "koneksi.php";
session_start();

if(isset($_SESSION["admin_akses"])) {
  header("location: index.php");

  exit();
}


$nama = "";
$username = "";
$password = "";

$pesan_daftar = "";


    if (isset($_POST['register'])) {

        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $md_password = md5($password);
        $jenis_kelamin = $_POST['kelamin'];

       
        if ($nama == '' or $username == '' or  $password == ''){
                $pesan_daftar = "Silahkan Isi Data Akun lengkap ";
            } else {
                if (ctype_alpha($nama)=== false) {
                    $pesan_daftar= "Silahkan Isi Nama Dengan huruf tanpa spasi";   
                } else {
                    if (preg_match("/ / ", $username)) { 
                        $pesan_daftar = "Username tidak boleh Spasi";
                    } else {
                    if (preg_match(" /[a-zA-Z0-9_@-]/",$username)=== false) {
                        $pesan_daftar= "Silahkan Isi Username Dengan ( @ , _ , - , a-z , A-Z , 0-9 )";   
                        
                } else {
                    if (preg_match(" / /",$password)) {
                        $pesan_daftar= "Password tidak boleh Spasi";   
                        
                } else {
                        try {
                            $sql = "INSERT INTO user (nama, username, password,jenis_kelamin) VALUES ('$nama', '$username', '$md_password', '$jenis_kelamin')"; 
                            $coba = "INSERT INTO user_akses (username, akses_id) VALUES ('$username', '$role')"; 
                                if ($koneksi->query($sql)) {
                              
                                }
                                if ($koneksi->query($coba)) {
                                    echo '<script language = "javascript">
                                    alert("Anda Berhasil Daftar Akun, Silahkan Login!  "); document.location="login_user.php";</script>';  
                                }
                            } catch (mysqli_sql_exception ) {
                                
                                $pesan_daftar = "Username sudah digunakan, silahkan coba Lagi";
                               
                            
                            }
                           
                            
                                $koneksi->close();
                    }
        }
    }
    }
    }
}




        

    // if ($pesan_daftar) {
    //     echo '<script language = "javascript">
    //     alert("Gagal Membuat Akun, Silahkan Coba Lagi ");</script>';  
    // }

?>



<!DOCTYPE html>
<html lang="en">
<head>
<head>
     <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
  MeetMens
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
  </head>
    
<style>

html,
body {
  height: 100%;
}

body {
 
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-color: rgba(255, 255, 250, 0.853);
  background-size: cover;
  background-position: center;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
.bd-placeholder-img {
  font-size: 1.125rem;
  text-anchor: middle;
  -webkit-user-select: none;
  -moz-user-select: none;
  user-select: none;
}

@media (min-width: 768px) {
  .bd-placeholder-img-lg {
    font-size: 3.5rem;
  }
  
}

.b-example-divider {
  height: 3rem;
  background-color: rgba(0, 0, 0, .1);
  border: solid rgba(0, 0, 0, .15);
  border-width: 1px 0;
  box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
}

.b-example-vr {
  flex-shrink: 0;
  width: 1.5rem;
  height: 100vh;
}

.bi {
  vertical-align: -.125em;
  fill: currentColor;
}

.nav-scroller {
  position: relative;
  z-index: 2;
  height: 2.75rem;
  overflow-y: hidden;
}

.nav-scroller .nav {
  display: flex;
  flex-wrap: nowrap;
  padding-bottom: 1rem;
  margin-top: -1px;
  overflow-x: auto;
  text-align: center;
  white-space: nowrap;
  -webkit-overflow-scrolling: touch;
}
h1{
  font-size: 36px;
  text-align: center;
  margin-bottom: 30px;
  color: rgb(5, 122, 247) ;
}

</style>
</head>


<body class="text-center" id="page-top" >

<div id="wrapper">
        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
            




<main class="form-signin w-100 m-auto">
  <form action="register_user.php" method="POST" role="form">

   
    <img class="mb-4" src="foto/signup.png" alt="gambar" width="72" >
    <h1 class="h2 mb-4 fw-normal text-primary"><b>Daftar Akun</b></h1>
    <h6 class="text-secondary" ><?=$pesan_daftar?></h6>

    <div class="form-floating">
    <input class="form-control shadow-sm p-3 rounded" id="floatingInput" type="text" name="nama" value="<?= $nama ?>" maxlength="30" placeholder="Username" style="height: 64px" required>
      <label class= "text-secondary" for="floatingInput">Nama</label>
    </div>

    <div class="form-floating mt-2">
      <input class="form-control shadow-sm p-3 rounded" id="floatingInput" type="text" name="username" value="<?= $username ?>" maxlength="30" placeholder="Username" style="height: 64px" required>
      <label class= "text-secondary" for="floatingInput">Username</label>
    </div>
    <div class="form-floating mt-2">
      <input type="password" name="password" class="form-control shadow-sm p-3 rounded" id="floatingPassword" placeholder="Password"  style="height: 64px" required>
      <label class= "text-secondary" for="floatingPassword">Password</label>
    </div>
    <select name="kelamin" class="form-select shadow-sm mt-2" aria-label="Default select example">
<option value="perempuan">Perempuan</option>
<option value="laki-laki">Laki-Laki</option>
</select>
  <input name="role" type="hidden" value="user">
   
    <button class="w-100 btn btn-lg btn-primary mt-3" name="register" type="submit">Register</button>
    
    <!-- <input class="btn3" type="button" name="submit3" value="Halaman Awal" onclick="parent.location='../index.php'"> -->
    <input type="button" value="Kembali Login" class="btn btn-sm mt-3 btn-warning" onclick="parent.location='login_user.php'">
    
    
    
 
  </form>
</main>


<!-- <div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="..." class="rounded me-2" alt="...">
      <strong class="me-auto">Bootstrap</strong>
      <small>11 mins ago</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
    </div>
  </div>
</div> -->

</body>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->

</html>