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

<?php if (isset($success)) : ?>
    <div class="fixed top-10 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-sm p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-md">
        <div class="flex justify-between items-start">
            <div class="text-sm font-medium">
                ✅ <?= $success ?>
            </div>
            <button onclick="this.parentElement.parentElement.remove();" class="ml-4 text-green-700 hover:text-green-900 text-xl leading-none">&times;</button>
        </div>
    </div>
<?php endif; ?>

<?php if (isset($error)) : ?>
    <div class="fixed top-10 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-sm p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg shadow-md">
        <div class="flex justify-between items-start">
            <div class="text-sm font-medium">
                ❌ <?= $error ?>
            </div>
            <button onclick="this.parentElement.parentElement.remove();" class="ml-4 text-red-700 hover:text-red-900 text-xl leading-none">&times;</button>
        </div>
    </div>
<?php endif; ?>


     <div class="wisnu"> 
        <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form class="space-y-6" action="#" method="POST">
                <h5 class="text-xl text-center font-medium text-gray-900 dark:text-white">Daftar Akun HRIS</h5>
                <div>
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> username</label>
                    <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="username" required />
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                </div>

                <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Pilih Role :</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>

                <div class="flex justify-center">
                    <button type="submit" class="w-md text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-8 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Daftar</button>
                </div>
                <div class=" text-center text-sm font-medium text-gray-500 dark:text-gray-300">
                    Sudah punya akun? <a href="login.php" class="text-blue-700 hover:underline dark:text-blue-500">Login akun</a>
                </div>
            </form>
        </div>

    </div> 

</body>

</html>