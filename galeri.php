<?php 
include 'config/koneksi.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Galeri Dinamis - Fokus Studio</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/css/glightbox.min.css" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    .hero-angled {
      clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
    }
    .masonry-container {
      column-count: 1;
      column-gap: 1.5rem;
    }
    .masonry-item {
      display: inline-block;
      width: 100%;
      margin-bottom: 1.5rem;
      break-inside: avoid;
    }
    @media (min-width: 640px) { .masonry-container { column-count: 2; } }
    @media (min-width: 1024px) { .masonry-container { column-count: 3; } }
  </style>
</head>
<body class="bg-gray-50">

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

<header class="bg-gray-800 hero-angled mb-[-4rem] md:mb-[-6rem]">
  <div class="bg-cover bg-center h-80 md:h-96" style="background-image: url('assets/img/cover.jpg');">
    <div class="bg-black bg-opacity-60 w-full h-full flex flex-col items-center justify-center text-center p-4" data-aos="fade-down">
      <h1 class="text-white text-4xl md:text-5xl font-bold tracking-tight">Abadikan Momen Anda</h1>
      <p class="text-white text-lg mt-3 max-w-xl">Setiap gambar memiliki cerita. Biarkan kami menjadi bagian dari cerita Anda.</p>
    </div>
  </div>
</header>

<main class="relative z-10">
  <form method="GET" class="pt-20 md:pt-28 pb-8 px-6 text-center space-y-4 md:space-y-0 md:flex md:justify-center md:items-center md:gap-4" data-aos="fade-up">
    <select name="kategori" class="border border-gray-300 px-4 py-2 rounded-lg bg-white text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
      <option value="">Semua Kategori</option>
      <?php
        $kategori_q = mysqli_query($conn, "SELECT DISTINCT kategori FROM galeri");
        while ($k = mysqli_fetch_assoc($kategori_q)) {
          $selected = (isset($_GET['kategori']) && $_GET['kategori'] == $k['kategori']) ? 'selected' : '';
          echo "<option value='" . htmlspecialchars($k['kategori']) . "' $selected>" . htmlspecialchars($k['kategori']) . "</option>";
        }
      ?>
    </select>

    <select name="sort" class="border border-gray-300 px-4 py-2 rounded-lg bg-white text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
      <option value="">Urutkan Galeri</option>
      <option value="terbaru" <?= (isset($_GET['sort']) && $_GET['sort'] == 'terbaru') ? 'selected' : '' ?>>Terbaru</option>
      <option value="terlama" <?= (isset($_GET['sort']) && $_GET['sort'] == 'terlama') ? 'selected' : '' ?>>Terlama</option>
    </select>

    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 shadow-sm transition-colors">Terapkan</button>
  </form>

  <section class="pb-12 px-6">
    <div class="max-w-7xl mx-auto masonry-container">
      <?php
        $where = '';
        $order = 'ORDER BY id DESC';

        if (!empty($_GET['kategori'])) {
          $kategori = mysqli_real_escape_string($conn, $_GET['kategori']);
          $where = "WHERE kategori = '$kategori'";
        }

        if (!empty($_GET['sort']) && $_GET['sort'] == 'terlama') {
          $order = "ORDER BY id ASC";
        }

        $query = mysqli_query($conn, "SELECT * FROM galeri $where $order");

        if (!$query) {
          echo "<p class='text-red-600'>Terjadi kesalahan: " . mysqli_error($conn) . "</p>";
        } elseif (mysqli_num_rows($query) === 0) {
          echo "<p class='text-gray-600 col-span-3 text-center'>Tidak ada data galeri ditemukan.</p>";
        } else {
          while ($row = mysqli_fetch_assoc($query)) {
            $gambar     = $row['nama_file'];
            $kategori   = $row['kategori'];
            $deskripsi  = $row['deskripsi'];

            $is_url = filter_var($gambar, FILTER_VALIDATE_URL);
            $img_src = $is_url ? $gambar : "assets/img/galeri/" . $gambar;
            $extra_attributes = $is_url ? 'data-type="image"' : '';
            $safe_title = htmlspecialchars($deskripsi, ENT_QUOTES, 'UTF-8');

            if ($is_url || file_exists("assets/img/galeri/$gambar")) {
              echo "
                <div class='masonry-item' data-aos='fade-up' data-aos-once='true'>
                  <a href='$img_src' 
                     class='glightbox group block rounded-xl shadow-lg overflow-hidden relative' 
                     data-gallery='galeri' 
                     data-title='$safe_title'
                     $extra_attributes>
                    
                    <img src='$img_src' alt='Foto " . htmlspecialchars($kategori) . "' class='w-full h-auto object-cover transition-transform duration-500 ease-in-out group-hover:scale-110'>
                    
                    <div class='absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black/80 to-transparent translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-in-out'>
                      <h3 class='text-white font-bold text-lg'>" . htmlspecialchars($kategori) . "</h3>
                      <p class='text-white text-sm opacity-90'>$safe_title</p>
                    </div>
                  </a>
                </div>
              ";
            }
          }
        }
      ?>
    </div>
  </section>
</main>

<footer class="bg-white border-t text-center py-5">
  <p class="text-sm text-gray-600">&copy; 2025 Fokus Studio. All rights reserved.</p>
</footer>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/js/glightbox.min.js"></script>
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
