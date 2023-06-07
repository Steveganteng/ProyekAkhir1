<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    Meinoel
  </title>
  <link href="img/logo.png" rel="icon">

  <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
  <meta name="keywords"
    content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
  <link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Satisfy|Bree+Serif|Candal|PT+Sans">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="js/filter.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>
  <!--navbar-->
  <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top" style="position: sticky; top: 0; margin-bottom: 0;">
  <div class="container-fluid">
    <div class="navbar-brand">
      <a href="#banner">
        <img src="img/logo.png" alt="Logo">
      </a>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#menu-list">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#achiev">Achievement</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#feedback">Feedback</a>
        </li>
        <li class="nav-item">
          <a class="" href=""></a>
        </li>
      </ul>
    <ul class="nav navbar-nav navbar-right">
        <li> <a class="nav-link" href="#"><i class="fa fa-user" id="meinoelText"></i></a></li>
      </ul>
    </div>
  </div>
</nav>
  <!-- login -->
  <!-- Login Modal -->
  <div class="modal" id="loginModal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2 class="modal-title">
      <i class="fa fa-user" style="color: #888;"></i> Log-In 
    </h2>
    <form action="login.php" method="POST">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Masuk</button>
    </form>
  </div>
</div>


  <script>
    $(document).ready(function () {
      $("#meinoelText").click(function () {
        $("#loginModal").show(); // Mengganti display dengan metode show()
      });

      $(".close").click(function () {
        $("#loginModal").hide(); // Mengganti display dengan metode hide()
      });
    });
  </script>



  <section id="banner" style="margin-top: -1px;">
    <div class="bg-color">
      <header id="header">
        <div class="border-bottom"></div>
      </header>
      <div class="container" id="home">
        <div class="row">
          <div class="inner text-center">
            <h1 class="logo-name">Meinoel</h1>
            <h2>Keripik Pisang</h2>
            <p>Crunchy goodness in every bite - Taste the perfection of our banana chips!</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- home -->
  <section id="menu-list" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center marb-35">
          <h1 class="header-h">Our Product</h1>
          <p class="header-p">Hadirkan kesempurnaan pada hidup Anda dengan cemilan-cemilan berkualitas dari kami </p>
          <br>
        </div>
        <div class="row">
          <div class="col-md-12 filters">
            <div class="text-center mb-5">
              <button class="btn btn-outline-warning filter-button" data-filter="all">All</button>
              <button class="btn btn-outline-warning filter-button" data-filter="keripik">Keripik</button>
              <button class="btn btn-outline-warning filter-button" data-filter="sambal">Sambal</button>
              <button class="btn btn-outline-warning filter-button" data-filter="minuman">Minuman</button>
              <button class="btn btn-outline-warning filter-button" data-filter="cemilan">Cemilan</button>
            </div>
          </div>
        </div>
        <!-- menu -->
        <?php
// Koneksi ke database
require('config/config.php');

// Query untuk mengambil data produk dari tabel produk
$query = "SELECT * FROM produk";
$result = mysqli_query($conn, $query);

