<?php 
include __DIR__ . "/../../database/db.php";
include __DIR__ . "/../../controllers/KaryawanController.php";

$controller = new KaryawanController($conn);

// hapus data
if (isset($_GET['delete'])) {
    $controller->delete($_GET['delete']);
    header("Location: karyawan_list.php");
    exit;
}

$karyawanList = $controller->getAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Karyawan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-800">

<?php include __DIR__ . '/../template/sidebar.php'; ?>
<div class="ml-64 p-6"> 

<div class="container mx-auto p-6">
  <h1 class="text-2xl font-bold mb-4">Data Karyawan</h1>

  <!-- <a href="tambah_karyawan.php" class="mb-4 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
    <i class="fa fa-plus"></i> Tambah Karyawan
  </a> -->

  <div class="bg-white p-6 rounded shadow overflow-x-auto">
    <h2 class="text-xl font-bold mb-4">Daftar Karyawan</h2>
    <table class="table-auto w-full border-collapse border border-gray-200 text-sm">
      <thead>
        <tr class="bg-gray-100">
          <th class="border p-2">No. SPK</th>
          <th class="border p-2">NIP</th>
          <th class="border p-2">Nama</th>
          <th class="border p-2">Departemen</th>
          <th class="border p-2">Divisi</th>
          <th class="border p-2">Jabatan</th>
          <th class="border p-2">Status Pegawai</th>
          <th class="border p-2">Tanggal Masuk</th>
          <th class="border p-2">Tanggal Akhir</th>
          <th class="border p-2">Sisa Hari</th>
          <th class="border p-2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($karyawanList)): ?>
          <?php foreach ($karyawanList as $k): ?>
            <tr>
              <td class="border p-2"><?= htmlspecialchars($k['no_spk']) ?></td>
              <td class="border p-2"><?= htmlspecialchars($k['nip']) ?></td>
              <td class="border p-2 relative">
  <div class="flex items-center space-x-2 relative">
    <!-- Nama -->
    <span class="text-blue-600 font-semibold"><?= htmlspecialchars($k['nama']) ?></span>

    <!-- Tombol dropdown -->
    <button 
      onclick="toggleDropdown(<?= $k['id'] ?>)" 
      class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300 focus:outline-none"
    >
      <i class="fa fa-ellipsis-v"></i>
    </button>

    <!-- Dropdown -->
    <div id="dropdown-<?= $k['id'] ?>" 
         class="hidden absolute right-0 top-full mt-2 w-40 bg-white border rounded shadow-lg z-50">
      <a href="detail_karyawan.php?id=<?= $k['id'] ?>" class="block px-4 py-2 hover:bg-gray-100">
        <i class="fa fa-user"></i> Detail
      </a>
      <a href="payment_karyawan.php?id=<?= $k['id'] ?>" class="block px-4 py-2 hover:bg-gray-100">
        <i class="fa fa-money-bill"></i> Payment
      </a>
    </div>
  </div>
</td>


              <td class="border p-2"><?= htmlspecialchars($k['nama_departemen'] ?? '-') ?></td>
              <td class="border p-2"><?= htmlspecialchars($k['nama_divisi'] ?? '-') ?></td>
              <td class="border p-2"><?= htmlspecialchars($k['jabatan'] ?? '-') ?></td>
              <td class="border p-2"><?= ucfirst($k['status_pegawai']) ?></td>
              <td class="border p-2"><?= $k['tanggal_awal'] ?></td>
              <td class="border p-2"><?= $k['tanggal_akhir'] ?? '-' ?></td>
              <td class="border p-2"><?= $k['sisa_hari_spk'] ?></td>
              <td class="border p-2 text-center">
                <a href="edit_karyawan.php?id=<?= $k['id'] ?>" class="text-yellow-600"><i class="fa fa-edit"></i></a>
                <a href="karyawan_list.php?delete=<?= $k['id'] ?>" onclick="return confirm('Yakin hapus?')" class="text-red-600 ml-2"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="11" class="border p-4 text-center text-gray-500">Belum ada data karyawan.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
</div>
 <script>
function toggleDropdown(id) {
  // Tutup semua dropdown dulu
  document.querySelectorAll("[id^='dropdown-']").forEach(el => el.classList.add("hidden"));
  
  // Toggle dropdown yang diklik
  document.getElementById("dropdown-" + id).classList.toggle("hidden");
}

// Tutup dropdown kalau klik di luar
window.addEventListener("click", function(e) {
  document.querySelectorAll("[id^='dropdown-']").forEach(el => {
    if (!el.previousElementSibling.contains(e.target) && !el.contains(e.target)) {
      el.classList.add("hidden");
    }
  });
});
</script>

</body>
</html>
