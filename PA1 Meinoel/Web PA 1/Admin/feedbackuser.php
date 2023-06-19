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
  <meta content="" name="description">
  <meta content="" name="keywords">
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <!-- ======= Header ======= -->
  <header id="header">
  <div class="d-flex flex-column">
    <div class="profile">
      <img src="assets/img/logo.png" alt="" class="img-fluid rounded-circle">
      <h1 class="text-light"><a href="index.html">Meinoel <br> Keripik Pisang</a></h1>
    </div>
  </div>
  <div class="modal fade" id="confirModal" tabindex="-1" aria-labelledby="confirModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirModalLabel">Kembali</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p>Apakah anda yakin untuk kembali ke halaman user?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="../index.php" class="btn btn-primary">Ya</a>
      </div>
    </div>
  </div>
</div>
<nav id="navbar" class="nav-menu navbar">
  <ul>
    <li><a href="admin.php"><i class="bx bx-box"></i> <span>Product</span></a></li>
    <li><a href="kategori.php"><i class="bx bx-category-alt"></i> <span>Kategori</span></a></li>
    <li><a href="pencapaian.php"><i class="bx bx-trophy"></i> <span>Pencapaian</span></a></li>
    <li><a href="#about" class="nav-link scrollto active"><i class="bx bx-comment"></i> <span>Ulasan</span></a></li>
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

</header>


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


  <div class="container mt-5" id="about">
  <h1 class="mb-5">Ulasan Pengguna</h1>
  <div class="table-responsive">
    <table class="table table-striped table-hover">
      <thead class="thead-dark">
        <tr>
          <th scope="col">No.</th>
          <th scope="col">Nama</th>
          <th scope="col">Email</th>
          <th scope="col">Feedback</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        require('config/config.php');

        // Check connection
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // Check if the form is submitted for hiding feedback
          if (isset($_POST["sembunyikan"])) {
            $feedbackId = $_POST["feedback_id"];

            // Update the status_feedback in the database
            $updateSql = "UPDATE feedback SET status_feedback = 'sembunyi' WHERE id_feedback = $feedbackId";
            if (mysqli_query($conn, $updateSql)) {
              // Success message or further actions
              echo "<script>alert('Feedback berhasil disembunyikan.'); window.location.href = 'feedbackuser.php';</script>";
            } else {
              // Error message or handling
              echo "<script>alert('Terjadi kesalahan. Mohon coba lagi.'); $('#sembunyikanModal').modal('hide');</script>";
            }
          } elseif (isset($_POST["tampilkan"])) {
            $feedbackId = $_POST["feedback_id"];

            // Update the status_feedback in the database
            $updateSql = "UPDATE feedback SET status_feedback = 'tampilkan' WHERE id_feedback = $feedbackId";
            if (mysqli_query($conn, $updateSql)) {
              // Success message or further actions
              echo "<script>alert('Feedback berhasil ditampilkan.'); window.location.href = 'feedbackuser.php';</script>";
            } else {
              // Error message or handling
              echo "<script>alert('Terjadi kesalahan. Mohon coba lagi.'); $('#tampilkanModal').modal('hide');</script>";
            }
          }
        }

        // Fetch data from feedback table
        $sql = "SELECT * FROM feedback ORDER BY waktu_pengiriman DESC";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          // Variable untuk menyimpan nomor
          $nomor = 1;

          // Output data of each row
