<?php
session_start();
if(!isset($_SESSION['loggedin'])){
  header('Location:../index.php');
  exit;
}

//koneksi ke database
require('config/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //mengambil nilai dari form
    $nama_produk = $_POST['nama_produk'];
    $foto_produk = $_FILES['foto_produk']['tmp_name'];
    $harga_produk = $_POST['harga_produk'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];

    // Memeriksa apakah produk dengan nama yang sama sudah ada dalam database
    $query_check = "SELECT * FROM produk WHERE nama_produk = '$nama_produk'";
    $result_check = mysqli_query($conn, $query_check);
    if (mysqli_num_rows($result_check) > 0) {
        // Produk sudah ada dalam database, tampilkan alert
        echo "<script>alert('Produk dengan nama tersebut sudah ada');window.location.href = 'tambah.php';</script>";
        exit;
    }

    //mengambil data gambar dan mengubah ukuran menjadi rasio 1x1
    $image_info = getimagesize($foto_produk);
    $image_width = $image_info[0];
    $image_height = $image_info[1];
    $image_type = $image_info[2];
    if ($image_type == IMAGETYPE_JPEG) {
        $src = imagecreatefromjpeg($foto_produk);
    } elseif ($image_type == IMAGETYPE_PNG) {
        $src = imagecreatefrompng($foto_produk);
    } elseif ($image_type == IMAGETYPE_GIF) {
        $src = imagecreatefromgif($foto_produk);
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


    //menambah data ke database
    $query = "INSERT INTO produk (nama_produk, foto_produk, harga_produk, kategori, stok) VALUES ('$nama_produk', '$gambar', '$harga_produk','$kategori','$stok')";
    mysqli_query($conn, $query);

    //mengarahkan ke halaman utama
    header("Location: admin.php");
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
    <h1>Tambah Produk</h1>
</div>

    <form method="POST" enctype="multipart/form-data">
      <div class="form-group row">
        <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk:</label>
        <div class="col-sm-10">
          <input type="text" name="nama_produk" id="nama_produk" class="form-control" required>
        </div>
      </div>

      <div class="form-group row">
  <label for="foto_produk" class="col-sm-2 col-form-label">Foto Produk:</label>
  <div class="col-sm-10">
    <input type="file" name="foto_produk" id="foto_produk" class="form-control-file" accept=".jpg, .jpeg" required>
  </div>
</div>

<script>
  document.getElementById('foto_produk').addEventListener('change', function() {
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
        <label for="harga_produk" class="col-sm-2 col-form-label">Harga Produk:</label>
        <div class="col-sm-10">
          <input type="number" name="harga_produk" id="harga_produk" class="form-control" min="0" required>
        </div>
      </div>

      <div class="form-group row">
        <label for="stok" class="col-sm-2 col-form-label">Stok Tersedia:</label>
        <div class="col-sm-10">
          <input type="number" name="stok" id="stok" class="form-control"min="0"  required>
        </div>
      </div>

      <div class="form-group row">
    <label for="kategori" class="col-sm-2 col-form-label">Kategori:</label>
    <div class="col-sm-10 ">
        <select name="kategori" id="kategori" class="form-control" required>
            <option value="">Pilih Kategori</option>

            <?php
            // Koneksi ke database
            require('config/config.php');

            // Query untuk mendapatkan data kategori dari database
            $sql = "SELECT * FROM kategori";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $nama_kategori = $row["nama_kategori"];
                    echo '<option value="' . $nama_kategori . '">' . $nama_kategori . '</option>';
                }
            } else {
                echo 'Error: ' . $conn->error;
            }

            // Menutup koneksi database
            $conn->close();
            ?>

        </select>
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
