<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['admin_username'])) {
    header('Location: ../login_admin.php');
    exit;
}

// Proses ubah status
if (isset($_GET['toggle']) && isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $stmt = mysqli_prepare($conn, "UPDATE booking SET status = IF(status='pending','confirmed','pending') WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    header('Location: kelola_booking.php');
    exit;
}

// Filter & pencarian
$where = [];
if (!empty($_GET['q'])) {
    $q = mysqli_real_escape_string($conn, $_GET['q']);
    $where[] = "(b.nama LIKE '%$q%' OR b.email LIKE '%$q%')";
}
if (!empty($_GET['tgl'])) {
    $tgl = mysqli_real_escape_string($conn, $_GET['tgl']);
    $where[] = "b.tanggal = '$tgl'";
}
$clause = $where ? 'WHERE ' . implode(' AND ', $where) : '';

// Query untuk mengambil data booking
$qry = "
    SELECT b.id, b.nama, b.email, b.nomor_wa, b.tanggal, b.status, l.nama AS layanan_nama, l.harga
    FROM booking b
    JOIN layanan l ON b.layanan = l.id
    $clause
    ORDER BY b.tanggal DESC, b.id DESC
";
$q_booking = mysqli_query($conn, $qry);
if (!$q_booking) die("❌ Query error: " . mysqli_error($conn));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Kelola Booking – Admin</title>
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
                <a href="kelola_booking.php" class="flex items-center px-6 py-3 text-gray-700 bg-gray-200 font-semibold">
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
            <h2 class="text-3xl font-bold text-gray-800">Daftar Booking</h2>
            <div class="flex items-center">
                <span class="mr-4">Selamat datang, <strong><?= htmlspecialchars($_SESSION['admin_username']) ?></strong></span>
                <a href="logout.php" class="text-sm text-red-600 hover:underline">Logout</a>
            </div>
        </header>
        
        <main class="p-6">
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <input type="text" name="q" placeholder="Cari nama atau email..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" class="md:col-span-2 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <input type="date" name="tgl" value="<?= htmlspecialchars($_GET['tgl'] ?? '') ?>" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <div class="flex gap-2">
                        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">Filter</button>
                        <a href="kelola_booking.php" class="w-full text-center bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors">Reset</a>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th class="px-6 py-3">Pelanggan</th>
                                <th class="px-6 py-3">Layanan</th>
                                <th class="px-6 py-3">Tanggal</th>
                                <th class="px-6 py-3 text-center">Status</th>
                                <th class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($q_booking)): ?>
                            <?php
                                // Membuat Pesan Invoice WhatsApp
                                $nama_pelanggan = htmlspecialchars($row['nama']);
                                $id_booking = str_pad($row['id'], 6, '0', STR_PAD_LEFT);
                                $nama_layanan = htmlspecialchars($row['layanan_nama']);
                                $tanggal_booking = date("d F Y", strtotime($row['tanggal']));
                                $harga_layanan = "Rp " . number_format($row['harga'], 0, ',', '.');
                                $nomor_wa_formatted = preg_replace('/^0/', '62', htmlspecialchars($row['nomor_wa']));

                                $invoice_text = "
Halo, *$nama_pelanggan*.

Terima kasih telah melakukan reservasi di *Fokus Studio*.
Berikut adalah detail tagihan untuk pemesanan Anda:
-----------------------------------
*INVOICE*
-----------------------------------
*Booking ID:* #$id_booking
*Layanan:* $nama_layanan
*Tanggal Sesi:* $tanggal_booking
                                
*Total Tagihan:* *$harga_layanan*
-----------------------------------

Silakan lakukan pembayaran melalui transfer ke rekening berikut:
*Bank BCA: 1234567890 a/n Fokus Studio*

Mohon lakukan konfirmasi setelah pembayaran. Kami tunggu kehadirannya!

Terima kasih,
*Admin Fokus Studio*
                                ";

                                $encoded_invoice = urlencode($invoice_text);
                                $wa_link_invoice = "https://wa.me/{$nomor_wa_formatted}?text={$encoded_invoice}";
                            ?>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    <div class="font-bold"><?= $nama_pelanggan ?></div>
                                    <div class="text-xs text-gray-500"><?= htmlspecialchars($row['email']) ?></div>
                                </td>
                                <td class="px-6 py-4"><?= $nama_layanan ?></td>
                                <td class="px-6 py-4"><?= date("d M Y", strtotime($row['tanggal'])) ?></td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                        <?= $row['status'] === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                                        <?= ucfirst($row['status']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="?toggle=1&id=<?= $row['id'] ?>" class="p-2 rounded-full hover:bg-gray-200" title="<?= $row['status'] === 'confirmed' ? 'Tandai Pending' : 'Konfirmasi' ?>">
                                            <svg class="h-5 w-5 <?= $row['status'] === 'confirmed' ? 'text-yellow-500' : 'text-green-500' ?>" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                        </a>
                                        <a href="<?= $wa_link_invoice ?>" target="_blank" class="p-2 rounded-full hover:bg-gray-200" title="Kirim Tagihan via WhatsApp">
                                            <svg class="h-5 w-5 text-green-600" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.894 11.892-1.99 0-3.903-.52-5.586-1.457l-6.354 1.654zm6.838-5.619c.428.195.888.315 1.354.349 3.812-.001 6.929-3.116 6.93-6.928.001-3.813-3.116-6.93-6.929-6.93-1.856.001-3.598.723-4.908 2.032-1.31 1.31-2.031 3.052-2.03 4.908.001 3.16.892 5.394 2.658 6.963.242.215.467.46.68.718l-.341 1.231 1.253-.324z"/></svg>
                                        </a>
                                        <a href="hapus_booking.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus booking ini?')" class="p-2 rounded-full hover:bg-gray-200" title="Hapus">
                                             <svg class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                             <?php if (mysqli_num_rows($q_booking) === 0): ?>
                                <tr class="bg-white border-b">
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        Tidak ada data booking ditemukan.
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