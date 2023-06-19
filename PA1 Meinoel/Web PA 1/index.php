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
            <a class="nav-link" href="#menu-list">Produk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#achiev">Pencapaian</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about">Tentang</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#feedback">Ulasan</a>
          </li>

          <li class="nav-item">
            <a class="" href=""></a>
          </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li> <a class="nav-link" href="#"><i class="fa fa-user" id="meinoelText"></i></a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li> <a class="nav-link" href="#"><i class="fa fa-shopping-cart" id="keranjang"></i></a></li>
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
        <i class="fa fa-user" style="color: #888;"></i> Masuk Sebagai Admin
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
    // Mengatur tindakan saat logo keranjang diklik
    const keranjangLogo = document.querySelector('#keranjang');
    keranjangLogo.addEventListener('click', function () {
      // Menampilkan modal keranjang
      document.querySelector("#cartModal").style.display = "block";
    });
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
  <section>
    <div></div>
  </section>
  <section id="menu-list" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center marb-35">
          <h1 class="header-h">Produk Kami</h1>
          <p class="header-p">Anda dapat Memesan Produk Kami Melalui Whatsapp</p>
          <br>
        </div>
        <div class="row">
          <div class="col-md-12 filters">
            <div class="text-center mb-5">
              <button class="btn btn-outline-warning filter-button" data-filter="all">Semua</button>
              <?php
              // Koneksi ke database
              require('config/config.php');

              // Query untuk mendapatkan kategori dari tabel
              $sql = "SELECT DISTINCT kategori FROM produk";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                // Membuat tombol filter berdasarkan kategori
                while ($row = $result->fetch_assoc()) {
                  $kategori = $row["kategori"];
                  echo '<button class="btn btn-outline-warning filter-button" data-filter="'.$kategori.'">'.$kategori.'</button>';
                }
              }

              // Menutup koneksi database
              $conn->close();
              ?>

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
  // Menampilkan produk
  echo '<div class="col-md-4 col-sm-6 filter ' . $row['kategori'] . '">';
  echo '<div class="card">';
  echo '<img class="card-img-top img-fluid" src="data:image/jpeg;base64,' . $image_data . '" alt="">';
  echo '<div class="card-body">';
  echo '<h4 class="card-title animate__animated animate__bounceInLeft">' . $row['nama_produk'] . '</h4>';
  echo '<p class="card-text animate__animated animate__bounceInRight">Rp. ' . $row['harga_produk'] . '</p>';
  echo '<p class="card-text animate__animated animate__bounceInRight">Stok Tersedia: ' . $row['stok'] . '</p>';
  echo '<p class="card-text animate__animated animate__bounceInRight">Kategori: ' . $row['kategori'] . '</p>'; // Menampilkan kategori
  echo '<div class="btn-lala">';
  echo '<a href="#" class="btn btn-primary addToCart" data-id="' . $row['id_produk'] . '" data-nama="' . $row['nama_produk'] . '" data-harga="' . $row['harga_produk'] . '">';
  echo '<i class="fa fa-shopping-cart"></i>';
  echo '</a>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  
  // Menghapus gambar dari memori
  imagedestroy($thumb);
  }
  
  mysqli_close($conn);
  ?>
  
