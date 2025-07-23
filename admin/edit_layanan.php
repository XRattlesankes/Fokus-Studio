<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['admin_username'])) {
  header('Location: index.php');
  exit;
}

if (!isset($_GET['id'])) {
  header('Location: kelola_layanan.php');
  exit;
}

$id = (int) $_GET['id'];
$q = mysqli_query($conn, "SELECT * FROM layanan WHERE id = $id");
$data = mysqli_fetch_assoc($q);

if (!$data) {
  die("Layanan tidak ditemukan");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = mysqli_real_escape_string($conn, $_POST['nama']);
  $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
  $harga = (int) $_POST['harga'];
  $durasi = (int) $_POST['durasi'];

  $update = mysqli_query($conn, "UPDATE layanan SET nama='$nama', deskripsi='$deskripsi', harga='$harga', durasi='$durasi' WHERE id = $id");

  if ($update) {
    header('Location: kelola_layanan.php');
    exit;
  } else {
    die("Gagal mengedit layanan: " . mysqli_error($conn));
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Layanan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
  <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Layanan</h2>
    <form method="POST" class="space-y-4">
      <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required class="w-full p-2 border rounded">
      <textarea name="deskripsi" required class="w-full p-2 border rounded"><?= htmlspecialchars($data['deskripsi']) ?></textarea>
      <input type="number" name="harga" value="<?= $data['harga'] ?>" required class="w-full p-2 border rounded">
      <input type="number" name="durasi" value="<?= $data['durasi'] ?>" required class="w-full p-2 border rounded">
      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Update</button>
      <a href="kelola_layanan.php" class="block text-center text-sm text-gray-500 hover:underline">Kembali</a>
    </form>
  </div>
</body>
</html>
