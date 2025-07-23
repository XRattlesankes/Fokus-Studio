<?php
session_start();
// Pastikan menggunakan session 'admin_username' agar konsisten
if (!isset($_SESSION['admin_username'])) {
    header("Location: ../login_admin.php");
    exit;
}
include '../config/koneksi.php';

// Ambil data galeri (Fungsi Asli)
$result = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Galeri - Admin</title>
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
                <a href="kelola_layanan.php" class="flex items-center px-6 py-3 text-gray-500 hover:bg-gray-200">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <span class="mx-3">Kelola Layanan</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-700 bg-gray-200 font-semibold">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l-1-1m-4 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    <span class="mx-3">Kelola Galeri</span>
                </a>
            </nav>
        </div>
    </div>

    <div class="flex flex-col flex-1 overflow-y-auto">
        <header class="flex items-center justify-between h-20 px-6 bg-white border-b">
            <h2 class="text-3xl font-bold text-gray-800">Kelola Galeri</h2>
            <button onclick="openModal()" class="flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                Tambah Foto
            </button>
        </header>
        
        <main class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <?php
                        $gambar = $row['nama_file'];
                        $img_src = filter_var($gambar, FILTER_VALIDATE_URL) ? $gambar : "../assets/img/galeri/" . htmlspecialchars($gambar);
                    ?>
                <div class="group relative bg-white rounded-lg shadow-lg overflow-hidden aspect-w-1 aspect-h-1">
                    <img src="<?= $img_src ?>" alt="<?= htmlspecialchars($row['deskripsi']) ?>" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-60 transition-all duration-300"></div>
                    
                    <div class="absolute bottom-0 left-0 p-4 w-full opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                        <h3 class="font-bold text-white text-base truncate"><?= htmlspecialchars($row['kategori']) ?></h3>
                        <p class="text-xs text-gray-200 truncate"><?= htmlspecialchars($row['deskripsi']) ?></p>
                    </div>

                    <form action="../proses/hapus_foto.php" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus foto ini?')" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="hidden" name="nama_file" value="<?= $row['nama_file'] ?>">
                        <button type="submit" class="p-2 bg-red-600 text-white rounded-full hover:bg-red-700 focus:outline-none shadow-xl">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </button>
                    </form>
                </div>
                <?php endwhile; ?>
                
                <?php if(mysqli_num_rows($result) === 0): ?>
                    <div class="col-span-full bg-white text-center p-12 rounded-lg shadow-lg">
                         <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l-1-1m-4 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Galeri Kosong</h3>
                        <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan foto baru.</p>
                        <div class="mt-6">
                            <button type="button" onclick="openModal()" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                                Tambah Foto Pertama
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</div>

<div id="uploadModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md transform transition-all" id="modal-content">
        <div class="flex justify-between items-center p-5 border-b">
            <h2 class="text-xl font-bold text-gray-800">Upload Foto Baru</h2>
            <button onclick="closeModal()" class="p-2 rounded-full text-gray-400 hover:bg-gray-200 hover:text-gray-600">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
        <form action="../proses/upload_foto.php" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            <div>
                <label for="kategori" class="block mb-2 text-sm font-medium text-gray-700">Kategori</label>
                <input type="text" id="kategori" name="kategori" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="3" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Sumber Foto</label>
                <div class="flex gap-2 mt-1">
                    <button type="button" onclick="showUploadType('file')" id="btnFile" class="flex-1 bg-blue-600 text-white px-3 py-2 rounded-md text-sm font-semibold">Upload File</button>
                    <button type="button" onclick="showUploadType('url')" id="btnUrl" class="flex-1 bg-gray-200 text-gray-700 px-3 py-2 rounded-md text-sm font-semibold">Gunakan URL</button>
                </div>
                <div id="uploadFile" class="mt-3">
                    <label for="foto" class="sr-only">Upload File</label>
                    <input type="file" id="foto" name="foto" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
                <div id="uploadUrl" class="mt-3 hidden">
                    <label for="foto_url" class="sr-only">URL Gambar</label>
                    <input type="url" id="foto_url" name="foto_url" placeholder="https://example.com/image.jpg" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
            </div>
            <div class="pt-4">
                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors shadow-md">Upload Foto</button>
            </div>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('uploadModal');
    const modalContent = document.getElementById('modal-content');
    const inputFoto = document.getElementById('foto');
    const inputUrl = document.getElementById('foto_url');

    function openModal() {
        showUploadType('file'); // Set default ke upload file saat modal dibuka
        modal.classList.remove('hidden');
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }
    
    function closeModal() {
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => modal.classList.add('hidden'), 200);
    }
    
    function showUploadType(type) {
        const isFile = type === 'file';
        document.getElementById('uploadFile').classList.toggle('hidden', !isFile);
        document.getElementById('uploadUrl').classList.toggle('hidden', isFile);

        // Mengatur atribut 'required' secara dinamis
        inputFoto.required = isFile;
        inputUrl.required = !isFile;

        // Mengatur style tombol aktif
        const btnFile = document.getElementById('btnFile');
        const btnUrl = document.getElementById('btnUrl');
        btnFile.classList.toggle('bg-blue-600', isFile);
        btnFile.classList.toggle('text-white', isFile);
        btnFile.classList.toggle('bg-gray-200', !isFile);
        btnFile.classList.toggle('text-gray-700', !isFile);
        
        btnUrl.classList.toggle('bg-blue-600', !isFile);
        btnUrl.classList.toggle('text-white', !isFile);
        btnUrl.classList.toggle('bg-gray-200', isFile);
        btnUrl.classList.toggle('text-gray-700', isFile);
    }
    
    modalContent.classList.add('scale-95', 'opacity-0', 'transition-all', 'duration-200');
</script>

</body>
</html>