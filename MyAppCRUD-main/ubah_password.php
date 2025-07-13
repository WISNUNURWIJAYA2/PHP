<?php
include 'auth_user.php';
include 'koneksi.php';

$username = $_SESSION['admin']; // ambil username dari sesi

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lama = $_POST['password_lama'];
    $baru = $_POST['password_baru'];
    $konfirmasi = $_POST['konfirmasi_password'];

    $cek = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
    $data = mysqli_fetch_assoc($cek);

    if (!password_verify($lama, $data['password'])) {
        $error = "Password lama salah!";
    } elseif ($baru !== $konfirmasi) {
        $error = "Konfirmasi password tidak cocok!";
    } else {
        $hash = password_hash($baru, PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE admin SET password = '$hash' WHERE username = '$username'");
        $success = "Password berhasil diubah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ubah Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex justify-center items-center min-h-screen bg-gray-100">
<div class="bg-white p-6 rounded shadow-md w-full max-w-md">
    <h1 class="text-2xl font-bold mb-4">Ubah Password</h1>

    <?php if (isset($error)) echo "<p class='text-red-500'>$error</p>"; ?>
    <?php if (isset($success)) echo "<p class='text-green-600'>$success</p>"; ?>

    <form method="POST" class="space-y-4">
        <div>
            <label class="block mb-1">Password Lama</label>
            <input type="password" name="password_lama" required class="w-full border p-2 rounded">
        </div>
        <div>
            <label class="block mb-1">Password Baru</label>
            <input type="password" name="password_baru" required class="w-full border p-2 rounded">
        </div>
        <div>
            <label class="block mb-1">Konfirmasi Password Baru</label>
            <input type="password" name="konfirmasi_password" required class="w-full border p-2 rounded">
        </div>
        <div class="flex justify-between">
            <a href="index.php" class="text-gray-600 hover:underline">← Kembali</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Ubah Password</button>
        </div>
    </form>
</div>
</body>
</html>