// Loop untuk menampilkan data produk pada halaman
while ($row = mysqli_fetch_assoc($result)) {
  $image = $row['foto_produk'];
  $image_data = base64_encode($image);

  // Mendapatkan informasi ukuran gambar
  list($width, $height) = getimagesizefromstring($image);

  // Mencari tahu rasio asli gambar
  $image_ratio = $width / $height;

  // Membuat gambar berukuran rasio 1x1
  if ($image_ratio > 1) {
    // Crop gambar menjadi kotak
    $new_width = $height;
    $new_height = $height;
    $crop_x = ($width - $height) / 2;
    $crop_y = 0;
  } else {
    // Crop gambar menjadi kotak
    $new_width = $width;
    $new_height = $width;
    $crop_x = 0;
    $crop_y = ($height - $width) / 2;
  }

  $thumb = imagecreatetruecolor($new_width, $new_height);
  $source = imagecreatefromstring($image);
  imagecopyresampled($thumb, $source, 0, 0, $crop_x, $crop_y, $new_width, $new_height, $width - ($crop_x * 2), $height - ($crop_y * 2));

  // Menghasilkan gambar dalam format base64
  ob_start();
  imagejpeg($thumb);
  $image_data = ob_get_clean();
  $image_data = base64_encode($image_data);
  $nama_produk = $row['nama_produk'];
  $pesan_template = urlencode("Halo, saya ingin memesan produk " . $nama_produk . "\nJumlah pesanan:\nAlamat pengiriman:\nTerimakasih.");
  // Menampilkan produk
  echo '<div class="col-md-4 col-sm-6 filter ' . $row['kategori'] . '">';
  echo '<div class="card">';
  echo '<img class="card-img-top img-fluid" src="data:image/jpeg;base64,' . $image_data . '" alt="">';
  echo '<div class="card-body">';
  echo '<h4 class="card-title animate__animated animate__bounceInLeft">' . $row['nama_produk'] . '</h4>';
  echo '<p class="card-text animate__animated animate__bounceInRight">Rp. ' . $row['harga_produk'] . '</p>';
  echo '<p class="card-text animate__animated animate__bounceInRight">Stok Tersedia :' . $row['stok'] . '</p>';
  echo '<div class="btn-lala">';
  echo '<a href="https://wa.me/6282255333425?text=' . $pesan_template . '" class="btn btn-primary">Pesan</a>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  
  // Menghapus gambar dari memori
  imagedestroy($thumb);
}

mysqli_close($conn);
?>


        <!-- end -->
  </section>
</body>
<!--/ menu -->
<!-- event -->
<section id="achiev">
  <div class="bg-color" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 text-center" style="padding:60px;">
          <h1 class="header-h">Achievement</h1>
          <p class="header-p">Decorations 100% complete here</p>
        </div>
        <div class="col-md-12" style="padding-bottom:60px;">
          <div id="event-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="item active">
                <div class="col-md-6 col-sm-6 left-images">
                  <img src="img/kerjasama.jpg" class="img-responsive">
                </div>
                <div class="col-md-6 col-sm-6 details-text">
                  <div class="content-holder">
                    <h2>Menjalin Hubungan Kerjasama dengan Perusahaan Ternama</h2>
                    <p> Meinoel keripik pisang hadir di tengah-tengah masyarakat dengan tekad yang kuat untuk memberikan
                      yang terbaik bagi para konsumennya. Selain menjual keripik pisang biasa,Meinoel keripik pisang
                      juga menjalin kerjasama dengan beberapa organisasi dan perusahaan ternama, seperti Hoten Grand
                      Mercure Medan. Kini, pengunjung hotel tersebut bisa menikmati keripik pisang premium dari Meinoel
                      keripik pisang yang disajikan dengan kualitas terbaik. Tidak hanya itu, Meinoel keripik pisang
                      juga berkomitmen untuk terus mengembangkan produknya agar semakin memuaskan para pelanggannya.
                      Dengan begitu, tak heran jika Meinoel keripik pisang semakin dikenal sebagai salah satu produsen
                      keripik pisang terbaik di Indonesia.</p>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="col-md-6 col-sm-6 left-images">
                  <img src="img/pelatihan.jpg" class="img-responsive">
                </div>
                <div class="col-md-6 col-sm-6 details-text">
                  <div class="content-holder">
                    <h2>Mengikuti Pelatihan Hak Kekayaan Intelektual (HKI) </h2>
                    <p>Hak Kekayaan Intelektual (HKI) adalah kesempatan yang sangat berharga bagi setiap perusahaan atau
                      individu yang ingin melindungi hak-hak kekayaan intelektual mereka. Dalam pelatihan ini, Meinoel
                      keripik pisang mempelajari berbagai jenis HKI seperti hak paten, hak merek, dan hak cipta, serta
                      bagaimana cara mengajukan permohonan dan memperoleh perlindungan HKI. Dengan memahami HKI dengan
                      baik, Meinoel keripik pisang dapat memastikan bahwa hak-hak kekayaan intelektual mereka dilindungi
                      secara hukum dan tidak akan disalahgunakan oleh pihak lain.</p>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="col-md-6 col-sm-6 left-images">
                  <img src="img/mentri.jpg" class="img-responsive">
                </div>
                <div class="col-md-6 col-sm-6 details-text">
                  <div class="content-holder">
                    <h2>Kunjungan Kementerian Pariwisata dan Ekonomi Kreatif Indonesia </h2>
                    <p>Ekonomi Kreatif Indonesia Keripik pisang Noel adalah salah satu oleh-oleh khas dari Toba ,
                      khususnya daerah Balige. Makanan ini terbuat dari pisang yang diiris tipis-tipis kemudian digoreng
                      hingga kering dan renyah. Dengan varian rasa yang beragam keripik pisang Noel memiliki cita rasa
                      yang unik dan menggugah selera.Tidak hanya itu, keripik pisang Noel juga telah dicicipi oleh
                      Kementerian Pariwisata dan Ekonomi Kreatif Indonesia bersama dengan Bapak Ir. Poltak Sitorus
                      sebagai Bupati Toba. Hal ini menjadikan Keripik pisang Noel sebagai produk kuliner yang sangat
                      potensial dalam meningkatkan pariwisata Indonesia.
                      Dengan keunikan rasa dan pengakuan dari pihak terkait, para pelaku usaha dapat terus mengembangkan
                      keripik pisang Noel menjadi produk yang semakin menarik bagi konsumen. Selain itu, pengembangan
                      produk ini juga dapat menjadi peluang bisnis yang menjanjikan bagi masyarakat sekitar yang ingin
                      mencoba berwirausaha.</p>
                  </div>
                </div>
              </div>
            </div>
            <a class="left carousel-control" href="#event-carousel" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#event-carousel" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- tambahkan script untuk jQuery dan Bootstrap JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!--/ event -->
