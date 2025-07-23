<?php
session_start();
include '../config/koneksi.php';
if (!isset($_SESSION['admin_username'])) {
  header('Location: ../login_admin.php');
  exit;
}
$id = (int)($_GET['id'] ?? 0);
$q = mysqli_query($conn, "
  SELECT b.*, l.nama AS layanan_nama
  FROM booking b
  JOIN layanan l ON b.layanan = l.id
  WHERE b.id = $id
");
if (!$q || mysqli_num_rows($q) === 0) {
  die("Booking tidak ditemukan.");
}
$r = mysqli_fetch_assoc($q);
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="utf-8"><title>Detail Booking</title><script src="https://cdn.tailwindcss.com"></script></head>
<body class="bg-gray-50 p-6">
  <div class="max-w-md mx-auto bg-white p-6 shadow rounded">
    <h2 class="text-2xl font-bold mb-4">Detail Booking #<?= $r['id'] ?></h2>
    <ul class="space-y-2">
      <li><strong>Nama:</strong> <?= htmlspecialchars($r['nama']) ?></li>
      <li><strong>Email:</strong> <?= htmlspecialchars($r['email']) ?></li>
      <li><strong>WhatsApp:</strong> <?= htmlspecialchars($r['nomor_wa']) ?></li>
      <li><strong>Tanggal:</strong> <?= htmlspecialchars($r['tanggal']) ?></li>
      <li><strong>Layanan:</strong> <?= htmlspecialchars($r['layanan_nama']) ?></li>
      <li><strong>Status:</strong> <?= ucfirst($r['status']) ?></li>
    </ul>
    <div class="mt-6 flex justify-between">
      <a href="kelola_booking.php" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Kembali</a>
      <a href="?toggle=1&id=<?= $r['id'] ?>"
         class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        <?= $r['status']==='confirmed'? 'Pendingkan' : 'Konfirmasi' ?>
      </a>
    </div>
  </div>
</body>
</html>
