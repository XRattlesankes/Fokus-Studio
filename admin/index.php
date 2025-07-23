<?php
session_start();
include '../config/koneksi.php';

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['admin'])) {
  header("Location: dashboard.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin - Fokus Studio</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

  <form action="../proses/login_admin.php" method="POST" class="bg-white p-8 rounded shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Login Admin</h2>

    <div class="mb-4">
      <label for="username" class="block font-medium">Username</label>
      <input type="text" name="username" id="username" required class="w-full border border-gray-300 p-2 rounded">
    </div>

    <div class="mb-6">
      <label for="password" class="block font-medium">Password</label>
      <input type="password" name="password" id="password" required class="w-full border border-gray-300 p-2 rounded">
    </div>

    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Login</button>
  </form>

</body>
</html>
