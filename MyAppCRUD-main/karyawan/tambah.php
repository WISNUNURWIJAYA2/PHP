<?php
include '../auth_admin.php';
include '../koneksi.php';

$jabatan = mysqli_query($conn, "SELECT * FROM jabatan");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $jabatan_id = $_POST['jabatan_id'];
    $gaji = $_POST['gaji'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $status = $_POST['status'];

    $query = "INSERT INTO karyawan (nama, nik, email, telepon, jabatan_id, gaji , tanggal_masuk, status)
              VALUES ('$nama', '$nik', '$email', '$telepon', '$jabatan_id', '$gaji', '$tanggal_masuk', '$status')";
    mysqli_query($conn, $query);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Data Karyawan</h1>
    <form method="POST" class="bg-white p-6 rounded shadow-md space-y-4">
        <div>
            <label class="block mb-1">Nama</label>
            <input type="text" name="nama" required class="w-full border p-2 rounded">
        </div>
        <div>
            <label class="block mb-1">NIK</label>
            <input type="text" name="nik" required class="w-full border p-2 rounded">
        </div>
        <div>
            <label class="block mb-1">Email</label>
            <input type="email" name="email" required class="w-full border p-2 rounded">
        </div>
        <div>
            <label class="block mb-1">Telepon</label>
            <input type="number" name="telepon" required class="w-full border p-2 rounded">
        </div>
        <div>
            <label class="block mb-1">Jabatan</label>
            <select name="jabatan_id" required class="w-full border p-2 rounded">
                <option value="">-- Pilih Jabatan --</option>
                <?php while ($j = mysqli_fetch_assoc($jabatan)): ?>
                    <option value="<?= $j['id'] ?>"><?= $j['nama_jabatan'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div>
            <label class="block mb-1">Gaji</label>
            <input type="number" name="gaji" required class="w-full border p-2 rounded">
        </div>
        <div>
            <label class="block mb-1">Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" required class="w-full border p-2 rounded">
        </div>
        <div>
            <label class="block mb-1">Status</label>
            <select name="status" required class="w-full border p-2 rounded">
                <option value="Aktif">Aktif</option>
                <option value="Nonaktif">Nonaktif</option>
            </select>
        </div>
        <div class="flex justify-between">
            <a href="index.php" class="text-blue-600 hover:underline">← Kembali</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
        </div>
    </form>
</div>
</body>
</html>
