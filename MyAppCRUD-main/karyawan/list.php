<?php
// koneksi.php tetap sama
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'hriskrywn_db';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

<!-- jabatan/list.php -->
<?php include '../koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Jabatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Manajemen Jabatan</h1>

        <div class="flex justify-between mb-4">
            <a href="tambah.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">+ Tambah Jabatan</a>
            <a href="../index.php" class="text-blue-600 hover:underline">← Kembali ke Data Karyawan</a>
        </div>

        <table class="min-w-full bg-white rounded-lg shadow-md">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 text-left">No</th>
                    <th class="py-2 px-4 text-left">Nama Jabatan</th>
                    <th class="py-2 px-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = mysqli_query($conn, "SELECT * FROM jabatan");
                while ($row = mysqli_fetch_assoc($query)) {
                ?>
                <tr class="border-t hover:bg-gray-100">
                    <td class="py-2 px-4"><?php echo $no++; ?></td>
                    <td class="py-2 px-4"><?php echo htmlspecialchars($row['nama_jabatan']); ?></td>
                    <td class="py-2 px-4 text-center space-x-2">
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
                        <a href="hapus.php?id=<?php echo $row['id']; ?>" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded btn-hapus">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
