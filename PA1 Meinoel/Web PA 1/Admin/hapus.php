<?php
//koneksi ke database
require('config/config.php');

if (isset($_POST['produk_id'])) {
    $id = $_POST['produk_id'];

    // Fungsi untuk menghapus produk
    function hapusProduk($id)
    {
        global $conn;

        // Menghapus produk berdasarkan ID
        $query = "DELETE FROM produk WHERE id_produk = '$id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Jika penghapusan berhasil, arahkan kembali ke halaman utama dengan pesan sukses
            header("Location: admin.php?pesan=Produk berhasil dihapus");
            exit();
        } else {
            // Jika terjadi kesalahan saat menghapus, arahkan kembali ke halaman utama dengan pesan error
            header("Location: admin.php?pesan=Terjadi kesalahan saat menghapus produk");
            exit();
        }
    }

    // Panggil fungsi hapusProduk()
    hapusProduk($id);
} else {
    // Jika tidak ada parameter ID, arahkan kembali ke halaman utama
    header("Location: admin.php");
    exit();
}

mysqli_close($conn);
?>
