<?php
//koneksi ke database
require('config/config.php');

if (isset($_POST['id_pencapaian'])) {
    $id = $_POST['id_pencapaian'];

    // Fungsi untuk menghapus produk
    function hapusPencapaian($id)
    {
        global $conn;

        // Menghapus produk berdasarkan ID
        $query = "DELETE FROM pencapaian WHERE id_pencapaian = '$id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Jika penghapusan berhasil, arahkan kembali ke halaman utama dengan pesan sukses
            header("Location: pencapaian.php?pesan=Pencapaian berhasil dihapus");
            exit();
        } else {
            // Jika terjadi kesalahan saat menghapus, arahkan kembali ke halaman utama dengan pesan error
            header("Location: pencapaian.php?pesan=Terjadi kesalahan saat menghapus pencapaian");
            exit();
        }
    }

    // Panggil fungsi hapusProduk()
    hapusPencapaian($id);
} else {
    // Jika tidak ada parameter ID, arahkan kembali ke halaman utama
    header("Location: pencapaian.php");
    exit();
}

mysqli_close($conn);
?>