<!--about-->
<section id="about" class="section-padding">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center marb-35">
        <h1 class="header-h">Meinoel Keripik Pisang</h1>
        <p class="header-p">Meinoel Keripik Pisang merupakan produsen keripik pisang yang menawarkan berbagai macam
          varian rasa yang menggugah selera. Keripik pisang ini dibuat dari bahan-bahan segar dan premium yang diproses
          dengan tangan-tangan ahli yang penuh dengan kerja keras dan cinta. </p>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <div class="col-md-6 col-sm-6">
          <div class="about-info">
            <h2 class="heading">Proses pembuatan keripik pisang Noel dimulai dengan memilih bahan baku yang berkualitas.
              Pisang yang digunakan adalah pisang kepok yang matang dengan kualitas terbaik. Pisang dipilih dengan
              cermat untuk memastikan bahwa setiap keripik memiliki rasa yang konsisten dan kualitas yang sama.</h2>
            <p>Produk keripik pisang Noel sangat cocok untuk dinikmati sebagai camilan di kala santai bersama keluarga
              atau teman-teman. Selain itu, produk ini juga sangat cocok sebagai oleh-oleh atau hadiah untuk orang
              terdekat.</p>
            <div class="details-list">
              <ul>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <img src="img/logo.jpg" alt="" class="img-responsive">
        </div>
      </div>
      <div class="col-md-1"></div>
    </div>
  </div>
</section>
<!--/about-->
<!-- feedback -->
<?php
// Create database connection
require('config/config.php');
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$feedbackSent = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get input values from form
  $name = $_POST['nama_user'];
  $email = $_POST['email_user'];
  $feedback = $_POST['feedback_user'];
  
  // Get current datetime
  $currentDateTime = date('Y-m-d H:i:s');

  // Prepare SQL query
  $stmt = mysqli_prepare($conn, "INSERT INTO feedback (nama_user, email_user, feedback_user, waktu_pengiriman, id_akun) VALUES (?, ?, ?, ?, ?)");
  mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $feedback, $currentDateTime, $id_akun);

  // Set the id_akun value based on the logged-in user's id
  // Change the following line based on your authentication mechanism
  $id_akun = 1; // Replace 1 with the appropriate user id

  // Execute SQL query
  if (mysqli_stmt_execute($stmt)) {
    $feedbackSent = true;
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  // Close statement
  mysqli_stmt_close($stmt);
}

