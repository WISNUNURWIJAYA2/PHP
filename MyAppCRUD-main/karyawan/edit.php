<?php
include '../auth_admin.php';
include '../koneksi.php';

if (!isset($_GET['id'])) {
    header('Location: ../index.php');
    exit;
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM karyawan WHERE id = $id");
$data = mysqli_fetch_assoc($result);

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

    $query = "UPDATE karyawan SET
                nama = '$nama',
                nik = '$nik',
                email = '$email',
                telepon = '$telepon',
                jabatan_id = '$jabatan_id',
                gaji = '$gaji',
                tanggal_masuk = '$tanggal_masuk',
                status = '$status'
              WHERE id = $id";
    mysqli_query($conn, $query);
    header('Location: ../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Data Karyawan</h1>
    <form method="POST" class="bg-white p-6 rounded shadow-md space-y-4">
        <div>
            <label class="block mb-1">Nama</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required class="w-full border p-2 rounded">
        </div>
        <div>
            <label class="block mb-1">NIK</label>
            <input type="text" name="nik" value="<?= htmlspecialchars($data['nik']) ?>" required class="w-full border p-2 rounded">
        </div>
        <div>
            <label class="block mb-1">Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required class="w-full border p-2 rounded">
        </div>
        <div>
            <label class="block mb-1">Telepon</label>
            <input type="text" name="telepon" value="<?= htmlspecialchars($data['telepon']) ?>" required class="w-full border p-2 rounded">
        </div>
        <div>
            <label class="block mb-1">Jabatan</label>
            <select name="jabatan_id" required class="w-full border p-2 rounded">
                <?php while ($j = mysqli_fetch_assoc($jabatan)): ?>
                    <option value="<?= $j['id'] ?>" <?= $j['id'] == $data['jabatan_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($j['nama_jabatan']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div>
            <label class="block mb-1">Gaji</label>
            <input type="number" name="gaji" value="<?= htmlspecialchars($data['gaji']) ?>" required class="w-full border p-2 rounded">
        </div>
        <div>
            <label class="block mb-1">Status</label>
            <select name="status" required class="w-full border p-2 rounded">
                <option value="Aktif" <?= $data['status'] === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                <option value="Nonaktif" <?= $data['status'] === 'Nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
            </select>
        </div>
        <div class="flex justify-between">
            <a href="../index.php" class="text-blue-600 hover:underline">← Kembali</a>
            <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Update</button>
        </div>
    </form>
</div>
</body>
</html>
