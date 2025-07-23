<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Hubungi Kami – Fokus Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-angled-sm { clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%); }
        .navbar-scrolled {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
        .navbar-scrolled .nav-link,
        .navbar-scrolled .nav-brand,
        .navbar-scrolled #menuToggle {
            color: #374151; /* text-gray-700 */
        }
    </style>
</head>
<body class="bg-white text-gray-800">

        <header id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex justify-between items-center">
                    <a href="index.php" class="text-2xl font-bold text-white nav-brand transition-colors">Fokus.ID</a>
                    
                    <nav class="hidden md:flex items-center space-x-8">
                        <a href="index.php" class="text-gray-200 nav-link hover:text-blue-600 font-medium transition-colors">Beranda</a>
                        <a href="index.php#paket" class="text-gray-200 nav-link hover:text-blue-600 font-medium transition-colors">Paket</a>
                        <a href="galeri.php" class="text-gray-200 nav-link hover:text-blue-600 font-medium transition-colors">Galeri</a>

                        <div class="relative" id="dropdown-container">
                            <button id="dropdown-toggle" class="flex items-center text-gray-200 nav-link hover:text-blue-600 font-medium transition-colors">
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
                        <button id="menuToggle" class="text-white focus:outline-none transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
            <div id="mobileMenu" class="md:hidden bg-white p-4 space-y-2 transition-all duration-300 ease-in-out transform -translate-y-full opacity-0 absolute w-full pointer-events-none">
                </div>
        </header>

    <section class="bg-gray-700 pt-32 pb-20 hero-angled-sm" style="background-image: url('https://images.unsplash.com/photo-1617463874381-85b513b3e991?q=80&w=1170&auto=format&fit=crop');">
         <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            <div class="text-center text-white px-6" data-aos="fade-down">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">Hubungi Kami</h1>
            <p class="text-lg mt-4 text-gray-300">Kami siap membantu mewujudkan momen spesial Anda.</p>
        </div>
    </section>

    <section class="py-20 px-6">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div data-aos="fade-right">
                <h2 class="text-3xl font-bold mb-6">Informasi Kontak</h2>
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="bg-blue-100 text-blue-600 p-3 rounded-full"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg></div>
                        <div>
                            <h3 class="font-semibold text-lg">Alamat Studio</h3>
                            <p class="text-gray-600">FX Sudirman, F5, 54321, Indonesia</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="bg-blue-100 text-blue-600 p-3 rounded-full"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg></div>
                        <div>
                            <h3 class="font-semibold text-lg">Email</h3>
                            <a href="mailto:info@fokusstudio.com" class="text-gray-600 hover:text-blue-600 transition">fokus@gmail.com</a>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="bg-blue-100 text-blue-600 p-3 rounded-full"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg></div>
                        <div>
                            <h3 class="font-semibold text-lg">Telepon / WhatsApp</h3>
                            <a href="https://wa.me/6281234567890" target="_blank" class="text-gray-600 hover:text-blue-600 transition">0812-3456-7890</a>
                        </div>
                    </div>
                     <div class="flex items-start gap-4">
                        <div class="bg-blue-100 text-blue-600 p-3 rounded-full"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                        <div>
                            <h3 class="font-semibold text-lg">Jam Operasional</h3>
                            <p class="text-gray-600">Senin - Sabtu: 10:00 - 18:00 WIB</p>
                            <p class="text-gray-600">Minggu & Hari Libur: Tutup</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full h-80 lg:h-full rounded-2xl overflow-hidden shadow-2xl" data-aos="fade-left">
                <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d5609.186219286777!2d106.80336724350714!3d-6.22496350509702!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sid!2sid!4v1753025096759!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <footer class="bg-gray-800 text-white text-center py-10">
        <p class="font-bold text-xl">Fokus.ID</p>
        <p class="text-gray-400 mt-2">&copy; <?= date('Y') ?> Fokus Studio. All rights reserved.</p>
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

    // Efek scroll pada Navbar
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    });

    // Fungsionalitas Menu Mobile dengan Animasi Slide
    const desktopNavLinks = navbar.querySelector('nav').innerHTML;
    mobileMenu.innerHTML = desktopNavLinks;
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
            if (!dropdownContainer.contains(e.target)) {
                dropdownMenu.classList.add('scale-95', 'opacity-0', 'pointer-events-none');
            }
        });
    }
</script>
</body>
</html>