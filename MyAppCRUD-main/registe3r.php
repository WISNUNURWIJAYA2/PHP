<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = $_POST['role'];

    $cek = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Username sudah digunakan.";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($conn, "INSERT INTO admin (username, password, role) VALUES ('$username', '$hashed', '$role')");
        $success = "Akun berhasil dibuat. <a href='login.php' class='text-blue-600 underline'>Login sekarang</a>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register HRIS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="flex justify-center items-center h-screen bg-gray-100">


    <?php if (isset($error)) echo "<p class='text-red-500'>$error</p>"; ?>
    <?php if (isset($success)) echo "<p class='text-green-600'>$success</p>"; ?>

    <div class="aldo">
        <div class="bg-white p-6 rounded shadow-md w-96">
            <h1 class="text-2xl font-bold mb-4">Buat Akun</h1>

            <form method="POST" class="space-y-4">
                <input type="text" name="username" placeholder="Username" class="w-full border p-2 rounded" required>
                <input type="password" name="password" placeholder="Password" class="w-full border p-2 rounded" required>
                <select name="role" class="w-full border p-2 rounded" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Daftar</button>
            </form>
            <p class="text-sm mt-4 text-center">Sudah punya akun?
                <a href="login.php" class="text-blue-600 hover:underline">Login</a>
            </p>
        </div>
    </div>
</body>

</html>