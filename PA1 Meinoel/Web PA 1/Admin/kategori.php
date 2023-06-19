<?php
session_start();
if(!isset($_SESSION['loggedin'])){
  header('Location:../index.php');
  exit;
}
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
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
<style>
  
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

      <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
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
    <li><a href="#category" class="nav-link scrollto active"><i class="bx bx-category-alt"></i> <span>Kategori</span></a></li>
    <li><a href="pencapaian.php"><i class="bx bx-trophy"></i> <span>Pencapaian</span></a></li>
    <li><a href="feedbackuser.php"><i class="bx bx-comment"></i> <span>Ulasan</span></a></li>
    <li><a href="feedbackuser.php"><i class="bx bx-mobile-alt"></i> <span>Sosial Media</span></a></li>
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
<!DOCTYPE html>
<html>
<head>
    <title>CRUD Kategori</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container" id="category">
        <h2></h2>
        <hr>

        <?php
    // Koneksi ke database
    require('config/config.php');

    // Menyimpan data kategori ke database
    if (isset($_POST['submit'])) {
        $nama_kategori = $_POST['nama_kategori'];

        // Memeriksa apakah kategori dengan nama yang sama sudah ada
        $check_query = "SELECT id_kategori FROM kategori WHERE nama_kategori = '$nama_kategori'";
        $check_result = $conn->query($check_query);

        if ($check_result->num_rows > 0) {
            echo '<div class="alert alert-danger">Kategori dengan nama tersebut sudah ada.</div>';
        } else {
            $id_akun = 1; // Ganti dengan nilai id_akun yang sesuai, atau gunakan mekanisme yang sesuai untuk mendapatkan nilai id_akun

            $sql = "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')";

            if ($conn->query($sql) === TRUE) {
                echo '<div class="alert alert-success">Kategori berhasil ditambahkan.</div>';

                // Redirect ke halaman baru setelah sukses menyimpan data
                header("Location: kategori.php");
                exit();
            } else {
                echo '<div class="alert alert-danger">Error: ' . $conn->error . '</div>';
            }
        }
    }

    // Menghapus data kategori dari database
    if (isset($_GET['delete'])) {
        $id_kategori = $_GET['delete'];
        $delete_query = "DELETE FROM kategori WHERE id_kategori = $id_kategori";

        if ($conn->query($delete_query) === TRUE) {
            echo '<div class="alert alert-success">Kategori berhasil dihapus.</div>';
            // Redirect ke halaman baru setelah sukses menghapus data
            header("Location: kategori.php");
            exit();
        } else {
            echo '<div class="alert alert-danger">Error: ' . $conn->error . '</div>';
        }
    }

    // Menampilkan data kategori dari database
    $sql = "SELECT * FROM kategori";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>';

        $i = 1;
        while ($row = $result->fetch_assoc()) {
            $id_kategori = $row["id_kategori"];
            $nama_kategori = $row["nama_kategori"];

            echo '
            <tr>
                <td>' . $i . '</td>
                <td>' . $nama_kategori . '</td>
                <td>
                    <a href="?delete=' . $id_kategori . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus kategori ini?\')">Hapus</a>
                </td>
            </tr>';

            $i++;
        }
        echo '</tbody>
            </table>';
    } else {
        echo '<div class="alert alert-info">Belum ada data kategori.</div>';
    }

    // Menutup koneksi database
    $conn->close();
?>


        <hr>

        <h3>Tambah Kategori</h3>
        <form method="POST">
            <div class="form-group">
                <label for="nama_kategori">Nama Kategori:</label>
                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Tambah</button>
        </form>
        <br><br>
    </div>
</body>
</html>  

</main>


  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Meinoel Keripik Pisang</span></strong>
      </div>
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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