<?php
include '../auth_admin.php';
include '../koneksi.php';

if (!isset($_GET['id'])) {
    header('Location: ../index.php');
    exit;
}

$id = $_GET['id'];

// Cek apakah data ada
$cek = mysqli_query($conn, "SELECT id FROM karyawan WHERE id = $id");
if (mysqli_num_rows($cek) === 0) {
    header('Location: ../index.php');
    exit;
}

// Hapus data
mysqli_query($conn, "DELETE FROM karyawan WHERE id = $id");
header('Location: ../index.php');
exit;
?>
