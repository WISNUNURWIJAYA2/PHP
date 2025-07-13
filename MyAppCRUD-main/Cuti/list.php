<?php
include '../auth_user.php';
include '../koneksi.php';
$result = mysqli_query($conn, "SELECT cuti.*, karyawan.nama FROM cuti JOIN karyawan ON cuti.karyawan_id = karyawan.id");


// Konfigurasi pagination
$batas = 10;
$halaman = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;
$mulai = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';
$where = $cari !== '' ? "WHERE 
    k.nama LIKE '%$cari%' OR 
    k.nik LIKE '%$cari%' OR 
    k.email LIKE '%$cari%' OR 
    j.nama_jabatan LIKE '%$cari%'" : "";

// Hitung total data
$totalQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM karyawan k LEFT JOIN jabatan j ON k.jabatan_id = j.id $where");
$total = mysqli_fetch_assoc($totalQuery)['total'];
$pages = ceil($total / $batas);

// Ambil data sesuai halaman
$dataQuery = mysqli_query($conn, "SELECT k.*, j.nama_jabatan FROM karyawan k 
    LEFT JOIN jabatan j ON k.jabatan_id = j.id 
    $where ORDER BY k.nama ASC 
    LIMIT $mulai, $batas");

$is_admin = ($_SESSION['role'] === 'admin');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Data Cuti</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold">Data Cuti Karyawan</h1>
            <a href="tambah.php" class="text-yellow-600 hover:underline">Tambah Data Cuti</a>
            <a href="../index.php" class="text-blue-600 hover:underline">Kembali ke Dashboard</a>
        </div>

        <!-- Form Pencarian -->
        <form method="GET" class="mb-4 flex gap-2">
            <input type="text" name="cari" placeholder="Cari nama, email, jabatan..." value="<?= htmlspecialchars($cari) ?>"
                class="w-full border p-2 rounded" />
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Cari</button>
        </form>

        <!-- Tabel -->
        <div class="relative overflow-x-auto">
            <table class="w-full bg-white shadow rounded text-sm text-left table-auto">
                <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-white">
                    <tr>
                        <th class="px-4 py-2 ">No</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Tanggal mulai</th>
                        <th class="px-4 py-2">Tanggal Selesai</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Jabatan</th>
                        <th class="px-4 py-2">Keterangan</th>
                        <?php if ($is_admin): ?>
                            <th class="px-4 py-2">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = $mulai + 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td class="px-4 py-2"><?= $no++ ?></td>
                            <td class="px-4 py-2"><?= $row['nama'] ?></td>
                            <td class="px-4 py-2"><?= $row['tanggal_mulai'] ?></td>
                            <td class="px-4 py-2"><?= $row['tanggal_selesai'] ?></td>
                            <td class="px-4 py-2"><?= $row['email'] ?></td>
                            <td class="px-4 py-2"><?= $row['jabatan'] ?></td>
                            <td class="px-4 py-2"><?= $row['keterangan'] ?></td>
                            <?php if ($is_admin): ?>
                                <td class="px-4 py-2">
                                    <a href="edit.php?id=<?= $row['id'] ?>" class="text-yellow-600 hover:underline">Edit</a> |
                                    <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin?')" class="text-red-600 hover:underline">Hapus</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>

        <!-- Navigasi Halaman -->
        <div class="mt-4 flex justify-center gap-2">
            <?php if ($halaman > 1): ?>
                <a href="?halaman=<?= $halaman - 1 ?>&cari=<?= urlencode($cari) ?>" class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">Prev</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $pages; $i++): ?>
                <a href="?halaman=<?= $i ?>&cari=<?= urlencode($cari) ?>"
                    class="px-3 py-1 rounded <?= $i == $halaman ? 'bg-blue-600 text-white' : 'bg-gray-200 hover:bg-gray-300' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($halaman < $pages): ?>
                <a href="?halaman=<?= $halaman + 1 ?>&cari=<?= urlencode($cari) ?>" class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">Next</a>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>