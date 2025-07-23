<?php
include 'config/koneksi.php';
// Ambil 3 layanan teratas untuk ditampilkan sebagai paket populer
$layanan_q = mysqli_query($conn, "SELECT * FROM layanan ORDER BY id ASC LIMIT 3");
// Ambil 6 foto galeri terbaru untuk preview
$galeri_q = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC LIMIT 6");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Fokus Studio – Jasa Fotografi Profesional</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-angled { clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%); }
        /* Style untuk navbar saat di-scroll */
        .navbar-scrolled {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
        /* Mengubah warna teks dan tombol di navbar saat di-scroll */
        .navbar-scrolled .nav-link { color: #374151; } /* text-gray-700 */
        .navbar-scrolled .nav-brand { color: #2563eb; } /* text-blue-600 */
        .navbar-scrolled #menuToggle { color: #374151; } /* text-gray-700 */
    </style>
</head>
<body class="bg-white text-gray-800">

    <header id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex justify-between items-center">
            <a href="index.php" class="text-2xl font-bold text-white nav-brand transition-colors">Fokus.ID</a>
            
            <nav class="hidden md:flex items-center space-x-8">
                <a href="index.php" class="text-gray-200 nav-link hover:text-blue-600 font-medium transition-colors">Beranda</a>
                <a href="paket.php" class="text-gray-200 nav-link hover:text-blue-600 font-medium transition-colors">Paket</a>
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

    <section id="beranda" class="bg-cover bg-center h-screen relative hero-angled" style="background-image: url('https://images.unsplash.com/photo-1617463874381-85b513b3e991?q=80&w=1170&auto=format&fit=crop');">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-black/20"></div>
        <div class="relative z-10 h-full flex items-center justify-center">
            <div class="text-center text-white px-6" data-aos="fade-down" data-aos-duration="1200">
                <h1 class="text-4xl md:text-6xl font-extrabold mb-4 tracking-tight leading-tight">Abadikan Momen, Ciptakan Kenangan</h1>
                <p class="text-lg md:text-xl mb-8 text-gray-200 max-w-2xl mx-auto">Layanan fotografi profesional untuk setiap momen berharga dalam hidup Anda.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#paket" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold px-8 py-3 rounded-lg shadow-lg transition duration-200 transform hover:scale-105">Lihat Paket</a>
                    <a href="galeri.php" class="inline-block bg-transparent hover:bg-white/20 border-2 border-white text-white font-bold px-8 py-3 rounded-lg shadow-lg transition duration-200 transform hover:scale-105">Lihat Galeri</a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white text-center px-6">
        <h2 class="text-3xl font-bold mb-4" data-aos="fade-up">Mengapa Memilih Fokus Studio?</h2>
        <p class="text-gray-600 max-w-3xl mx-auto text-lg leading-relaxed mb-12" data-aos="fade-up" data-aos-delay="200">
            Kami percaya setiap klik adalah investasi dalam kenangan. Dengan tim profesional dan peralatan terbaik, kami berkomitmen memberikan hasil yang melampaui ekspektasi.
        </p>
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-6" data-aos="fade-up" data-aos-delay="300">
                <div class="bg-blue-100 text-blue-600 rounded-full h-16 w-16 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Tim Profesional</h3>
                <p class="text-gray-500">Fotografer dan kru kami berpengalaman dan ramah, siap membantu Anda di setiap sesi.</p>
            </div>
             <div class="p-6" data-aos="fade-up" data-aos-delay="400">
                <div class="bg-green-100 text-green-600 rounded-full h-16 w-16 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Peralatan Terbaik</h3>
                <p class="text-gray-500">Kami menggunakan kamera dan lensa standar industri untuk memastikan kualitas gambar tertinggi.</p>
            </div>
             <div class="p-6" data-aos="fade-up" data-aos-delay="500">
                <div class="bg-yellow-100 text-yellow-600 rounded-full h-16 w-16 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01M12 12v.01M12 12a2 2 0 01-.01 0V12zm0-4a2 2 0 110-4 2 2 0 010 4z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Harga Kompetitif</h3>
                <p class="text-gray-500">Dapatkan hasil premium dengan penawaran paket terbaik yang sesuai dengan anggaran Anda.</p>
            </div>
        </div>
    </section>

    <section id="paket" class="py-20 bg-gray-50 px-6">
    <h2 class="text-3xl font-bold text-center mb-12" data-aos="fade-up">Paket Populer Kami</h2>
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php 
            mysqli_data_seek($layanan_q, 0); // Reset pointer query
            $i = 0; 
            while ($row = mysqli_fetch_assoc($layanan_q)): 
        ?>
        <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col transform hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
            <div class="p-6 border-b">
                <h3 class="text-2xl font-bold text-gray-800"><?= htmlspecialchars($row['nama']) ?></h3>
                <p class="text-gray-500 mt-2"><?= htmlspecialchars($row['deskripsi']) ?></p>
            </div>
            <div class="p-6 flex-grow">
                <p class="text-sm text-gray-500 mb-2">Mulai dari</p>
                <p class="text-4xl font-extrabold text-gray-900">Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
            </div>
            <div class="p-6 bg-gray-50">
                <a href="booking.php?layanan_id=<?= $row['id'] ?>" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition-colors">Pilih Paket Ini</a>
            </div>
        </div>
        <?php $i++; endwhile; ?>
    </div>
    <div class="text-center mt-12" data-aos="fade-up">
        <a href="paket.php" class="text-blue-600 hover:text-blue-800 font-bold text-lg transition">Lihat Semua Paket Layanan →</a>
    </div>
</section>

    <section class="py-20 bg-white px-6">
        <h2 class="text-3xl font-bold text-center mb-12" data-aos="fade-up">Apa Kata Mereka?</h2>
        <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-gray-50 p-8 rounded-xl" data-aos="fade-right">
                <p class="text-gray-600 mb-4 italic">"Hasil fotonya luar biasa! Tim Fokus Studio sangat profesional dan membuat sesi foto wisuda saya menjadi momen yang tak terlupakan. Sangat direkomendasikan!"</p>
                <p class="font-bold text-gray-800">- Anisa Putri</p>
                <p class="text-sm text-gray-500">Mahasiswa</p>
            </div>
             <div class="bg-gray-50 p-8 rounded-xl" data-aos="fade-left">
                <p class="text-gray-600 mb-4 italic">"Untuk foto produk bisnis saya, hasilnya tajam dan sangat menjual. Prosesnya cepat dan komunikasinya mudah. Terima kasih, Fokus Studio!"</p>
                <p class="font-bold text-gray-800">- Budi Santoso</p>
                <p class="text-sm text-gray-500">Pengusaha</p>
            </div>
        </div>
    </section>
    
    <section class="py-20 bg-gray-50 px-6">
        <h2 class="text-3xl font-bold text-center mb-10" data-aos="fade-up">Intip Karya Terbaru Kami</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 max-w-7xl mx-auto">
            <?php $delay = 0; while($g = mysqli_fetch_assoc($galeri_q)): ?>
            <div class="overflow-hidden rounded-lg shadow-lg" data-aos="zoom-in" data-aos-delay="<?= $delay ?>">
                <a href="galeri.php">
                    <img src="<?= filter_var($g['nama_file'], FILTER_VALIDATE_URL) ? $g['nama_file'] : 'assets/img/galeri/'.htmlspecialchars($g['nama_file']) ?>" alt="Foto Galeri" class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-300">
                </a>
            </div>
            <?php $delay += 100; endwhile; ?>
        </div>
        <div class="text-center mt-10" data-aos="fade-up">
            <a href="galeri.php" class="text-blue-600 hover:text-blue-800 font-bold text-lg transition">Lihat Galeri Lengkap →</a>
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