<?php
session_start();
include '../config/koneksi.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Cek username kosong
if (!$username || !$password) {
    echo "<script>alert('Harap isi semua data'); window.location.href='../login_admin.php';</script>";
    exit;
}

// Ambil data admin berdasarkan username
$query = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");

if (!$query || mysqli_num_rows($query) === 0) {
    echo "<script>alert('Username tidak ditemukan'); window.location.href='../login_admin.php';</script>";
    exit;
}

$data = mysqli_fetch_assoc($query);

// Verifikasi password
if (password_verify($password, $data['password'])) {
    // Login berhasil
    $_SESSION['admin_id'] = $data['id'];
    $_SESSION['admin_username'] = $data['username'];
    header('Location: ../admin/dashboard.php');
    exit; // WAJIB agar redirect tidak gagal
} else {
    echo "<script>alert('Password salah'); window.location.href='../login_admin.php';</script>";
    exit;
}
