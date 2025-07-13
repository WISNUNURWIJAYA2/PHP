
<!-- ori -->
 <?php
        session_start();
        include 'koneksi.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
            $data = mysqli_fetch_assoc($query);

            if ($data && password_verify($password, $data['password'])) {
                $_SESSION['user_id'] = $data['id']; 
                $_SESSION['role'] = $data['role'];
                $_SESSION['admin'] = $data['username']; 

                header('Location: index.php');
                exit;
            } else {
                $error = 'Username atau password salah';
            }
        }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login HRIS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="flex justify-center items-center h-screen bg-gray-100">
    <!-- <div class="bg-white p-6 rounded shadow-md w-96"> -->


    <?php if (isset($error)) echo "<p class='text-red-500'>$error</p>"; ?>
    <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <form class="space-y-6" action="#" method="POST">
            <h5 class="text-xl text-center font-medium text-gray-900 dark:text-white">Login HRIS</h5>
            <div>
                <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your username</label>
                <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="username" required />
            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
            </div>
            <div class="flex justify-center">
                <button type="submit" class="w-md text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-8 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
            </div>
            <div class=" text-center text-sm font-medium text-gray-500 dark:text-gray-300">
                Belum punya akun? <a href="register.php" class="text-blue-700 hover:underline dark:text-blue-500">daftar akun</a>
            </div>
        </form>
    </div>



    <!-- </div> -->

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>