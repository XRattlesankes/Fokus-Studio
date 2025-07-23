<?php
include '../config/koneksi.php';

$id        = $_POST['id'];
$nama_file = $_POST['nama_file'];
$lokasi    = '../assets/img/galeri/' . $nama_file;

// Hapus file
if (file_exists($lokasi)) {
    unlink($lokasi);
}

// Hapus dari database
$query = "DELETE FROM galeri WHERE id = '$id'";
if (mysqli_query($conn, $query)) {
    echo "<script>alert('Foto berhasil dihapus!'); window.location.href = '../admin/kelola_galeri.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus dari database.'); window.history.back();</script>";
}
?>
