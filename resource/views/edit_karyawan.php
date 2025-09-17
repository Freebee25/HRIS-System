<?php 
include 'db.php';
include 'karyawanController.php';

$controller = new KaryawanController($conn);

if (!isset($_GET['id'])) {
    header("Location: karyawan.php");
    exit;
}

$id = $_GET['id'];
$karyawan = $controller->getById($id);

// proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->update($id, $_POST, $_FILES);
    header("Location: karyawan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Karyawan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-800">

<?php include __DIR__ . '/../template/sidebar.php'; ?>
<div class="ml-64 p-6"> 

<div class="container mx-auto p-6">
  <h1 class="text-2xl font-bold mb-4">Edit Karyawan</h1>

  <form method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow mb-6">
    <div class="grid grid-cols-2 gap-4">
      <input type="text" name="nip" value="<?= $karyawan['nip'] ?>" required class="border p-2 rounded">
      <input type="text" name="nama" value="<?= $karyawan['nama'] ?>" required class="border p-2 rounded">
      
      <select name="status_pegawai" class="border p-2 rounded" required>
        <option value="tetap" <?= $karyawan['status_pegawai'] == 'tetap' ? 'selected' : '' ?>>Pegawai Tetap</option>
        <option value="kontrak" <?= $karyawan['status_pegawai'] == 'kontrak' ? 'selected' : '' ?>>Kontrak</option>
        <option value="probation" <?= $karyawan['status_pegawai'] == 'probation' ? 'selected' : '' ?>>Probation</option>
        <option value="freelance" <?= $karyawan['status_pegawai'] == 'freelance' ? 'selected' : '' ?>>Freelance</option>
      </select>

      <input type="date" name="tanggal_awal" value="<?= $karyawan['tanggal_awal'] ?>" class="border p-2 rounded" required>
      <input type="date" name="tanggal_akhir" value="<?= $karyawan['tanggal_akhir'] ?>" class="border p-2 rounded" required>

      <select name="status" class="border p-2 rounded" required>
        <option value="active" <?= $karyawan['status'] == 'active' ? 'selected' : '' ?>>Active</option>
        <option value="expiring soon" <?= $karyawan['status'] == 'expiring soon' ? 'selected' : '' ?>>Expiring Soon</option>
        <option value="expired" <?= $karyawan['status'] == 'expired' ? 'selected' : '' ?>>Expired</option>
      </select>

      <textarea name="note" class="border p-2 rounded col-span-2"><?= $karyawan['note'] ?></textarea>

      <label class="col-span-2">Upload Dokumen Baru (opsional, max 5)</label>
      <input type="file" name="files[]" multiple class="col-span-2 border p-2 rounded">
    </div>

    <button type="submit" class="mt-4 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
      <i class="fa fa-save"></i> Update
    </button>
    <a href="karyawan.php" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>
  </form>
</div>

</body>
</html>
