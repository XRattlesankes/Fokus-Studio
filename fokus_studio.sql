-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jul 2025 pada 16.17
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fokus_studio`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama_lengkap`) VALUES
(3, 'admin', '$2y$10$fMjXqUL5G4aWG9gr2hbWneBqRzQdvzNu/js7Q/ZV3yRrmEMvnoY1K', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nomor_wa` varchar(20) NOT NULL,
  `layanan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('pending','confirmed','cancelled') DEFAULT 'confirmed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `booking`
--

INSERT INTO `booking` (`id`, `nama`, `email`, `nomor_wa`, `layanan`, `tanggal`, `status`) VALUES
(1, 'Raihan', 'raihan@example.com', '081234567890', 1, '2025-08-10', 'confirmed'),
(3, 'jason', 'jey@gmail.com', '082176548972', 1, '2025-07-25', 'confirmed'),
(4, 'irwin', 'Wadowuhuy17@gmail.com', '090838164123', 3, '2025-07-25', 'confirmed'),
(5, 'farhan', 'fafa@gmail.com', '082176548972', 4, '2025-08-15', 'pending'),
(9, 'indira', 'seruni@gmail.com', '082148482004', 1, '2025-08-06', 'pending'),
(10, 'bari', 'jey@gmail.com', '090838164123', 1, '2025-08-01', 'confirmed'),
(11, 'farhan jekbab', 'fafa@gmail.com', '087700197031', 1, '2025-07-23', 'confirmed');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `id` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `kategori` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `galeri`
--

INSERT INTO `galeri` (`id`, `nama_file`, `url`, `kategori`, `deskripsi`) VALUES
(1, 'https://images.unsplash.com/photo-1701027650719-26d223876edc?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NTJ8fHdlZGRpbmclMjBwaG90byUyMHN0dWRpb3xlbnwwfHwwfHx8MA%3D%3D', 'https://images.unsplash.com/photo-1701027650719-26d223876edc?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NTJ8fHdlZGRpbmclMjBwaG90byUyMHN0dWRpb3xlbnwwfHwwfHx8MA%3D%3D', 'Wedding', 'Dokumentasi momen spesial pelanggan kami.'),
(5, 'https://i.pinimg.com/1200x/fa/5b/5e/fa5b5e8a29d9e404eec1fafb7ed9c857.jpg', NULL, 'Graduation', 'Dokumentasi graduation sekolah'),
(6, 'https://i.pinimg.com/736x/cc/f1/83/ccf18337e8e27e42a945b1a7ca8d20db.jpg', NULL, 'Wedding', 'Foto prewed pelanggan'),
(7, 'https://images.unsplash.com/photo-1713434638446-13b4a15b728e?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdCUyMHBob3RvJTIwc3R1ZGlvfGVufDB8fDB8fHww', NULL, 'Produk', 'Foto produk sabun '),
(9, 'https://i.pinimg.com/736x/f5/d7/1b/f5d71b0eaf6534384f1f35cb75cb59b0.jpg', NULL, 'Wedding', 'Foto Pengantin Pria & Wanita'),
(10, 'https://i.pinimg.com/1200x/15/15/10/151510bdc433575f0eac09d9362d6f4a.jpg', NULL, 'Wedding', 'Foto Pengantin Pria & Wanita'),
(11, 'https://i.pinimg.com/736x/30/31/60/303160aec37461f94df5b095c1530d65.jpg', NULL, 'Wedding', 'Foto Pengantin Pria & Wanita'),
(12, 'https://i.pinimg.com/736x/74/73/e5/7473e576908e7cf5b6d083f75c811d8a.jpg', NULL, 'Wedding', 'Foto Pengantin Pria & Wanita'),
(13, 'https://i.pinimg.com/736x/f6/de/47/f6de475c56bf7dd9f5eb2ff275b2c469.jpg', NULL, 'Wedding', 'Foto Pengantin Wanita Dengan Siluet Pengantin Pria'),
(14, 'https://i.pinimg.com/736x/de/6b/2b/de6b2bd4586fd6abbe740c949a8a8c11.jpg', NULL, 'Wedding', 'Foto Pengantin Pria & Wanita'),
(15, 'https://i.pinimg.com/736x/f5/06/37/f50637e7c2fa6d121330c5e275b53ca7.jpg', NULL, 'Wedding', 'Foto Pengantin Pria & Wanita'),
(16, 'https://i.pinimg.com/1200x/c0/e4/5c/c0e45c464cead5f4b68dbfe5fe7904d1.jpg', NULL, 'Wedding', 'Foto Pengantin Pria & Wanita'),
(17, 'https://i.pinimg.com/1200x/c2/74/81/c274814458bb252ebb01bb9cb264d8c5.jpg', NULL, 'Graduation', 'Foto Graduation'),
(18, 'https://i.pinimg.com/1200x/f9/b3/53/f9b3534a46f6f81078d0e79bd1153fec.jpg', NULL, 'Graduation', 'Foto Graduation'),
(19, 'https://i.pinimg.com/736x/dc/15/0d/dc150dd4766bb09fd9990b1940b4d8e8.jpg', NULL, 'Graduation', 'Foto Graduation '),
(20, 'https://i.pinimg.com/1200x/cf/d9/00/cfd9004320a325d7d126d7e63e88b461.jpg', NULL, 'Graduation', 'Foto Graduation '),
(21, 'https://i.pinimg.com/736x/db/f6/f3/dbf6f3c59d831ede35f11bb2f6ecc826.jpg', NULL, 'Graduation', 'Foto Graduation'),
(22, 'https://i.pinimg.com/736x/73/07/b8/7307b814e83d881b3bf90ddc94e064f7.jpg', NULL, 'Graduation', 'Foto Graduation'),
(23, 'https://i.pinimg.com/736x/dd/97/0c/dd970c77a275dddb58c3634f79ac6f4c.jpg', NULL, 'Graduation', 'Foto Graduation'),
(25, 'https://i.pinimg.com/1200x/8e/07/8f/8e078f1954d7cb4fc487d2df09d8441f.jpg', NULL, 'Graduation', 'Foto Graduation'),
(26, 'https://i.pinimg.com/736x/4a/df/75/4adf75b3388419cc38d47fbcc106ca13.jpg', NULL, 'Produk', 'Foto Produk '),
(27, 'https://i.pinimg.com/1200x/6a/c2/8a/6ac28a8ad5c1029f255c24081dc1fda4.jpg', NULL, 'Produk', 'Foto Produk'),
(28, 'https://i.pinimg.com/736x/f0/73/6c/f0736c903597b2ed1dbd8f0e079001d4.jpg', NULL, 'Produk', 'Foto Produk'),
(29, 'https://i.pinimg.com/1200x/22/8d/4f/228d4ff1c4035c391736158e68d8f4a3.jpg', NULL, 'Produk', 'Foto Produk Makanan'),
(30, 'https://i.pinimg.com/736x/9b/30/c5/9b30c56fdd77c11fc237d0f07e7629d2.jpg', NULL, 'Produk', 'Foto Produk Makanan'),
(31, 'https://i.pinimg.com/1200x/d6/41/a0/d641a0baebf71cf94032df80c7ab4ae7.jpg', NULL, 'Produk', 'Foto Produk Makanan '),
(32, 'https://i.pinimg.com/736x/6b/32/68/6b3268d85eea1fc7a2530d6b80e9c5c0.jpg', NULL, 'Produk', 'Foto Produk Pakaian'),
(33, 'https://i.pinimg.com/736x/4b/e1/23/4be123802fc0c0c572b45079b447eaad.jpg', NULL, 'Produk', 'Foto Produk Pakaian'),
(34, 'https://i.pinimg.com/1200x/ec/7c/a4/ec7ca43c16736076453b1d7fe9f2a351.jpg', NULL, 'Produk', 'Foto Produk Pakaian'),
(35, 'https://i.pinimg.com/1200x/01/49/7f/01497fa7fda93a8361216cbafc71f584.jpg', NULL, 'Graduation', 'Foto Graduation');

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan`
--

CREATE TABLE `layanan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `durasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `layanan`
--

INSERT INTO `layanan` (`id`, `nama`, `deskripsi`, `harga`, `durasi`) VALUES
(1, 'Paket Wedding', 'Mengabadikan Momen Once In A Life Time Mu DI Studio', 2500000, '5'),
(3, 'Paket Produk', 'Foto Produk Menggunakan Kualitas Studio', 750000, '4'),
(4, 'Paket Graduation', 'Foto Graduation Di Studio', 850000, '4');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `layanan` (`layanan`);

--
-- Indeks untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`layanan`) REFERENCES `layanan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
