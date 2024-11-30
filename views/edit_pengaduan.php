<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
  header("Location: login.php");
  exit();
}

if (isset($_POST['id_pengaduan']) && isset($_POST['status_pengaduan'])) {
  $id_pengaduan = $_POST['id_pengaduan'];
  $status_pengaduan = $_POST['status_pengaduan'];

  $sql = "UPDATE pengaduan SET status_pengaduan = :status_pengaduan WHERE id_pengaduan = :id_pengaduan";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':status_pengaduan', $status_pengaduan);
  $stmt->bindParam(':id_pengaduan', $id_pengaduan);

  if ($stmt->execute()) {
    header("Location: admin_dashboard.php");
    exit();
  } else {
    echo "Gagal memperbarui status pengaduan.";
  }
} else {
  echo "Data tidak lengkap.";
}
?>
