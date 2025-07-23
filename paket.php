<?php
// Baris untuk menampilkan error jika ada
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config/koneksi.php';

// Ambil SEMUA layanan dari database
$layanan_q = mysqli_query($conn, "SELECT * FROM layanan ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Paket Layanan – Fokus Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-angled-sm { clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%); }
        .navbar-scrolled {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }
        .navbar-scrolled .nav-link,
        .navbar-scrolled .nav-brand,
        .navbar-scrolled #menuToggle {
            color: #374151; /* text-gray-700 */
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <header id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 navbar-scrolled">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <a href="index.php" class="text-2xl font-bold text-blue-600 nav-brand">Fokus.ID</a>
                
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="text-gray-700 nav-link hover:text-blue-600 font-medium transition-colors">Beranda</a>
                    <a href="paket.php" class="text-blue-600 font-semibold">Paket</a>
                    <a href="galeri.php" class="text-gray-700 nav-link hover:text-blue-600 font-medium transition-colors">Galeri</a>

                    <div class="relative" id="dropdown-container">
                        <button id="dropdown-toggle" class="flex items-center text-gray-700 nav-link hover:text-blue-600 font-medium transition-colors">
                            <span>Lainnya</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div id="dropdown-menu" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2 transition-all duration-200 ease-out transform scale-95 opacity-0 pointer-events-none">
                            <a href="tentang.php" class="block px-4 py-2 text-gray-700 hover:bg-blue-50">Tentang Kami</a>
                            <a href="kontak.php" class="block px-4 py-2 text-gray-700 hover:bg-blue-50">Kontak</a>
                        </div>
                    </div>
                    
                    <a href="booking.php" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition-transform transform hover:scale-105">Booking Sekarang</a>
                </nav>

                <div class="md:hidden">
                    <button id="menuToggle" class="text-gray-700"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg></button>
                </div>
            </div>
        </div>
        <div id="mobileMenu" class="md:hidden bg-white p-4 space-y-2 transition-all duration-300 ease-in-out transform -translate-y-full opacity-0 absolute w-full pointer-events-none">
            </div>
    </header>

    <section class="bg-gray-700 pt-32 pb-20 hero-angled-sm" style="background-image: url('https://images.unsplash.com/photo-1617463874381-85b513b3e991?q=80&w=1170&auto=format&fit=crop');">
        <div class="text-center text-white px-6" data-aos="fade-down">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">Paket Layanan Kami</h1>
            <p class="text-lg mt-4 text-gray-300">Temukan paket yang paling sesuai untuk mengabadikan momen berharga Anda.</p>
        </div>
    </section>

    <section id="paket-list" class="py-20 px-6">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php 
                if ($layanan_q && mysqli_num_rows($layanan_q) > 0):
                    $i = 0; 
                    while ($row = mysqli_fetch_assoc($layanan_q)): 
            ?>
            <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col transform hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
                <div class="p-6 border-b">
                    <h3 class="text-2xl font-bold text-gray-800"><?= htmlspecialchars($row['nama']) ?></h3>
                    <p class="text-gray-500 mt-2 h-12 overflow-hidden"><?= htmlspecialchars($row['deskripsi']) ?></p>
                </div>
                <div class="p-6 flex-grow">
                    <p class="text-4xl font-extrabold text-gray-900 mb-4">Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Durasi Sesi: <?= htmlspecialchars($row['durasi']) ?> Jam
                        </li>
                        <?php 
                            $features = explode(',', $row['deskripsi']);
                            foreach($features as $feature) {
                                if (!empty(trim($feature))) {
                                    echo '<li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>' . htmlspecialchars(trim($feature)) . '</li>';
                                }
                            }
                        ?>
                    </ul>
                </div>
                <div class="p-6 bg-gray-50 grid grid-cols-2 gap-4 mt-auto">
                    <a href="galeri.php?deskripsi=<?= urlencode($row['deskripsi']) ?>" class="block w-full text-center bg-white border border-gray-300 hover:bg-gray-100 text-gray-800 font-semibold py-3 rounded-lg transition-colors">Lihat Portfolio</a>
                    <a href="booking.php?layanan_id=<?= $row['id'] ?>" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition-colors">Pilih Paket</a>
                </div>
            </div>
            <?php 
                    $i++; 
                    endwhile; 
                else:
            ?>
                <p class="col-span-3 text-center text-gray-500">Saat ini belum ada layanan yang tersedia.</p>
            <?php endif; ?>
        </div>
    </section>

    <footer class="bg-gray-800 text-white text-center py-10">
        <p class="font-bold text-xl">Fokus.ID</p>
        <p class="text-gray-400 mt-2">© <?= date('Y') ?> Fokus Studio. All rights reserved.</p>
    </footer>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true, duration: 800, offset: 100 });
        
        const navbar = document.getElementById('navbar');
        const menuToggle = document.getElementById('menuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        
        const dropdownContainer = document.getElementById('dropdown-container');
        const dropdownToggle = document.getElementById('dropdown-toggle');
        const dropdownMenu = document.getElementById('dropdown-menu');

        // Fungsionalitas Menu Mobile dengan Animasi Slide
        // Kita salin juga link dari dropdown desktop
        const desktopNav = navbar.querySelector('nav');
        if (desktopNav) {
            mobileMenu.innerHTML = desktopNav.innerHTML;
        }

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('opacity-0');
            mobileMenu.classList.toggle('-translate-y-full');
            mobileMenu.classList.toggle('pointer-events-none');
        });

        // Fungsionalitas Dropdown Desktop dengan Animasi Fade & Scale
        if (dropdownToggle) {
            dropdownToggle.addEventListener('click', () => {
                dropdownMenu.classList.toggle('scale-95');
                dropdownMenu.classList.toggle('opacity-0');
                dropdownMenu.classList.toggle('pointer-events-none');
            });

            // Menutup dropdown jika klik di luar area
            window.addEventListener('click', function(e) {
                if (dropdownContainer && !dropdownContainer.contains(e.target)) {
                    dropdownMenu.classList.add('scale-95', 'opacity-0', 'pointer-events-none');
                }
            });
        }
    </script>
</body>
</html>