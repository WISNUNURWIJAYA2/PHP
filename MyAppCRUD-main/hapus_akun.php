<?php
include 'auth_admin.php';
include 'koneksi.php';

$id = $_GET['id'] ?? null;

// Cegah hapus akun sendiri
$cek = mysqli_query($conn, "SELECT * FROM admin WHERE id = '$id'");
$data = mysqli_fetch_assoc($cek);

if ($data && $data['username'] !== $_SESSION['admin']) {
    mysqli_query($conn, "DELETE FROM admin WHERE id = '$id'");
}

header("Location: daftar_akun.php");
exit;
