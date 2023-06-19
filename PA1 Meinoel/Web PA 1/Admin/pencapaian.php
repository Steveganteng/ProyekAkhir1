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
    <li><a href="#product"class="nav-link scrollto active"><i class="bx bx-trophy"></i> <span>Pencapaian</span></a></li>
    <li><a href="feedbackuser.php"><i class="bx bx-comment"></i> <span>Ulasan</span></a></li>
    <li><a href="sosmed.php"><i class="bx bx-mobile-alt"></i> <span>Sosial Media</span></a></li>
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
    <div class="row">
  <div class="col-md-6">
    <div class="mt-5 btn">
      <a class='btn btn-success' href="tambah_capai.php"><i class='bx bx-plus'></i>Pencapaian Baru</a>
    </div>
  </div>
</div>
<div id="product">
  <div class="row">
    <div class="container">
      <?php
        // koneksi ke database
        require('config/config.php');

        // menampilkan data
        $query = "SELECT * FROM pencapaian";
        $hasil = mysqli_query($conn, $query);

        // menampilkan tabel
        echo "<div class='table-responsive ml-auto'>";
        echo "<table class='table table-striped'>
                <thead class='thead-dark'>
                    <tr>
                        <th>No.</th>
                        <th>Judul Pencapaian</th>
                        <th>Foto Pencapaian</th>
                        <th>Deskripsi</th>              
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>";

        $i = 1;
        while ($row = mysqli_fetch_assoc($hasil)) {
            $id = $row['id_pencapaian'];
            $nama = $row['judul_pencapaian'];
            $gambar = $row['gambar_pencapaian'];
            $desk = $row['text_pencapaian'];

            // Menampilkan gambar
            echo "<tr>
                    <td>$i</td>
                    <td>$nama</td>
                    <td><img src='data:image/jpeg;base64," . base64_encode($gambar) . "' class='img-fluid' width='100'></td>
                    <td>$desk</td>
                    <td>
                        <a class='btn btn-warning' href='edit_pencapaian.php?id=$id'><i class='bx bx-edit'></i> Edit</a>
                        <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal$id'><i class='bx bx-trash'></i> Hapus</button>
                    </td>
                </tr>";
            echo "<div class='modal fade' id='deleteModal$id' tabindex='-1' aria-labelledby='deleteModalLabel$id' aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='deleteModalLabel$id'>Konfirmasi Hapus</h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                Apakah Anda yakin ingin menghapus pencapaian ini?
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Tutup</button>
                                <form method='post' action='hapus_pencapaian.php'>
                                    <input type='hidden' name='id_pencapaian' value='$id' />
                                    <button type='submit' class='btn btn-danger'><i class='bx bx-trash'></i> Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>";

            $i++;
        }
        echo "</tbody></table>";
        echo "</div>";

        mysqli_close($conn);
      ?>
    </div>
  </div>
</div>


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