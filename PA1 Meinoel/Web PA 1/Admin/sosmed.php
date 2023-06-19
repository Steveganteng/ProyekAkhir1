<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
  header('Location:../index.php');
  exit;
}

// Koneksi ke database
require('config/config.php');

// Cek apakah ada data yang dikirimkan
if (isset($_POST['submit_ig'])) {
  $ig = isset($_POST['link_ig']) ? $_POST['link_ig'] : '';
  $query = "UPDATE sosmed SET link_ig='$ig' WHERE id_sosmed=1";
  mysqli_query($conn, $query);
  header('Location: admin.php');
  exit;
} elseif (isset($_POST['submit_fb'])) {
  $fb = isset($_POST['link_fb']) ? $_POST['link_fb'] : '';
  $query = "UPDATE sosmed SET link_fb='$fb' WHERE id_sosmed=1";
  mysqli_query($conn, $query);
  header('Location: admin.php');
  exit;
} elseif (isset($_POST['submit_wa'])) {
  $wa = isset($_POST['link_wa']) ? $_POST['link_wa'] : '';
  $query = "UPDATE sosmed SET link_wa='$wa' WHERE id_sosmed=1";
  mysqli_query($conn, $query);
  header('Location: admin.php');
  exit;
}

// Ambil data sosmed dari database
$query = "SELECT * FROM sosmed WHERE id_sosmed=1";
$hasil = mysqli_query($conn, $query);
$column = mysqli_fetch_assoc($hasil);
$ig = isset($column['link_ig']) ? $column['link_ig'] : '';
$fb = isset($column['link_fb']) ? $column['link_fb'] : '';
$wa = isset($column['link_wa']) ? $column['link_wa'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Admin Meinoel</title>

  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <style>
    .container {
      margin-top: 50px;
    }

    h1 {
      text-align: center;
    }

    .form-group {
      margin-bottom: 20px;
      display: flex;
      align-items: center;
    }

    label {
      font-weight: bold;
      width: 150px;
      margin-right: 10px;
    }

    .btn-primary {
      margin-right: 10px;
    }

    .btn-secondary {
      margin-left: 10px;
    }
  </style>
</head>

<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="d-flex flex-column">

      <div class="profile">
        <img src="assets/img/logo.png" alt="" class="img-fluid rounded-circle">
        <h1 class="text-light"><a href="admin.php">Meinoel <br> Keripik Pisang</a></h1>
      </div>
    </div>

    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="confirmationModalLabel">Kembali</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin untuk kembali ke halaman user?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <a href="logout_proses.php" class="btn btn-primary">Ya</a>
          </div>
        </div>
      </div>
    </div>

    <nav id="navbar" class="nav-menu navbar">
  <ul>
    <li><a href="admin.php"><i class="bx bx-box"></i> <span>Product</span></a></li>
    <li><a href="kategori.php"><i class="bx bx-category-alt"></i> <span>Kategori</span></a></li>
    <li><a href="pencapaian.php"><i class="bx bx-trophy"></i> <span>Pencapaian</span></a></li>
    <li><a href="feedbackuser.php"><i class="bx bx-comment"></i> <span>Ulasan</span></a></li>
    <li><a href="#sosmed"class="nav-link scrollto active"><i class="bx bx-mobile-alt"></i> <span>Sosial Media</span></a></li>
    <li><a href="#" onclick="showConfirmationModal()"><i class="bx bx-log-out"></i> <span>Keluar</span></a></li>
  </ul>
</nav>

    <script>
      function showConfirmationModal() {
        var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
        confirmationModal.show();
      }
    </script>


    <!-- .nav-menu -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="hero-container" data-aos="fade-in">
      <h1>Meinoel<br>Keripik Pisang</h1>
      <p>Admin Pages</p>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <br><br><br><br><br>
    <div class="container mt-5" id="sosmed">
    <h1 class="text-center mb-4">Edit Link Sosial Media</h1>
    <form method="POST" action="">
      <div class="form-group">
        <label for="link_ig" class="bx bx-instagram-alt">Link Instagram:</label>
        <div class="input-group">
          <input type="text" class="form-control" id="link_ig" name="link_ig" value="<?php echo $ig; ?>">
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit" name="submit_ig">Ubah</button>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="link_fb" class="bx bx-facebook-square">Link Facebook:</label>
        <div class="input-group">
          <input type="text" class="form-control" id="link_fb" name="link_fb" value="<?php echo $fb; ?>">
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit" name="submit_fb">Ubah</button>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="link_wa" class="bx bx-whatsapp-square">Link Whatsapp:</label>
        <div class="input-group">
          <input type="text" class="form-control" id="link_wa" name="link_wa" value="<?php echo $wa; ?>">
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit" name="submit_wa">Ubah</button>
          </div>
        </div>
      </div>
    </form>
  </div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

  </main>


  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Meinoel Keripik Pisang</span></strong>
      </div>
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/typed.js/typed.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>