<div class="modal" id="cartModal" style="background-color: #f2f2f2; padding: 20px; border-radius: 5px; margin-top: 50px;">
  <div class="modal-content" style="background-color: #fff; padding: 20px; max-width: 700px; margin: 0 auto;">
    <h2 class="modal-title" style="color: #000; text-align: center; margin-bottom: 20px;">
      <i class="" style="color: #000;"></i> Keranjang
    </h2>

    <!-- Tabel -->
    <table id="cartTable" style="width: 100%; border-collapse: collapse;">
      <thead>
        <tr>
          <th style="border: 1px solid #ddd; padding: 8px;">Nama Produk</th>
          <th style="border: 1px solid #ddd; padding: 8px;">Harga Produk</th>
          <th style="border: 1px solid #ddd; padding: 8px;">Jumlah</th>
          <th style="border: 1px solid #ddd; padding: 8px;"></th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>

    <!-- Input Nama -->
    <div class="nama-pemesan" style="margin-top: 20px;">
      <label for="nama" style="color: #000; display: block; margin-bottom: 5px;">Nama:</label>
      <input type="text" id="nama" name="nama" placeholder="Masukkan nama" style="width: 100%; padding: 8px;" required>
    </div>

    <!-- Input Nomor Telepon -->
    <div class="nomor-telepon" style="margin-top: 20px;">
      <label for="nomorTelepon" style="color: #000; display: block; margin-bottom: 5px;">Nomor Telepon:</label>
      <input type="text" id="nomorTelepon" name="nomorTelepon" placeholder="Masukkan nomor telepon" style="width: 100%; padding: 8px;" required>
    </div>

    <!-- Input Alamat Pengiriman -->
    <form id="checkoutForm">
  <div class="alamat-pengiriman" style="margin-top: 20px;">
    <label for="alamat" style="color: #000; display: block; margin-bottom: 5px;">Alamat Pengiriman:</label>
    <input type="text" id="alamat" name="alamat" placeholder="Masukkan alamat pengiriman" style="width: 100%; padding: 8px;" required>
  </div>

  <div class="modal-footer" style="margin-top: 20px; text-align: center;">
    <button class="btn btn-primary" id="checkoutBtn" style="background-color: #4CAF50; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; margin-right: 10px;" required>Beli</button>
    <button class="btn btn-secondary" id="continueShoppingBtn" style="background-color: #ccc; color: #000; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Lanjutkan Berbelanja</button>
  </div>
</form>


<script>
// Mengatur tindakan saat tombol Beli di klik
const checkoutBtn = document.querySelector('#checkoutBtn');
checkoutBtn.addEventListener('click', function () {
  const tableRows = document.querySelectorAll('#cartTable tbody tr');
  let message = "Daftar Pesanan:%0A%0A";
  let totalHarga = 0;

  tableRows.forEach(function (row) {
    const namaProduk = row.cells[0].innerText;
    const hargaProduk = row.cells[1].innerText;
    const jumlahProduk = row.cells[2].querySelector('.quantityInput');
    const subtotal = hargaProduk * jumlahProduk.value;

    message += `Produk%3A%20${namaProduk}%0A`;
    message += `Jumlah%3A%20${jumlahProduk.value}%0A`;
    message += `Subtotal%3A%20${subtotal}%0A%0A`;

    totalHarga += subtotal;
  });

  const namaPemesan = document.querySelector('#nama').value;
  const nomorTelepon = document.querySelector('#nomorTelepon').value;
  const alamatPengiriman = document.querySelector('#alamat').value;

  // Memeriksa apakah ada data inputan yang kosong
  if (namaPemesan.trim() === '' || nomorTelepon.trim() === '' || alamatPengiriman.trim() === '') {
    alert('Mohon lengkapi semua data');
    return;
  }

  // Memeriksa apakah ada produk dalam keranjang
  if (tableRows.length === 0) {
    alert('Keranjang belanja kosong');
    return;
  }

  const waMessage = `Nama: ${namaPemesan}%0ANomor Telepon: ${nomorTelepon}%0AAlamat Pengiriman: ${alamatPengiriman}%0A%0A${message}Total Harga: ${totalHarga}`;

  const waLink = `https://api.whatsapp.com/send?phone=6282255333425&text=${encodeURIComponent(waMessage)}`;
  window.open(waLink, '_blank');
});

// Mengatur tindakan saat tombol Lanjutkan Berbelanja di klik
const continueShoppingBtn = document.querySelector('#continueShoppingBtn');
continueShoppingBtn.addEventListener('click', function () {
  // Lakukan tindakan lanjutan saat tombol Lanjutkan Berbelanja di klik
  // ...

  // Setelah tombol Lanjutkan Berbelanja diklik, tutup modal keranjang
  document.querySelector("#cartModal").style.display = "none";
});

