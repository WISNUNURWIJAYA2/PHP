<?php
include 'auth_admin.php';
include 'koneksi.php';

$cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';
$where = $cari ? "WHERE username LIKE '%$cari%'" : '';

$query = mysqli_query($conn, "SELECT * FROM admin $where ORDER BY role DESC, username ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Akun</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
<div class="bg-white p-6 rounded shadow-md w-full max-w-3xl">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">📋 Daftar Akun (Admin & User)</h1>
        <a href="index.php" class="text-blue-600 hover:underline">← Kembali</a>
    </div>

    <!-- Form Pencarian -->
    <form method="GET" class="mb-4 flex gap-2">
        <input type="text" name="cari" placeholder="Cari username..." value="<?= htmlspecialchars($cari) ?>" class="w-full border p-2 rounded">
        <button type="submit" class="bg-yellow-600 text-white px-4 rounded hover:bg-yellow-700">Cari</button>
    </form>

    <table class="w-full table-auto border-collapse">
        <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-white">
            <tr class="text-left">
                <th class="px-4 py-2">No</th>
                <th class="px-4 py-2">Username</th>
                <th class="px-4 py-2">Role</th>
                <th class="px-4 py-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($query)) : ?>
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2"><?= $no++ ?></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($row['username']) ?></td>
                    <td class="px-4 py-2">
                        <?php if ($row['role'] === 'admin'): ?>
                            <span class="bg-green-200 text-green-800 px-2 py-1 rounded text-sm">Admin</span>
                        <?php else: ?>
                            <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded text-sm">User</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-2 text-center">
                        <?php if ($_SESSION['admin'] !== $row['username']) : ?>
                            <a href="hapus_akun.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin hapus akun ini?')" class="text-red-600 hover:underline">Hapus</a>
                        <?php else: ?>
                            <span class="text-gray-400 italic">Sedang login</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
