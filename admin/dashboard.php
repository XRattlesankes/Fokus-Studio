<?php
session_start();
// Perbaikan: Gunakan session 'admin_username' agar konsisten dengan halaman lain
if (!isset($_SESSION['admin_username'])) {
    header("Location: ../login_admin.php");
    exit;
}
include '../config/koneksi.php';

// Ambil data statistik untuk kartu
$total_booking = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) AS total FROM booking"))['total'];
$pending_booking = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) AS total FROM booking WHERE status = 'pending'"))['total'];
$total_galeri = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) AS total FROM galeri"))['total'];

// Ambil data untuk grafik (contoh: booking per bulan dalam 6 bulan terakhir)
$chart_data = [];
for ($i = 5; $i >= 0; $i--) {
    $date = date('Y-m', strtotime("-$i months"));
    $month_name = date('M', strtotime($date));
    $query = "SELECT COUNT(id) AS total FROM booking WHERE DATE_FORMAT(tanggal, '%Y-%m') = '$date'";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $query));
    $chart_data['labels'][] = $month_name;
    $chart_data['data'][] = $result['total'] ?? 0;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Fokus Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <a href="#" class="flex items-center px-6 py-3 text-gray-700 bg-gray-200 font-semibold">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" /></svg>
                    <span class="mx-3">Dashboard</span>
                </a>
                <a href="kelola_booking.php" class="flex items-center px-6 py-3 text-gray-500 hover:bg-gray-200">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="mx-3">Kelola Booking</span>
                </a>
                <a href="kelola_layanan.php" class="flex items-center px-6 py-3 text-gray-500 hover:bg-gray-200">
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
            <h2 class="text-3xl font-bold text-gray-800">Dashboard</h2>
            <div class="flex items-center">
                <span class="mr-4">Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['admin_username']); ?></strong></span>
                <a href="index.php" class="text-sm text-red-600 hover:underline">Logout</a>
            </div>
        </header>
        
        <main class="p-6 space-y-6">
            <section>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                        <div>
                            <span class="text-sm font-medium text-gray-500">Total Booking</span>
                            <p class="text-3xl font-bold text-gray-800"><?= $total_booking ?></p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                        <div>
                            <span class="text-sm font-medium text-gray-500">Booking Pending</span>
                            <p class="text-3xl font-bold text-gray-800"><?= $pending_booking ?></p>
                        </div>
                        <div class="bg-yellow-100 p-3 rounded-full">
                            <svg class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                        <div>
                            <span class="text-sm font-medium text-gray-500">Foto di Galeri</span>
                            <p class="text-3xl font-bold text-gray-800"><?= $total_galeri ?></p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                           <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l-1-1m-4 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                    </div>
                </div>
            </section>
            
            <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-lg">
                    <h3 class="font-semibold text-lg mb-4">Tren Booking (6 Bulan Terakhir)</h3>
                    <canvas id="bookingChart"></canvas>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col justify-center space-y-4">
                    <h3 class="font-semibold text-lg text-center">Aksi Cepat</h3>
                    <a href="kelola_booking.php" class="w-full text-center bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                        Lihat Semua Booking
                    </a>
                    <a href="kelola_galeri.php" class="w-full text-center bg-gray-700 text-white px-4 py-3 rounded-lg hover:bg-gray-800 transition-colors font-semibold">
                        Kelola Galeri Foto
                    </a>
                </div>
            </section>
        </main>
    </div>
</div>

<script>
    const ctx = document.getElementById('bookingChart').getContext('2d');
    const bookingChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($chart_data['labels']) ?>,
            datasets: [{
                label: 'Jumlah Booking',
                data: <?= json_encode($chart_data['data']) ?>,
                backgroundColor: 'rgba(59, 130, 246, 0.5)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>

</body>
</html>