// Mengatur tindakan saat ikon keranjang diklik
const addToCartButtons = document.querySelectorAll('.addToCart');
addToCartButtons.forEach(function (button) {
  button.addEventListener('click', function () {
    const idProduk = this.getAttribute('data-id');
    const namaProduk = this.getAttribute('data-nama');
    const hargaProduk = this.getAttribute('data-harga');

    // Memeriksa apakah produk sudah ada di keranjang
    const existingRow = document.querySelector(`#cartTable tbody tr[data-id="${idProduk}"]`);
    if (existingRow) {
      // Jika produk sudah ada, tambahkan jumlah pesanan
      const quantityInput = existingRow.querySelector('.quantityInput');
      const currentQuantity = parseInt(quantityInput.value);
      quantityInput.value = currentQuantity + 1;
    } else {
      // Jika produk belum ada, tambahkan produk baru ke dalam tabel pada modal
      const tableBody = document.querySelector('#cartTable tbody');
      const newRow = document.createElement('tr');
      newRow.setAttribute('data-id', idProduk);
      newRow.innerHTML = `
        <td>${namaProduk}</td>
        <td>${hargaProduk}</td>
        <td><input type="number" min="1" value="1" class="quantityInput" style="width:200px;"></td>
        <td><button class="removeBtn">Remove</button></td>
      `;
      tableBody.appendChild(newRow);

      // Mengatur tindakan saat tombol Remove di klik
      const removeBtn = newRow.querySelector('.removeBtn');
      removeBtn.addEventListener('click', function () {
        newRow.remove();
      });
    }

    // Menampilkan alert
    alert('Produk berhasil ditambahkan ke keranjang');

    // Mengarahkan pengguna ke bagian produk
    const productSection = document.querySelector('#product');
    productSection.scrollIntoView({ behavior: 'smooth' });
  });
});


  // Mengatur tindakan saat ikon keranjang di klik
  const cartIcon = document.querySelector('#cartIcon');
  cartIcon.addEventListener('click', function () {
    // Lakukan tindakan lanjutan saat ikon keranjang di klik
    // ...
  });
</script>


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
          <h1 class="header-h">Pencapaian</h1>
        </div>
        <div class="col-md-12" style="padding-bottom:60px;">
          <div id="event-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <?php
                // Kode untuk menghubungkan ke database
                require('config/config.php');

                // Cek koneksi ke database
                if (mysqli_connect_errno()) {
                  echo "Failed to connect to MySQL: " . mysqli_connect_error();
                  exit();
                }

                // Query untuk mengambil data pencapaian
                $query = "SELECT * FROM pencapaian";
                $result = mysqli_query($conn, $query);

                // Simpan hasil query ke dalam variabel $pencapaian
                $pencapaian = mysqli_fetch_all($result, MYSQLI_ASSOC);

                // Tutup koneksi ke database
                mysqli_close($conn);

                // Loop melalui setiap pencapaian
                foreach ($pencapaian as $index => $row) {
                  $active = ($index == 0) ? 'active' : '';
              ?>
              <div class="item <?php echo $active; ?>">
                <div class="col-md-6 col-sm-6 left-images">
                  <?php
    // Menampilkan gambar dari tipe data longblob
    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['gambar_pencapaian']) . '" class="img-responsive">';
    ?>
                </div>
                <div class="col-md-6 col-sm-6 details-text">
                  <div class="content-holder">
                    <h2><?php echo $row['judul_pencapaian']; ?></h2>
                    <p><?php echo $row['text_pencapaian']; ?></p>
                  </div>
                </div>
              </div>

              <?php
                }
              ?>
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
  $stmt = mysqli_prepare($conn, "INSERT INTO feedback (nama_user, email_user, feedback_user, waktu_pengiriman, id_akun, status_feedback) VALUES (?, ?, ?, ?, ?, ?)");
  $status_feedback = 'tampilkan';
  mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $feedback, $currentDateTime, $id_akun, $status_feedback);
  

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
$feedbackQuery = "SELECT nama_user, feedback_user, waktu_pengiriman FROM feedback where status_feedback ='tampilkan'ORDER BY waktu_pengiriman DESC  ";
$result = mysqli_query($conn, $feedbackQuery);

