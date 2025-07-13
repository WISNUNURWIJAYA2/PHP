<!-- <?php
include '../auth_user.php';
include '../koneksi.php';

$user_id = $_SESSION['user_id'];
$data = mysqli_query($conn, "SELECT * FROM cuti WHERE karyawan_id = $user_id ORDER BY tanggal_mulai DESC");


?> -->
<?php
session_start();
include '../auth_user.php';
include '../koneksi.php';

if (!isset($_SESSION['user_id'])) {
  die('Session user_id tidak ditemukan. Pastikan user login!');
}

$user_id = $_SESSION['user_id'];

$data = mysqli_query($conn, "SELECT * FROM cuti WHERE karyawan_id = $user_id ORDER BY tanggal_mulai DESC");
?>


<!DOCTYPE html>
<html>

<head>
    <title>Cuti Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 px-6 py-10">
    <h2 class="text-2xl font-bold mb-4">Daftar Cuti Saya</h2>

    <table class="table-auto w-full bg-white shadow rounded text-sm">
        <thead class="bg-gray-100 text-left text-gray-700">
            <tr>
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">Tanggal Mulai</th>
                <th class="px-4 py-2">Tanggal Selesai</th>
                <th class="px-4 py-2">Keterangan</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Jabatan</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($data)) { ?>
                <tr class="border-t">
                    <td class="px-4 py-2"><?= $row['karyawan_id'] ?></td>
                    <td class="px-4 py-2"><?= $row['tanggal_mulai'] ?></td>
                    <td class="px-4 py-2"><?= $row['tanggal_selesai'] ?></td>
                    <td class="px-4 py-2"><?= $row['keterangan'] ?></td>
                    <td class="px-4 py-2"><?= $row['email'] ?></td>
                    <td class="px-4 py-2"><?= $row['jabatan'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>