// Fetch feedback data from database
$feedbackQuery = "SELECT nama_user, feedback_user, waktu_pengiriman FROM feedback";
$result = mysqli_query($conn, $feedbackQuery);

?>

<section id="feedback">
  <div class="container bg-color section-padding">
    <div class="row">
      <div class="col-md-12">
        <div class="text-center">
          <h1 class="header-h">Feedback</h1>
          <p class="header-p">Bantu Kami Menyempurnakan Meinoel Keripik Pisang</p>
        </div>
      </div>
      <div class="col-md-6">
        <div>
          <form method="post" id="feedback-form">
            <div class="form-group">
              <label for="name">Nama : </label>
              <input type="text" class="form-control" id="nama_user" name="nama_user" required>
            </div>
            <div class="form-group">
              <label for="email">Email : </label>
              <input type="email" class="form-control" id="email_user" name="email_user" required>
            </div>
            <div class="form-group">
              <label for="feedback">Feedback : </label>
              <textarea class="form-control" id="feedback_user" name="feedback_user" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" id="submit-button">Submit</button>
          </form>
          <br>
        </div>
      </div>
      <div class="col-md-6" style="height: 330px;">
        <div class="bg-white" style="max-height: 100%; overflow: auto;">
          <table class="table">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Feedback</th>
                <th>Waktu Pengiriman</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (mysqli_num_rows($result) > 0) {
                $counter = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                  $nama = $row['nama_user'];
                  $feedback = $row['feedback_user'];
                  $waktuPengiriman = $row['waktu_pengiriman'];

                  echo "<tr>";
                  echo "<td>$counter</td>"; // Menampilkan nomor urut
                  echo "<td>$nama</td>";
                  echo "<td>$feedback</td>";
                  echo "<td>$waktuPengiriman</td>";
                  echo "</tr>";
                  $counter++;
                }
              } else {
                echo "<tr><td colspan='4'>Tidak ada data feedback</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
// Close connection
mysqli_close($conn);
?>



<?php if ($feedbackSent): ?>
<div class="modal" tabindex="-1" id="feedback-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Thank you for your feedback!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>We appreciate your feedback and will use it to improve our product and provide better service to you in the
          future.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close-modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  // Show the modal
  $(document).ready(function () {
    $('#feedback-modal').modal('show');
  });

  // Add event listener to X button and Close button
  $('.btn-close, .close-modal').on('click', function () {
    $('#feedback-modal').modal('hide');
    window.location.href = 'index.php';
  });
</script>
<?php endif; ?>

<!-- /feedback -->
<footer class="footer text-center" id="footer">
  <div class="footer-top">
    <div class="row">
      <div class="col-md-offset-3 col-md-6 text-center">
        <div class="widget">
          <h4 class="widget-title">Meinoel<br>Keripik Pisang</h4>
          <address>
            <a href="#">Sibola Hotangsas, Balige<br>Toba, Sumatera Utara 22316</a>
          </address>
          <div class="social-list">
            <a href="https://www.instagram.com/meinoel.keripikpisang/"><i class="fa fa-instagram"
                aria-hidden="true"></i></a>
            <a href="https://www.facebook.com/cemilkreakriftoba"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a
              href="https://wa.me/6282255333425?text=Halo%2C%20saya%20ingin%20memesan%20%3A%0AJumlah%20pesanan%20%3A%0AAlamat%20pengiriman%20%3A%0ATerimakasih.">
              <i class="fa fa-whatsapp" aria-hidden="true"></i></a>
          </div>
          <p class="clear-float">© Meinoel Keripik Pisang. All Rights Reserved</p>
          <div class="credits"></div>
        </div>
      </div>
    </div>
  </div>
</footer>


<!-- / footer -->
</body>

</html>