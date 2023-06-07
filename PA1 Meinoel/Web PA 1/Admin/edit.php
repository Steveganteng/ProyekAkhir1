<?php
session_start();
if(!isset($_SESSION['loggedin'])){
  header('Location:../index.php');
  exit;
}
//koneksi ke database
$host = "nama_host"; //ganti dengan nama host Anda
$user = "nama_pengguna"; //ganti dengan nama pengguna Anda
$password = "password"; //ganti dengan password Anda
$database = "nama_database"; //ganti dengan nama database Anda
$koneksi = mysqli_connect('localhost:3307', 'root', '', 'db_meinoel');

//mendapatkan id produk dari parameter URL
$id = $_GET['id'];

//jika tombol submit di klik
if (isset($_POST['submit'])) {
  $nama = $_POST['nama_produk'];
  $harga = $_POST['harga_produk'];
  $stok = $_POST['stok'];
  $kategori = $_POST['kategori'];
  
  // Cek apakah ada file gambar yang diunggah
  if(!empty($_FILES['foto_produk']['tmp_name'])) {
    $foto = $_FILES['foto_produk']['tmp_name'];
    $gambar = addslashes(file_get_contents($foto));
    //mengubah data produk di database beserta file gambar yang diunggah
    $query = "UPDATE produk SET nama_produk='$nama', harga_produk='$harga',stok='$stok', foto_produk='$gambar', kategori='$kategori' WHERE id_produk='$id'";
    mysqli_query($koneksi, $query);
  } else {
    //mengubah data produk di database tanpa mengubah file gambar
    $query = "UPDATE produk SET nama_produk='$nama', harga_produk='$harga',stok='$stok', kategori='$kategori' WHERE id_produk='$id'";
    mysqli_query($koneksi, $query);
  }

  //redirect ke halaman admin
  header('Location: admin.php');
}

//menampilkan data produk yang akan diubah
$query = "SELECT * FROM produk WHERE id_produk='$id'";
$hasil = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($hasil);
$nama = $row['nama_produk'];
$harga = $row['harga_produk'];
$stok = $row['stok'];
$kategori = $row['kategori'];
$foto = $row['foto_produk'];
$foto_produk = base64_encode($foto);

 ?>

<!DOCTYPE html>
<html>

<head>
  <title>Edit Produk</title>
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
    <h1 class="mt-5 mb-3">Edit Produk</h1>

    <form method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="nama_produk">Nama Produk:</label>
        <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?php echo $nama; ?>">
      </div>

      <div class="form-group">
        <label for="harga_produk">Harga Produk:</label>
        <input type="number" class="form-control" id="harga_produk" name="harga_produk" value="<?php echo $harga; ?>">
      </div>

      <div class="form-group">
        <label for="stok">Jumlah Stok:</label>
        <input type="number" class="form-control" id="stok" name="stok" value="<?php echo $stok; ?>">
      </div>

      <?php
        // Contoh data kategori yang sudah masuk ke database
        $kategori_produk = array("keripik", "minuman", "cemilan", "sambal");
        $kategori_terpilih = $kategori; // Contoh kategori terpilih dari database

              ?>
      <div class="form-group">
        <label for="kategori">Kategori:</label>
        <select class="form-control" id="kategori" name="kategori" required>
          <option value="" selected disabled>Pilih Kategori</option>
          <?php
            foreach ($kategori_produk as $kategori_item) {
              $selected = ($kategori_item == $kategori_terpilih) ? "selected" : "";
              echo "<option value=\"$kategori_item\" $selected>$kategori_item</option>";
            }
        ?>
        </select>
      </div>
      <div class="form-group">
        <label for="foto_produk">Foto Produk:</label>
        <input type="file" class="form-control-file" id="foto_produk" name="foto_produk" accept=".jpg, .jpeg">
      </div>
      <?php if (!empty($foto_produk)): ?>
      <div class="form-group">
        <label for="foto_produk"></label>
        <img src="data:image/jpeg;base64,<?php echo $foto_produk; ?>" width="100" height="100"><br><br>
      </div>
      <?php endif; ?>
  </div>

  <script>
    document.getElementById('foto_produk').addEventListener('change', function () {
      var fileInput = this;
      var allowedExtensions = /(\.jpg|\.jpeg)$/i;
      if (!allowedExtensions.exec(fileInput.value)) {
        alert('Format file yang diizinkan hanya JPG/JPEG.');
        fileInput.value = '';
        return false;
      }
    });
  </script>

  <div class="form-group">
    <div class="col-sm-10 offset-sm-2">
      <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
      <a href="admin.php" class="btn btn-secondary">Batal</a>
    </div>
  </div>


  </form>
  </div>

  <!-- Load Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <?php
  mysqli_close($koneksi);
  ?>
</body>