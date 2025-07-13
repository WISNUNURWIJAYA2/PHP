<?php
session_start(); // WAJIB: untuk akses $_SESSION

include '../auth_user.php'; // validasi login
include '../koneksi.php';

if (!isset($_SESSION['user_id'])) {
    die("Session tidak ditemukan. Silakan login ulang.");
}

$user_id = $_SESSION['user_id'];

// Ambil data user (nama, email, jabatan)
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM karyawan WHERE id = $user_id"));

if ($_POST) {
    $user_id = $_POST['karyawan_id'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];
    $keterangan = $_POST['keterangan'];
    $email = $user['email'];
    $jabatan = $user['jabatan']; // pastikan kolom 'jabatan' tersedia di tabel karyawan

    mysqli_query($conn, "INSERT INTO cuti (karyawan_id, tanggal_mulai, tanggal_selesai, email, jabatan, keterangan) 
        VALUES ('$user_id', '$tanggal_mulai', '$tanggal_selesai', '$email', '$jabatan', '$keterangan')");

    header("Location: user_list.php?msg=sukses");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Ajukan Cuti</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <h2 class="text-xl font-bold text-center text-blue-600 mb-4">Ajukan Cuti</h2>

        <form method="POST" class="space-y-4">
            <!-- Nama (readonly) -->
            <div>
                <label class="block mb-1 font-semibold text-gray-700">Nama</label>
                <input type="text" value="<?= htmlspecialchars($user['karyawan_id']) ?>" readonly
                    class="w-full border bg-gray-100 border-gray-300 rounded px-3 py-2" />
            </div>

            <!-- Tanggal mulai -->
            <div>
                <label class="block mb-1 font-semibold text-gray-700">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <!-- Tanggal selesai -->
            <div>
                <label class="block mb-1 font-semibold text-gray-700">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label class="block mb-1 font-semibold text-gray-700">email</label>
                <input type="email" name="email" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label class="block mb-1 font-semibold text-gray-700">jabatan</label>
                <input type="jabatan" name="jabatan" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <!-- Keterangan -->
            <div>
                <label class="block mb-1 font-semibold text-gray-700">Keterangan</label>
                <textarea name="keterangan" rows="3" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Contoh: Cuti tahunan, sakit, keperluan keluarga..."></textarea>
            </div>

            <!-- Tombol -->
            <div class="text-center">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
                    Ajukan Cuti
                </button>
            </div>
        </form>
    </div>
</body>

</html>