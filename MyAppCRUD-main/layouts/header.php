<!-- layout/header.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>HRIS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-lg font-bold">HRIS Karyawan</h1>
            <?php if (isset($_SESSION['admin'])): ?>
                <div class="text-sm">
                    Login sebagai: <strong><?= $_SESSION['admin'] ?></strong> (<?= $_SESSION['role'] ?>)
                    | <a href="/hris/logout.php" class="underline">Logout</a>
                </div>
            <?php endif; ?>
        </div>
    </header>
    <main class="container mx-auto px-4 py-6">
