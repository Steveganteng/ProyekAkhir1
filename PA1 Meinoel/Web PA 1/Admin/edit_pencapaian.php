<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
  header('Location:../index.php');
  exit;
}

// koneksi ke database
require('config/config.php');

// mendapatkan id produk dari parameter URL
$id = $_GET['id'];
                         
// jika tombol submit di klik
if (isset($_POST['submit'])) {
  $judul = isset($_POST['judul_pencapaian']) ? $_POST['judul_pencapaian'] : '';
  $desk = isset($_POST['text_pencapaian']) ? $_POST['text_pencapaian'] : '';

  // Cek apakah ada file gambar yang diunggah
  if (!empty($_FILES['gambar_pencapaian']['tmp_name'])) {
    $foto = $_FILES['gambar_pencapaian']['tmp_name'];
    $gambar = addslashes(file_get_contents($foto));
    // mengubah data produk di database beserta file gambar yang diunggah
    $query = "UPDATE pencapaian SET judul_pencapaian='$judul', text_pencapaian='$desk', gambar_pencapaian='$gambar' WHERE id_pencapaian='$id'";
} else {
    // mengubah data produk di database tanpa mengubah file gambar
    $query = "UPDATE pencapaian SET judul_pencapaian='$judul', text_pencapaian='$desk' WHERE id_pencapaian='$id'";
  }

  mysqli_query($conn, $query);

  // redirect ke halaman admin
  header('Location: admin.php');
  exit;
}

// menampilkan data produk yang akan diubah
$query = "SELECT * FROM pencapaian WHERE id_pencapaian='$id'";
$hasil = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($hasil);
$judul = $row['judul_pencapaian'];
$desk = $row['text_pencapaian'];
$foto = $row['gambar_pencapaian'];
$gambar_pencapaian = base64_encode($foto);

?>

<!DOCTYPE html>
<html>

<head>
  <title>Edit Pencapaian</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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
  <div class="container">
    <h1 class="mt-5 mb-3">Edit Pencapaian</h1>

    <form method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="judul_pencapaian">Judul Pencapaian:</label>
        <input type="text" class="form-control" id="judul_pencapaian" name="judul_pencapaian" value="<?php echo $judul; ?>">
      </div>

      <div class="form-group">
        <label for="gambar_pencapaian">Gambar:</label>
        <input type="file" class="form-control-file" id="gambar_pencapaian" name="gambar_pencapaian" accept=".jpg, .jpeg">
      </div>
      <?php if (!empty($gambar_pencapaian)) : ?>
        <div class="form-group">
          <label for="gambar_pencapaian"></label>
          <img src="data:image/jpeg;base64,<?php echo $gambar_pencapaian; ?>" width="100" height="100"><br><br>
        </div>
      <?php endif; ?>

      <div class="form-group">
        <label for="text_pencapaian">Deskripsi:</label>
        <textarea class="form-control" id="text_pencapaian" name="text_pencapaian"rows="10"><?php echo $desk; ?></textarea>
      </div>

      <div class="form-group">
        <div class="col-sm-10 offset-sm-2">
          <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
          <a href="pencapaian.php" class="btn btn-secondary">Batal</a>
        </div>
      </div>
    </form>
  </div>

  <!-- Load Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    document.getElementById('gambar_pencapaian').addEventListener('change', function() {
      var fileInput = this;
      var allowedExtensions = /(\.jpg|\.jpeg)$/i;
      if (!allowedExtensions.exec(fileInput.value)) {
        alert('Format file yang diizinkan hanya JPG/JPEG.');
        fileInput.value = '';
        return false;
      }
    });
  </script>
</body>

</html>
