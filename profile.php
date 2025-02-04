<?php
// Mulai sesi
session_start();

// Periksa apakah pengguna sudah login
if(!isset($_SESSION['username'])) {
    // Jika belum, redirect ke halaman login
    header("Location: login.php");
    exit();
}

// Sambungkan ke database
include 'koneksi.php';

// Ambil informasi pengguna dari database
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

// Tutup koneksi database
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <!-- Tambahkan CSS atau Bootstrap jika diperlukan -->
</head>
<body>
    <h1>Profil Pengguna</h1>
    <p><strong>Nama:</strong> <?php echo $row['nama']; ?></p>
    <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
    <!-- Anda bisa menambahkan informasi pengguna lainnya di sini -->
    <a href="logout.php">Logout</a> <!-- Tambahkan tombol logout jika diperlukan -->
</body>
</html>
