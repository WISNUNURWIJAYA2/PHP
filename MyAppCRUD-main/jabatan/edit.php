<?php
include '../auth_admin.php';
include '../koneksi.php';

if (!isset($_GET['id'])) {
    header('Location: list.php');
    exit;
}

$id = $_GET['id'];
$cek = mysqli_query($conn, "SELECT * FROM jabatan WHERE id = $id");
$data = mysqli_fetch_assoc($cek);

if (!$data) {
    header('Location: list.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    if ($nama !== '') {
        mysqli_query($conn, "UPDATE jabatan SET nama_jabatan = '$nama' WHERE id = $id");
        header('Location: list.php');
        exit;
    } else {
        $error = 'Nama jabatan tidak boleh kosong';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Jabatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Jabatan</h1>
    <form method="POST" class="bg-white p-6 rounded shadow-md space-y-4">
        <?php if (isset($error)) echo "<p class='text-red-500'>$error</p>"; ?>
        <div>
            <label class="block mb-1">Nama Jabatan</label>
            <input type="text" name="nama" value="<?= $data['nama_jabatan'] ?>" required class="w-full border p-2 rounded">
        </div>
        <div class="flex justify-between">
            <a href="list.php" class="text-blue-600 hover:underline">← Kembali</a>
            <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Update</button>
        </div>
    </form>
</div>
</body>
</html>
