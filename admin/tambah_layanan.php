<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['admin_username'])) {
  header('Location: index.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = mysqli_real_escape_string($conn, $_POST['nama']);
  $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
  $harga = (int) $_POST['harga'];
  $durasi = (int) $_POST['durasi'];

  $insert = mysqli_query($conn, "INSERT INTO layanan (nama, deskripsi, harga, durasi) VALUES ('$nama', '$deskripsi', '$harga', '$durasi')");

  if ($insert) {
    header('Location: kelola_layanan.php');
    exit;
  } else {
    die("Gagal menambahkan layanan: " . mysqli_error($conn));
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Layanan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
  <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Layanan</h2>
    <form method="POST" class="space-y-4">
      <input type="text" name="nama" placeholder="Nama Layanan" required class="w-full p-2 border rounded">
      <textarea name="deskripsi" placeholder="Deskripsi Layanan" required class="w-full p-2 border rounded"></textarea>
      <input type="number" name="harga" placeholder="Harga (Rp)" required class="w-full p-2 border rounded">
      <input type="number" name="durasi" placeholder="Durasi (jam)" required class="w-full p-2 border rounded">
      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Simpan</button>
      <a href="kelola_layanan.php" class="block text-center text-sm text-gray-500 hover:underline">Kembali</a>
    </form>
  </div>
</body>
</html>
