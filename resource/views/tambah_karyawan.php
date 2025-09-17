<?php 
include __DIR__ . "/../../database/db.php";
include __DIR__ . "/../../controllers/karyawanController.php";

$controller = new KaryawanController($conn);

// proses tambah data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store($_POST, $_FILES);
    header("Location: karyawan_list.php"); // setelah tambah langsung ke daftar
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Karyawan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-800">

<?php include __DIR__ . '/../template/sidebar.php'; ?>
<div class="ml-64 p-6"> 

<div class="container mx-auto p-6">
  <h1 class="text-2xl font-bold mb-4">Tambah Karyawan</h1>

  <!-- Form Input -->
  <form method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow space-y-4">
    
    <!-- NIP -->
    <div>
      <label class="block font-medium mb-1">NIP:</label>
      <input type="text" name="nip" required 
             class="w-full border p-2 rounded focus:ring focus:ring-blue-200">
    </div>

    <!-- Nama -->
    <div>
      <label class="block font-medium mb-1">Nama Karyawan:</label>
      <input type="text" name="nama" required 
             class="w-full border p-2 rounded focus:ring focus:ring-blue-200">
    </div>

    <!-- Status Pegawai -->
    <div>
      <label class="block font-medium mb-1">Status Pegawai:</label>
      <select name="status_pegawai" required 
              class="w-full border p-2 rounded focus:ring focus:ring-blue-200">
        <option value="">-- Pilih Status Pegawai --</option>
        <option value="tetap">Pegawai Tetap</option>
        <option value="kontrak">Kontrak</option>
        <option value="probation">Probation</option>
        <option value="freelance">Freelance</option>
      </select>
    </div>

    <!-- Tanggal Awal -->
    <div>
      <label class="block font-medium mb-1">Tanggal Awal:</label>
      <input type="date" name="tgl_awal_kontrak" required 
             class="w-full border p-2 rounded focus:ring focus:ring-blue-200">
    </div>

    <!-- Tanggal Akhir -->
    <div>
      <label class="block font-medium mb-1">Tanggal Akhir:</label>
      <input type="date" name="tgl_akhir_kontrak" required 
             class="w-full border p-2 rounded focus:ring focus:ring-blue-200">
    </div>

    <!-- Status -->
    <div>
      <label class="block font-medium mb-1">Status:</label>
      <select name="status" required 
              class="w-full border p-2 rounded focus:ring focus:ring-blue-200">
        <option value="active">Active</option>
        <option value="expiring soon">Expiring Soon</option>
        <option value="expired">Expired</option>
      </select>
    </div>

    <!-- Catatan -->
    <div>
      <label class="block font-medium mb-1">Catatan:</label>
      <textarea name="note" rows="3" 
                class="w-full border p-2 rounded focus:ring focus:ring-blue-200"></textarea>
    </div>

    <!-- Upload File -->
    <div>
      <label class="block font-medium mb-1">Upload Dokumen:</label>
      <input type="file" name="files[]" multiple 
             class="w-full border p-2 rounded focus:ring focus:ring-blue-200">
      <p class="text-sm text-gray-500">file pdf</p>
    </div>

    <!-- Tombol -->
    <div class="pt-2">
      <button type="submit" 
              class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        <i class="fa fa-save"></i> Simpan
      </button>
      <a href="karyawan_list.php" 
         class="ml-2 text-gray-600 hover:underline">Batal</a>
    </div>
  </form>
</div>

</body>
</html>
