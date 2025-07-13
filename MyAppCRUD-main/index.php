<?php
include 'auth_user.php';
include 'koneksi.php';

// Statistik (khusus admin)
if ($_SESSION['role'] === 'admin') {
    $total_karyawan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM karyawan"))['total'];
    $total_admin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM admin WHERE role='admin'"))['total'];
    $total_user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM admin WHERE role='user'"))['total'];
    $total_jabatan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM jabatan"))['total'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard HRIS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold">Selamat Datang di HRIS</h1>
                <p class="text-gray-700">Login sebagai: <strong><?= $_SESSION['admin']; ?></strong> (<?= $_SESSION['role']; ?>)</p>
            </div>
            <div class="space-x-2">
                <a href="ubah_password.php" class="bg-yellow-600 text-white px-3 py-2 rounded hover:bg-yellow-700">🔑 Ubah Password</a>
                <a href="logout.php" class="bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700">👋 Logout</a>
            </div>
        </div>

        <!-- Statistik (Admin Only) -->
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded shadow p-4 text-center">
                    <p class="text-gray-500 text-sm">Total Karyawan</p>
                    <p class="text-2xl font-bold text-blue-700"><?= $total_karyawan ?></p>
                </div>
                <div class="bg-white rounded shadow p-4 text-center">
                    <p class="text-gray-500 text-sm">Akun Admin</p>
                    <p class="text-2xl font-bold text-green-700"><?= $total_admin ?></p>
                </div>
                <div class="bg-white rounded shadow p-4 text-center">
                    <p class="text-gray-500 text-sm">Akun User</p>
                    <p class="text-2xl font-bold text-yellow-700"><?= $total_user ?></p>
                </div>
                <div class="bg-white rounded shadow p-4 text-center">
                    <p class="text-gray-500 text-sm">Total Jabatan</p>
                    <p class="text-2xl font-bold text-purple-700"><?= $total_jabatan ?></p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Menu -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <a href="karyawan/tambah.php" class="block bg-blue-600 text-white p-4 rounded hover:bg-blue-700">➕ Tambah Karyawan</a>
                <a href="jabatan/list.php" class="block bg-purple-600 text-white p-4 rounded hover:bg-purple-700">📋 Kelola Jabatan</a>
                <a href="buat_akun.php" class="block bg-green-600 text-white p-4 rounded hover:bg-green-700">👥 Buat Akun Baru</a>
                <a href="daftar_akun.php" class="block bg-orange-600 text-white p-4 rounded hover:bg-orange-700">📋 Daftar Akun</a>
            <?php endif; ?>
            <a href="karyawan/index.php" class="block bg-gray-600 text-white p-4 rounded hover:bg-gray-700">📁 Lihat Data Karyawan</a>
            <a href="Cuti/list.php" class="block bg-red-600 text-white p-4 rounded hover:bg-red-700">📅 Data Cuti Karyawan</a>
        </div>

    </div>
</body>

</html>