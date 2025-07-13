<?php
include '../koneksi.php';

if ($_POST) {
  $karyawan_id = $_POST['karyawan_id'];
  $mulai = $_POST['tanggal_mulai'];
  $selesai = $_POST['tanggal_selesai'];
  $email = $_POST['email'];
  $jabatan = $_POST['jabatan'];
  $keterangan = $_POST['keterangan'];

  mysqli_query($conn, "INSERT INTO cuti (karyawan_id, tanggal_mulai, tanggal_selesai, email, jabatan, keterangan) 
    VALUES ('$karyawan_id', '$mulai', '$selesai', '$email', '$jabatan', '$keterangan')");

  header("Location: list.php");
  exit;
}

$result = mysqli_query($conn, "SELECT * FROM karyawan");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tambah Cuti Karyawan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">

  <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Tambah Data Cuti Karyawan</h2>

    <form method="POST" class="space-y-4">
      <!-- Karyawan -->
      <div>
        <label class="block mb-1 font-semibold text-gray-700">Nama Karyawan</label>
        <select name="karyawan_id" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <?php while ($k = mysqli_fetch_assoc($result)) { ?>
            <option value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
          <?php } ?>
        </select>
      </div>

      <!-- Tanggal Mulai -->
      <div>
        <label class="block mb-1 font-semibold text-gray-700">Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

      <!-- Tanggal Selesai -->
      <div>
        <label class="block mb-1 font-semibold text-gray-700">Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>
      <!-- email -->
      <div>
        <label class="block mb-1 font-semibold text-gray-700">Email</label>
        <input type="email" name="email" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>
      <!-- jabatan -->
      <div>
        <label class="block mb-1 font-semibold text-gray-700">jabatan</label>
        <input type="jabatan" name="jabatan" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

      <!-- Keterangan -->
      <div>
        <label class="block mb-1 font-semibold text-gray-700">Keterangan</label>
        <textarea name="keterangan" required rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Cuti tahunan, sakit, dll..."></textarea>
      </div>

      <!-- Tombol -->
      <div class="text-center">
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">Simpan</button>
      </div>
    </form>
  </div>

</body>

</html>