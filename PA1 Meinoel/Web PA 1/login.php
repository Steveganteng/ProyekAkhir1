<?php
session_start();

// Konfigurasi koneksi ke database
$host = "nama_host"; 
$user = "nama_pengguna"; 
$password = "password"; 
$database = "nama_database"; 
$koneksi = mysqli_connect('localhost:3307', 'root', '', 'db_meinoel');

// Memeriksa koneksi
if ($koneksi->connect_error) {
  die('Koneksi ke database gagal: ' . $mysqli->connect_error);
}

// Memeriksa apakah form login disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Ambil nilai username dan password dari form
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Membuat query untuk memeriksa keberadaan username dan password yang sesuai
  $query = "SELECT * FROM login_admin WHERE username = '$username' AND password = '$password'";
  $result = $koneksi->query($query);

  if ($result && $result->num_rows === 1) {
    // Login berhasil
    // Set session untuk menyimpan status login
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;

    // Lakukan tindakan setelah login berhasil, misalnya redirect ke halaman dashboard
    header('Location: Admin/admin.php');
    exit;
  } else {
    // Login gagal
    echo "Username atau password salah!";
    // Tambahkan logika lainnya, seperti menampilkan pesan kesalahan
  }
}

// Menutup koneksi ke database
$koneksi->close();
?>
