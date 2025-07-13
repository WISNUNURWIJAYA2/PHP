<?php
include '../auth_admin.php';
include '../koneksi.php';

if (!isset($_GET['id'])) {
    header('Location: list.php');
    exit;
}

$id = $_GET['id'];

// Cek apakah jabatan digunakan oleh karyawan
$cek_relasi = mysqli_query($conn, "SELECT * FROM karyawan WHERE jabatan_id = $id");
if (mysqli_num_rows($cek_relasi) > 0) {
    echo "<script>alert('Jabatan tidak dapat dihapus karena sedang digunakan oleh karyawan.'); window.location.href='list.php';</script>";
    exit;
}

// Cek dan hapus jika aman
$cek = mysqli_query($conn, "SELECT id FROM jabatan WHERE id = $id");
if (mysqli_num_rows($cek) === 0) {
    header('Location: list.php');
    exit;
}

mysqli_query($conn, "DELETE FROM jabatan WHERE id = $id");
header('Location: list.php');
exit;
?>