// Output data of each row
while ($row = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td>" . $nomor . "</td>";
  echo "<td>" . $row["nama_user"] . "</td>";
  echo "<td>" . $row["email_user"] . "</td>";
  echo "<td>" . $row["feedback_user"] . "</td>";
  echo "<td>";

  // Check status_feedback and display corresponding button
  if ($row["status_feedback"] == "sembunyi") {
    echo "<button type='button' class='btn btn-success bx bx-show show-feedback' data-feedback-id='" . $row['id_feedback'] . "' onclick='showTampilkanModal(" . $row['id_feedback'] . ", \"" . $row['nama_user'] . "\", \"" . $row['email_user'] . "\", \"" . $row['feedback_user'] . "\")'>Tampilkan</button>";
  } else {
    echo "<button type='button' class='btn btn-danger bx bx-hide hide-feedback' data-feedback-id='" . $row['id_feedback'] . "' onclick='showSembunyikanModal(" . $row['id_feedback'] . ", \"" . $row['nama_user'] . "\", \"" . $row['email_user'] . "\", \"" . $row['feedback_user'] . "\")'>Sembunyikan</button>";
  }

  echo "</td>";
  echo "</tr>";

  // Increment nomor setelah setiap baris
  $nomor++;
}

        } else {
          echo "<tr><td colspan='5'>Tidak ada data feedback</td></tr>";
        }

        mysqli_close($conn);
        ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal untuk Sembunyikan -->
<div class="modal fade" id="sembunyikanModal" tabindex="-1" role="dialog" aria-labelledby="sembunyikanModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sembunyikanModalLabel">Sembunyikan Feedback</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeSembunyikanModal()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin menyembunyikan feedback ini?</p>
        <p><strong>Nama:</strong> <span id="sembunyikanNama"></span></p>
        <p><strong>Email:</strong> <span id="sembunyikanEmail"></span></p>
        <p><strong>Feedback:</strong> <span id="sembunyikanText"></span></p>
      </div>
      <div class="modal-footer">
        <form method="post">
          <input type="hidden" id="sembunyikanId" name="feedback_id" value="" />
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeSembunyikanModal()">Batal</button>
          <button type="submit" name="sembunyikan" class="btn btn-danger">Sembunyikan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal untuk Tampilkan -->
<div class="modal fade" id="tampilkanModal" tabindex="-1" role="dialog" aria-labelledby="tampilkanModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tampilkanModalLabel">Tampilkan Feedback</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeTampilkanModal()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin menampilkan feedback ini?</p>
        <p><strong>Nama:</strong> <span id="tampilkanNama"></span></p>
        <p><strong>Email:</strong> <span id="tampilkanEmail"></span></p>
        <p><strong>Feedback:</strong> <span id="tampilkanText"></span></p>
      </div>
      <div class="modal-footer">
        <form method="post">
          <input type="hidden" id="tampilkanId" name="feedback_id" value="" />
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeTampilkanModal()">Batal</button>
          <button type="submit" name="tampilkan" class="btn btn-success">Tampilkan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  // Skrip JavaScript
  function showSembunyikanModal(id, nama, email, feedback) {
    document.getElementById("sembunyikanId").value = id;
    document.getElementById("sembunyikanNama").textContent = nama;
    document.getElementById("sembunyikanEmail").textContent = email;
    document.getElementById("sembunyikanText").textContent = feedback;

    $('#sembunyikanModal').modal('show');
  }

  function closeSembunyikanModal() {
    $('#sembunyikanModal').modal('hide');
  }

  function showTampilkanModal(id, nama, email, feedback) {
    document.getElementById("tampilkanId").value = id;
    document.getElementById("tampilkanNama").textContent = nama;
    document.getElementById("tampilkanEmail").textContent = email;
    document.getElementById("tampilkanText").textContent = feedback;

    $('#tampilkanModal').modal('show');
  }

  function closeTampilkanModal() {
    $('#tampilkanModal').modal('hide');
  }
</script>


<script>
  function showConfirmationModal(feedbackId, nama, email, feedbackText) {
    document.getElementById('feedbackId').value = feedbackId;
    document.getElementById('feedbackNama').textContent = nama;
    document.getElementById('feedbackEmail').textContent = email;
    document.getElementById('feedbackText').textContent = feedbackText;
    $('#confirmationModal').modal('show');
  }

  function closeModal() {
    $('#confirmationModal').modal('hide');
  }

  function redirectToFeedbackUser() {
    // Redirect to feedback user page after hiding feedback
    window.location.href = "feedbackuser.php";
  }
</script>


      <!-- End Hero -->
    
      <main id="main">
    
<!-- ======= About Section ======= -->
    

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