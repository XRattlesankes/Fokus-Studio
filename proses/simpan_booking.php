<?php
include '../config/koneksi.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ambil data dari form
$nama       = $_POST['nama'] ?? '';
$email      = $_POST['email'] ?? '';
$nomor_wa   = $_POST['nomor_wa'] ?? '';
$layanan_id = $_POST['layanan_id'] ?? '';
$tanggal    = $_POST['tanggal'] ?? '';
$status     = 'Pending';

// Validasi
if (!$nama || !$email || !$nomor_wa || !$layanan_id || !$tanggal) {
  echo "<script>alert('Harap isi semua data.'); window.location.href = '../booking.php';</script>";
  exit;
}

// Simpan data
$query = "INSERT INTO booking (nama, email, nomor_wa, layanan, tanggal, status)
          VALUES ('$nama', '$email', '$nomor_wa', '$layanan_id', '$tanggal', '$status')";

if (mysqli_query($conn, $query)) {
  $booking_id = mysqli_insert_id($conn);
  header("Location: ../booking_terima.php?id=$booking_id");
  exit;
} else {
  echo "❌ Gagal menyimpan: " . mysqli_error($conn);
}
?>
