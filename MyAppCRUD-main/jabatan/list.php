<?php
include '../auth_admin.php';
include '../koneksi.php';

$jabatan = mysqli_query($conn, "SELECT * FROM jabatan ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Jabatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Data Jabatan</h1>
        <div class="space-x-2">
            <a href="tambah.php" class="bg-green-600 text-white px-3 py-1 rounded">+ Jabatan</a>
            <a href="../index.php" class="bg-blue-600 text-white px-3 py-1 rounded">← Kembali</a>
        </div>
    </div>

    <table class="relative min-w-full bg-white rounded shadow">
        <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-white">
            <tr>
                <th class="px-4 py-2 text-left">No</th>
                <th class="px-4 py-2 text-left">Nama Jabatan</th>
                <th class="px-4 py-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($jabatan)): ?>
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-2"><?= $no++ ?></td>
                <td class="px-4 py-2"><?= $row['nama_jabatan'] ?></td>
                <td class="px-4 py-2 text-center space-x-2">
                    <a href="edit.php?id=<?= $row['id'] ?>" class="text-yellow-500 hover:underline">Edit</a>
                    <a href="hapus.php?id=<?= $row['id'] ?>" class="text-red-500 hover:underline" onclick="return confirm('Hapus jabatan ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
