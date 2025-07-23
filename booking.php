<?php include 'config/koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Booking Sesi – Fokus Studio</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    /* Header dengan potongan diagonal, sama seperti galeri */
    .hero-angled {
      clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
    }
  </style>
</head>
<body class="bg-gray-50">
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

  <header class="bg-gray-800 hero-angled mb-[-4rem] md:mb-[-6rem]">
      <div class="bg-cover bg-center h-80 md:h-96" style="background-image: url('assets/img/cover.jpg');">
        <div class="bg-black bg-opacity-60 w-full h-full flex flex-col items-center justify-center text-center p-4" data-aos="fade-down">
          <h1 class="text-white text-4xl md:text-5xl font-bold tracking-tight">Reservasi Sesi Anda</h1>
          <p class="text-white text-lg mt-3 max-w-xl">Lengkapi form di bawah ini untuk mengamankan jadwal pemotretan Anda bersama kami.</p>
        </div>
      </div>
  </header>

  <main class="relative z-10">
    <div class="max-w-5xl mx-auto pt-20 md:pt-28 pb-12 px-6">
      <form action="proses/simpan_booking.php" method="POST" class="bg-white p-8 rounded-2xl shadow-2xl" data-aos="fade-up">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">

          <div class="space-y-6">
            <div>
              <label for="nama" class="block mb-2 font-semibold text-gray-700">Nama Lengkap</label>
              <input type="text" id="nama" name="nama" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" />
            </div>
            <div>
              <label for="email" class="block mb-2 font-semibold text-gray-700">Email</label>
              <input type="email" id="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" />
            </div>
            <div>
              <label for="nomor_wa" class="block mb-2 font-semibold text-gray-700">Nomor WhatsApp</label>
              <input type="tel" id="nomor_wa" name="nomor_wa" required pattern="^\d{9,15}$" placeholder="081234567890" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" />
            </div>
            <div>
              <label for="tanggal" class="block mb-2 font-semibold text-gray-700">Pilih Tanggal Booking</label>
              <input type="date" id="tanggal" name="tanggal" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" />
            </div>
          </div>

          <div class="space-y-6">
            <div>
              <label for="layanan" class="block mb-2 font-semibold text-gray-700">Pilih Layanan</label>
              <select name="layanan_id" id="layanan" required class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition" onchange="tampilkanDetail()">
                <option value="">-- Pilih Layanan --</option>
                <?php
                  $q = mysqli_query($conn, "SELECT * FROM layanan");
                  while ($r = mysqli_fetch_assoc($q)) {
                    echo "<option value='{$r['id']}' data-harga='{$r['harga']}' data-durasi='{$r['durasi']}'>{$r['nama']}</option>";
                  }
                ?>
              </select>
            </div>

            <div id="detailLayanan" class="bg-gray-50 border border-dashed rounded-xl p-6 space-y-4 transition-all duration-300">
              <h3 class="text-lg font-bold text-gray-800 border-b pb-2">Ringkasan Booking</h3>
              <div class="flex justify-between items-center">
                <span class="text-gray-600">Durasi Sesi: </span>
                <span id="durasiText" class="font-semibold text-gray-800 text-lg">-</span>
              </div>
              <div class="flex justify-between items-center">
                <span class="text-gray-600">Harga:</span>
                <span id="hargaText" class="font-semibold text-blue-600 text-lg">-</span>
              </div>
            </div>
          </div>

          <div class="md:col-span-2 text-center pt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-3 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 font-semibold text-lg">
              Kirim Booking
            </button>
          </div>

        </div>
      </form>
    </div>
  </main>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 600,
      once: true
    });

    function tampilkanDetail() {
      const select = document.getElementById('layanan');
      const detailBox = document.getElementById('detailLayanan');
      const durasiEl = document.getElementById('durasiText');
      const hargaEl = document.getElementById('hargaText');

      if (select.value) {
        const selected = select.options[select.selectedIndex];
        const harga = selected.getAttribute('data-harga');
        const durasi = selected.getAttribute('data-durasi');

        // Mengisi data
        durasiEl.textContent = durasi;
        hargaEl.textContent = 'Rp ' + parseInt(harga).toLocaleString('id-ID');

        // Memberi efek visual pada kartu ringkasan
        detailBox.classList.remove('border-dashed');
        detailBox.classList.add('border-solid', 'bg-blue-50', 'shadow-md');

      } else {
        // Mengembalikan ke state awal jika tidak ada yang dipilih
        durasiEl.textContent = '-';
        hargaEl.textContent = '-';
        detailBox.classList.add('border-dashed');
        detailBox.classList.remove('border-solid', 'bg-blue-50', 'shadow-md');
      }
    }
    // Panggil sekali saat load untuk memastikan tampilan awal benar
    tampilkanDetail();
  </script>
</body>
</html>