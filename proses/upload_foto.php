<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: ../login_admin.php");
    exit;
}

include '../config/koneksi.php';

// Tangkap input form
$kategori  = mysqli_real_escape_string($conn, $_POST['kategori']);
$deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
$foto_url  = isset($_POST['foto_url']) ? trim($_POST['foto_url']) : null;

// Path upload
$upload_dir = '../assets/img/galeri/';
$nama_file  = '';

if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK && empty($foto_url)) {
    // Upload via FILE
    $tmp_name = $_FILES['foto']['tmp_name'];
    $original_name = basename($_FILES['foto']['name']);
    $extension = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg', 'png', 'webp'];

    if (!in_array($extension, $allowed_ext)) {
        echo "<script>alert('Format gambar tidak didukung!'); window.location.href = '../admin/kelola_galeri.php';</script>";
        exit;
    }

    // Generate nama file unik
    $nama_file = uniqid('img_', true) . '.' . $extension;

    if (!move_uploaded_file($tmp_name, $upload_dir . $nama_file)) {
        echo "<script>alert('Gagal menyimpan gambar!'); window.location.href = '../admin/kelola_galeri.php';</script>";
        exit;
    }
} elseif (!empty($foto_url) && filter_var($foto_url, FILTER_VALIDATE_URL)) {
    // Upload via URL
    $nama_file = $foto_url;
} else {
    echo "<script>alert('Harap pilih file atau isi URL yang valid!'); window.location.href = '../admin/kelola_galeri.php';</script>";
    exit;
}

// Simpan ke database
$query = "INSERT INTO galeri (kategori, deskripsi, nama_file) VALUES ('$kategori', '$deskripsi', '$nama_file')";
if (mysqli_query($conn, $query)) {
    header("Location: ../admin/kelola_galeri.php?success=1");
    exit;
} else {
    echo "<script>alert('Gagal menyimpan ke database!'); window.location.href = '../admin/kelola_galeri.php';</script>";
    exit;
}
