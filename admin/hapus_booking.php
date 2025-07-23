<?php
session_start();
include '../config/koneksi.php';
if (!isset($_SESSION['admin_username'])) {
  header('Location: ../login_admin.php'); exit;
}
$id = (int)($_GET['id'] ?? 0);
mysqli_query($conn, "DELETE FROM booking WHERE id = $id");
header('Location: kelola_booking.php');
exit;
