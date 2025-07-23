<?php
include 'config/koneksi.php';

// Ambil data booking berdasarkan ID
$id = $_GET['id'] ?? null;
$booking = null;

if ($id) {
  $q = mysqli_query($conn, "SELECT booking.*, layanan.nama AS nama_layanan
                            FROM booking
                            LEFT JOIN layanan ON booking.layanan = layanan.id
                            WHERE booking.id = '$id'");

  $booking = mysqli_fetch_assoc($q);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking Berhasil – Fokus Studio</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 text-gray-800 flex items-center justify-center min-h-screen">

  <div class="bg-white p-8 rounded shadow-lg max-w-lg text-center" data-aos="fade-in">
    <h1 class="text-3xl font-bold text-green-600 mb-4">Booking Berhasil!</h1>

    <?php if ($booking): ?>
      <p class="text-lg mb-2">Terima kasih, <strong><?= htmlspecialchars($booking['nama']) ?></strong>!</p>
      <p class="mb-2">Booking ID: <strong>#<?= $booking['id'] ?></strong></p>
      <p class="mb-4">Layanan: <strong><?= htmlspecialchars($booking['nama_layanan']) ?></strong> pada tanggal <strong><?= date("d M Y", strtotime($booking['tanggal'])) ?></strong></p>
      <p class="text-sm text-gray-500 mb-6">Kami akan segera menghubungi Anda melalui WhatsApp atau Email.</p>
    <?php else: ?>
      <p class="text-red-500">Booking tidak ditemukan.</p>
    <?php endif; ?>

    <div class="flex flex-col gap-3">
      <a href="index.php" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">Kembali ke Beranda</a>
      <a href="galeri.php" class="text-blue-600 hover:underline">Lihat Galeri Karya</a>
      <a href="mailto:admin@fokusstudio.com" class="text-gray-600 hover:underline text-sm">Hubungi Admin</a>
    </div>
  </div>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>AOS.init();</script>
</body>
</html>
