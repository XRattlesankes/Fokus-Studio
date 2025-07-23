<?php
include '../config/koneksi.php'; // Pastikan path ini sesuai dengan struktur proyekmu

// Ganti sesuai kebutuhan
$username = 'admin';
$password_plain = 'admin123'; // Password asli (nanti akan di-hash)

// Hash password menggunakan algoritma bawaan PHP
$hashed_password = password_hash($password_plain, PASSWORD_DEFAULT);

// Simpan ke database
$query = "INSERT INTO admin (username, password) VALUES ('$username', '$hashed_password')";
if (mysqli_query($conn, $query)) {
    echo "<h2>✅ Admin berhasil dibuat!</h2>";
    echo "<p><strong>Username:</strong> $username</p>";
    echo "<p><strong>Password:</strong> $password_plain</p>";
} else {
    echo "<h2>❌ Gagal membuat admin:</h2><p>" . mysqli_error($conn) . "</p>";
}
?>
