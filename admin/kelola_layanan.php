<?php
session_start();
include '../config/koneksi.php';

// Pastikan menggunakan session 'admin_username' agar konsisten
if (!isset($_SESSION['admin_username'])) {
    header("Location: ../login_admin.php");
    exit;
}

// Ambil semua data layanan
$result = mysqli_query($conn, "SELECT * FROM layanan ORDER BY id DESC");
if (!$result) die("Query error: " . mysqli_error($conn));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Layanan - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 antialiased">

<div class="flex h-screen bg-gray-100">
    <div class="hidden md:flex flex-col w-64 bg-white shadow-lg">
        <div class="flex items-center justify-center h-20 border-b">
            <h1 class="text-2xl font-bold text-blue-600">Fokus.Admin</h1>
        </div>
        <div class="flex-grow">
            <nav class="mt-5">
                <a href="dashboard.php" class="flex items-center px-6 py-3 text-gray-500 hover:bg-gray-200">
                     <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" /></svg>
                    <span class="mx-3">Dashboard</span>
                </a>
                <a href="kelola_booking.php" class="flex items-center px-6 py-3 text-gray-500 hover:bg-gray-200">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="mx-3">Kelola Booking</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-700 bg-gray-200 font-semibold">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <span class="mx-3">Kelola Layanan</span>
                </a>
                <a href="kelola_galeri.php" class="flex items-center px-6 py-3 text-gray-500 hover:bg-gray-200">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l-1-1m-4 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    <span class="mx-3">Kelola Galeri</span>
                </a>
            </nav>
        </div>
    </div>

    <div class="flex flex-col flex-1 overflow-y-auto">
        <header class="flex items-center justify-between h-20 px-6 bg-white border-b">
            <h2 class="text-3xl font-bold text-gray-800">Kelola Layanan</h2>
            <a href="tambah_layanan.php" class="flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                Tambah Layanan
            </a>
        </header>
        
        <main class="p-6">
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th class="px-6 py-3">Nama Layanan</th>
                                <th class="px-6 py-3">Deskripsi</th>
                                <th class="px-6 py-3">Harga</th>
                                <th class="px-6 py-3">Durasi</th>
                                <th class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    <?= htmlspecialchars($row['nama']) ?>
                                </td>
                                <td class="px-6 py-4 max-w-sm">
                                    <p class="truncate"><?= htmlspecialchars($row['deskripsi']) ?></p>
                                </td>
                                <td class="px-6 py-4 font-semibold">
                                    Rp <?= number_format($row['harga'], 0, ',', '.') ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= htmlspecialchars($row['durasi']) ?>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="edit_layanan.php?id=<?= $row['id'] ?>" class="p-2 rounded-full text-blue-600 hover:bg-blue-100" title="Edit Layanan">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                        </a>
                                        <a href="hapus_layanan.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus layanan ini?')" class="p-2 rounded-full text-red-600 hover:bg-red-100" title="Hapus Layanan">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                            <?php if (mysqli_num_rows($result) === 0): ?>
                                <tr class="bg-white border-b">
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        Belum ada layanan yang ditambahkan.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

</body>
</html>