<?php 
include __DIR__ . "/../../database/db.php";
include __DIR__ . "/../../controllers/KaryawanController.php";

$controller = new KaryawanController($conn);

// Ambil ID karyawan
$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: karyawan_list.php");
    exit;
}

// Ambil data karyawan
$karyawan = $controller->getById($id);
if (!$karyawan) {
    die("Data karyawan tidak ditemukan.");
}

$files = $controller->getFilesByKaryawan($id);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Karyawan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-800">

<?php include __DIR__ . '/../template/sidebar.php'; ?>
<div class="ml-64 p-6"> 

<div class="container mx-auto p-6">
  <h1 class="text-2xl font-bold mb-4">Detail Karyawan</h1>

  <div class="bg-white p-6 rounded shadow space-y-4">
    
    <!-- No SPK -->
    <div>
      <label class="block font-medium mb-1">No SPK:</label>
      <input type="text" value="<?= htmlspecialchars($karyawan['no_spk']) ?>" disabled class="w-full border p-2 rounded bg-gray-100">
    </div>

    <!-- NIP -->
    <div>
      <label class="block font-medium mb-1">NIP:</label>
      <input type="text" value="<?= htmlspecialchars($karyawan['nip']) ?>" disabled class="w-full border p-2 rounded bg-gray-100">
    </div>

    <!-- Nama -->
    <div>
      <label class="block font-medium mb-1">Nama Pegawai:</label>
      <input type="text" value="<?= htmlspecialchars($karyawan['nama']) ?>" disabled class="w-full border p-2 rounded bg-gray-100">
    </div>

    <!-- Jabatan -->
    <div>
      <label class="block font-medium mb-1">Jabatan:</label>
      <input type="text" value="<?= htmlspecialchars($karyawan['jabatan']) ?>" disabled class="w-full border p-2 rounded bg-gray-100">
    </div>

    <!-- Status Pegawai -->
    <div>
      <label class="block font-medium mb-1">Status Pegawai:</label>
      <input type="text" value="<?= htmlspecialchars($karyawan['status_pegawai']) ?>" disabled class="w-full border p-2 rounded bg-gray-100">
    </div>

    <!-- Departemen -->
    <div>
      <label class="block font-medium mb-1">Departemen:</label>
      <?php
        $stmt = $conn->prepare("SELECT nama_departemen FROM departemen WHERE id = ?");
        $stmt->execute([$karyawan['departemen_id']]);
        $dep = $stmt->fetch(PDO::FETCH_ASSOC);
      ?>
      <input type="text" value="<?= htmlspecialchars($dep['nama_departemen'] ?? '-') ?>" disabled class="w-full border p-2 rounded bg-gray-100">
    </div>

    <!-- Divisi -->
    <div>
      <label class="block font-medium mb-1">Divisi:</label>
      <?php
        $stmt = $conn->prepare("SELECT nama_divisi FROM divisi WHERE id = ?");
        $stmt->execute([$karyawan['divisi_id']]);
        $div = $stmt->fetch(PDO::FETCH_ASSOC);
      ?>
      <input type="text" value="<?= htmlspecialchars($div['nama_divisi'] ?? '-') ?>" disabled class="w-full border p-2 rounded bg-gray-100">
    </div>

    <!-- Tanggal Awal & Akhir Kontrak -->
    <div>
      <label class="block font-medium mb-1">Tanggal Awal Kontrak:</label>
      <input type="date" value="<?= $karyawan['tanggal_awal'] ?>" disabled class="w-full border p-2 rounded bg-gray-100">
    </div>
    <div>
      <label class="block font-medium mb-1">Tanggal Akhir Kontrak:</label>
      <input type="date" value="<?= $karyawan['tanggal_akhir'] ?>" disabled class="w-full border p-2 rounded bg-gray-100">
    </div>

    <!-- NIK -->
    <div>
      <label class="block font-medium mb-1">NIK:</label>
      <input type="text" value="<?= htmlspecialchars($karyawan['nik']) ?>" disabled class="w-full border p-2 rounded bg-gray-100">
    </div>

    <!-- Tempat & Tanggal Lahir -->
    <div>
      <label class="block font-medium mb-1">Tempat Lahir:</label>
      <input type="text" value="<?= htmlspecialchars($karyawan['tempat_lahir']) ?>" disabled class="w-full border p-2 rounded bg-gray-100">
    </div>
    <div>
      <label class="block font-medium mb-1">Tanggal Lahir:</label>
      <input type="date" value="<?= $karyawan['tanggal_lahir'] ?>" disabled class="w-full border p-2 rounded bg-gray-100">
    </div>

    <!-- Alamat -->
    <div>
      <label class="block font-medium mb-1">Alamat:</label>
      <textarea disabled rows="2" class="w-full border p-2 rounded bg-gray-100"><?= htmlspecialchars($karyawan['alamat']) ?></textarea>
    </div>

    <!-- Agama -->
    <div>
      <label class="block font-medium mb-1">Agama:</label>
      <input type="text" value="<?= htmlspecialchars($karyawan['agama']) ?>" disabled class="w-full border p-2 rounded bg-gray-100">
    </div>

    <!-- Status Pernikahan -->
    <div>
      <label class="block font-medium mb-1">Status Pernikahan:</label>
      <input type="text" value="<?= htmlspecialchars($karyawan['status_kawin']) ?>" disabled class="w-full border p-2 rounded bg-gray-100">
    </div>

    <!-- Kontak -->
    <div>
      <label class="block font-medium mb-1">Kontak:</label>
      <input type="text" value="<?= htmlspecialchars($karyawan['kontak']) ?>" disabled class="w-full border p-2 rounded bg-gray-100">
    </div>

    <!-- Kontak Darurat -->
    <div>
      <label class="block font-medium mb-1">Kontak Darurat:</label>
      <input type="text" value="<?= htmlspecialchars($karyawan['kontak_darurat']) ?>" disabled class="w-full border p-2 rounded bg-gray-100">
    </div>

    <!-- Email -->
    <div>
      <label class="block font-medium mb-1">Email:</label>
      <input type="email" value="<?= htmlspecialchars($karyawan['email']) ?>" disabled class="w-full border p-2 rounded bg-gray-100">
    </div>

    <!-- File yang sudah ada -->
    <div>
      <label class="block font-medium mb-2">File yang sudah diupload:</label>
      <ul class="space-y-2">
        <?php if (!empty($files)): ?>
          <?php foreach ($files as $f): ?>
            <li class="flex items-center justify-between bg-gray-100 p-2 rounded">
              <a href="../../uploads/<?= htmlspecialchars($f['file_path']) ?>" target="_blank" class="text-blue-600 underline">
                <?= htmlspecialchars($f['file_path']) ?>
              </a>
            </li>
          <?php endforeach; ?>
        <?php else: ?>
          <li class="text-gray-500">Belum ada file yang diupload</li>
        <?php endif; ?>
      </ul>
    </div>

    <!-- Catatan -->
    <div>
      <label class="block font-medium mb-1">Catatan:</label>
      <textarea disabled rows="3" class="w-full border p-2 rounded bg-gray-100"><?= htmlspecialchars($karyawan['note']) ?></textarea>
    </div>

    <!-- Tombol -->
    <div class="pt-4 flex gap-3">
      <a href="edit_karyawan.php?id=<?= $id ?>" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        <i class="fa fa-edit"></i> Update Data
      </a>
      <a href="karyawan_list.php" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
        <i class="fa fa-arrow-left"></i> Kembali
      </a>
    </div>
  </div>
</div>
</div>

</body>
</html>
