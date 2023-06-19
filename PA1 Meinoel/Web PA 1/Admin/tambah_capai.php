<?php
session_start();
if(!isset($_SESSION['loggedin'])){
  header('Location:../index.php');
  exit;
}

// koneksi ke database
require('config/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // mengambil nilai dari form
    $judul = $_POST['judul'];
    $gambar_pencapaian = $_FILES['gambar_pencapaian']['tmp_name'];
    $desk = $_POST['desk'];

    // mengambil data gambar dan mengubah ukuran menjadi rasio 1x1
    $image_info = getimagesize($gambar_pencapaian);
    $image_width = $image_info[0];
    $image_height = $image_info[1];
    $image_type = $image_info[2];
    if ($image_type == IMAGETYPE_JPEG) {
        $src = imagecreatefromjpeg($gambar_pencapaian);
    } elseif ($image_type == IMAGETYPE_PNG) {
        $src = imagecreatefrompng($gambar_pencapaian);
    } elseif ($image_type == IMAGETYPE_GIF) {
        $src = imagecreatefromgif($gambar_pencapaian);
    }
    $thumb_width = 300;
    $thumb_height = 300;
    $thumb_ratio = $thumb_width / $thumb_height;
    $image_ratio = $image_width / $image_height;
    if ($image_ratio >= $thumb_ratio) {
        // crop bagian atas dan bawah gambar
        $new_height = $thumb_height;
        $new_width = $new_height * $image_ratio;
        $x_offset = ($new_width - $thumb_width) / 2;
        $y_offset = 0;
    } else {
        // crop bagian kiri dan kanan gambar
        $new_width = $thumb_width;
        $new_height = $new_width / $image_ratio;
        $x_offset = 0;
        $y_offset = ($new_height - $thumb_height) / 2;
    }
    $dst = imagecreatetruecolor($thumb_width, $thumb_height);
    imagecopyresampled($dst, $src, -$x_offset, -$y_offset, 0, 0, $new_width, $new_height, $image_width, $image_height);
    ob_start();
    if ($image_type == IMAGETYPE_JPEG) {
        imagejpeg($dst, null, 80);
    } elseif ($image_type == IMAGETYPE_PNG) {
        imagepng($dst, null, 9);
    } elseif ($image_type == IMAGETYPE_GIF) {
        imagegif($dst, null);
    }
    $gambar = addslashes(ob_get_clean());

    // menambah data ke database
    $query = "INSERT INTO pencapaian (judul_pencapaian, gambar_pencapaian, text_pencapaian) VALUES ('$judul', '$gambar', '$desk')";
    mysqli_query($conn, $query);

    // mengarahkan ke halaman utama
    header("Location: pencapaian.php");
    exit;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
    <!-- Load Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="assets/img/logo.png" rel="icon">

    <style>
    .container {
      margin-top: 50px;
    }

    h1 {
      text-align: center;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
    }
  .btn {
  font-family: Arial, sans-serif;
  /* gaya font lainnya */
}
.bx {
  /* gaya font untuk ikon */
}
  </style>
</head>
<body>
  <div class="container">
    <div class="col-md-12">
    <h1>Pencapaian Baru</h1>
</div>

    <form method="POST" enctype="multipart/form-data">
      <div class="form-group row">
        <label for="judul" class="col-sm-2 col-form-label">Judul Pencapaian:</label>
        <div class="col-sm-10">
          <input type="text" name="judul" id="judul" class="form-control" required>
        </div>
      </div>

      <div class="form-group row">
        <label for="foto_pencapaian" class="col-sm-2 col-form-label">Foto Pencapaian:</label>
        <div class="col-sm-10">
          <input type="file" name="gambar_pencapaian" id="foto_pencapaian" class="form-control-file" accept=".jpg, .jpeg" required>
        </div>
      </div>

      <script>
        document.getElementById('foto_pencapaian').addEventListener('change', function() {
          var fileInput = this;
          var allowedExtensions = /(\.jpg|\.jpeg)$/i;
          if (!allowedExtensions.exec(fileInput.value)) {
            alert('Format file yang diizinkan hanya JPG/JPEG.');
            fileInput.value = '';
            return false;
          }
        });
      </script>

      <div class="form-group row">
        <label for="desk" class="col-sm-2 col-form-label">Deskripsi:</label>
        <div class="col-sm-10">
          <textarea name="desk" id="desk" class="form-control" min="0"rows="10" required></textarea>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-sm-2 col-form-label"></div>
        <div class="col-sm-10 ">
          <button type="submit" class="btn btn-primary">Tambah</button>
          <a href="admin.php" class="btn btn-secondary">Batal</a>
        </div>
      </div>
    </form>
  </div>

<!-- Load Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
