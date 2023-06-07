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
      <li><a href="#about" class="nav-link scrollto active"><i class="bx bx-comment"></i> <span>Feedback</span></a></li>
      <li><a href="#" onclick="showConfirModal()"><i class="bx bx-log-out"></i> <span>Log Out</span></a></li>
    </ul>
  </nav>

  <script>
    function showConfirModal() {
      var confirmationModal = new bootstrap.Modal(document.getElementById('confirModal'));
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


<script>
  // Show the modal
  $(document).ready(function() {
    $('#feedback-modal').modal('show');
  });

  // Add event listener to X button and Close button
  $('.btn-close, .close-modal').on('click', function() {
    $('#feedback-modal').modal('hide');
    window.location.href = 'index.php';
  });

  $(document).ready(function() {
    $('.delete-feedback').on('click', function() {
      var feedbackId = $(this).data('feedback-id');
      var feedbackNama = $(this).closest('tr').find('td:eq(1)').text();
      var feedbackEmail = $(this).closest('tr').find('td:eq(2)').text();
      var feedbackText = $(this).closest('tr').find('td:eq(3)').text();

      $('#feedbackId').val(feedbackId);
      $('#feedbackNama').text(feedbackNama);
      $('#feedbackEmail').text(feedbackEmail);
      $('#feedbackText').text(feedbackText);

      $('#confirmationModal').modal('show');
    });

    $('#confirmationModal').on('hidden.bs.modal', function() {
      $('#feedbackId').val('');
      $('#feedbackNama').text('');
      $('#feedbackEmail').text('');
      $('#feedbackText').text('');
    });
  });
</script>
<div class="container mt-5" id="about">
  <h1 class="mb-5">Feedback Users</h1>
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

        // Fetch data from feedback table
        $sql = "SELECT * FROM feedback";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          // Variable untuk menyimpan nomor
          $nomor = 1;

          // Output data of each row
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $nomor . "</td>";
            echo "<td>" . $row["nama_user"] . "</td>";
            echo "<td>" . $row["email_user"] . "</td>";
            echo "<td>" . $row["feedback_user"] . "</td>";
            echo "<td>";
            echo "<button type='submit' class='btn btn-danger bx bx-trash delete-feedback' data-feedback-id='" . $row['id_feedback'] . "' onclick='showConfirmationModal'>Hapus</button>";
            echo "</td>";
            echo "</tr>";

            // Increment nomor setelah setiap baris
            $nomor++;
          }
        } else {
          echo "<tr><td colspan='5'>0 results</td></tr>";
        }

        mysqli_close($conn);
        ?>
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmationModalLabel">Hapus Feedback</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin untuk menghapus feedback ini?</p>
        <p><strong>Nama:</strong> <span id="feedbackNama"></span></p>
        <p><strong>Email:</strong> <span id="feedbackEmail"></span></p>
        <p><strong>Feedback:</strong> <span id="feedbackText"></span></p>
      </div>
      <div class="modal-footer">
        <form method="post" action="delete_feedback.php">
          <input type="hidden" id="feedbackId" name="feedback_id" value="" />
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Batal</button>
          <button type="submit" name="hapus" class="btn btn-danger" onclick="redirectToFeedbackUser()">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function closeModal() {
    $('#confirmationModal').modal('hide');
  }

  function redirectToFeedbackUser() {
    $('#confirmationModal').modal('hide');
    window.location.href = 'feedbackuser.php';
  }

  function showConfirmationModal(button) {
    var feedbackId = button.getAttribute('data-feedback-id');
    var feedbackNama = button.parentElement.parentElement.querySelector('td:nth-child(2)').innerText;
    var feedbackEmail = button.parentElement.parentElement.querySelector('td:nth-child(3)').innerText;
    var feedbackText = button.parentElement.parentElement.querySelector('td:nth-child(4)').innerText;

    $('#feedbackId').val(feedbackId);
    $('#feedbackNama').text(feedbackNama);
    $('#feedbackEmail').text(feedbackEmail);
    $('#feedbackText').text(feedbackText);

    $('#confirmationModal').modal('show');
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