<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['admin_username'])) {
  header('Location: index.php');
  exit;
}

if (isset($_GET['id'])) {
  $id = (int) $_GET['id'];
  $hapus = mysqli_query($conn, "DELETE FROM layanan WHERE id = $id");

  if ($hapus) {
    header('Location: kelola_layanan.php');
    exit;
  } else {
    die("Gagal menghapus layanan: " . mysqli_error($conn));
  }
} else {
  header('Location: kelola_layanan.php');
  exit;
}