?>

<section id="feedback">
  <div class="container bg-color section-padding">
    <div class="row">
      <div class="col-md-12">
        <div class="text-center">
          <h1 class="header-h">Ulasan</h1>
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
      <div class="col-md-6" style="height: 500px;">
        <div class="bg-white" style="max-height: 100%;">
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
$feedbacksPerPage = 5; // Jumlah feedback yang ingin ditampilkan per halaman

$page = isset($_GET['page']) ? $_GET['page'] : 1; // Inisialisasi variabel $page

if (mysqli_num_rows($result) > 0) {
  $counter = 1;
  $feedbacks = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $row['status_feedback'] = 'ditampilkan'; // Mengubah status_feedback menjadi "ditampilkan"
    $feedbacks[] = $row;
  }

  // Menghitung jumlah total halaman
  $totalPages = ceil(count($feedbacks) / $feedbacksPerPage);

  // Menentukan batas awal dan akhir feedback yang akan ditampilkan
  $startIndex = ($page - 1) * $feedbacksPerPage;
  $endIndex = $startIndex + $feedbacksPerPage - 1;
  $endIndex = min($endIndex, count($feedbacks) - 1);

  for ($i = $startIndex; $i <= $endIndex; $i++) {
    $feedback = $feedbacks[$i];
    $nama = $feedback['nama_user'];
    $feedbackText = $feedback['feedback_user'];
    $waktuPengiriman = $feedback['waktu_pengiriman'];

    echo "<tr>";
    echo "<td>$counter</td>";
    echo "<td>$nama</td>";
    echo "<td>$feedbackText</td>";
    echo "<td>$waktuPengiriman</td>";
    echo "</tr>";
    $counter++;
  }

  // Menampilkan navigasi halaman
  echo "<tr><td colspan='4'>";
  echo "<ul class='pagination'>";
  if ($page > 1) {
    echo "<li class='page-item'><a class='page-link' href='?page=" . ($page - 1) . "'>Previous</a></li>";
  }
  for ($i = 1; $i <= $totalPages; $i++) {
    echo "<li class='page-item" . ($i == $page ? " active" : "") . "'><a class='page-link' href='?page=$i'>$i</a></li>";
  }
  if ($page < $totalPages) {
    echo "<li class='page-item'><a class='page-link' href='?page=" . ($page + 1) . "'>Next</a></li>";
  }
  echo "</ul>";
  echo "</td></tr>";
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
        <h5 class="modal-title">Terimakasih atas Ulasan Anda!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Kami menghargai masukan Anda dan akan menggunakannya untuk meningkatkan produk kami serta memberikan
          pelayanan yang lebih baik kepada Anda di masa mendatang.</p>
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
<footer class="footer text-right   " id="footer">
  <div class="footer-top">
    <div class="row">
      <div class="col-md-6">
        <div class="widget">
          <h4 class="widget-title">Meinoel<br>Keripik Pisang</h4>
          <address>
            Sibola Hotangsas, Balige<br>
            Toba, Sumatera Utara 22316
          </address>
          <div class="social-list">
            <a href="https://www.instagram.com/meinoel.keripikpisang/"><i class="fa fa-instagram"
                aria-hidden="true"></i></a>
            <a href="https://www.facebook.com/cemilkreakriftoba"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="https://wa.me/6282255333425"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
          </div>
        </div>
      </div>
      <div class="col-md-6 text-left">
        <div class="widget">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.6008114944816!2d99.07239201434666!3d2.337020098672403!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e053d23acdf9d%3A0x161cccc22e64c4ca!2sKripik%20pisang%20noel!5e0!3m2!1sen!2sid!4v1623785300451!5m2!1sen!2sid"
            width="500" height="300" style="border:0;margin-right:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="row">
      <div class="col-md-12">
        <p class="clear-float">© Meinoel Keripik Pisang. All Rights Reserved</p>
        <div class="credits"></div>
      </div>
    </div>
  </div>
</footer>



<!-- / footer -->
</body>

</html>