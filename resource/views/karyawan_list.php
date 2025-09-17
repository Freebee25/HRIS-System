<?php 
include __DIR__ . "/../../database/db.php";
include __DIR__ . "/../../controllers/karyawanController.php";

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

  <!-- Tombol Tambah
  <a href="tambah_karyawan.php" 
     class="mb-4 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
    <i class="fa fa-plus"></i> Tambah Karyawan
  </a> -->

  <!-- List Data -->
  <div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Daftar Karyawan</h2>
    <table class="table-auto w-full border-collapse border border-gray-200">
      <thead>
        <tr class="bg-gray-100">
          <th class="border p-2">NIP</th>
          <th class="border p-2">Nama</th>
          <th class="border p-2">Status Pegawai</th>
          <th class="border p-2">Tanggal Awal</th>
          <th class="border p-2">Tanggal Akhir</th>
          <th class="border p-2">Sisa Hari</th>
          <th class="border p-2">Status</th>
          <th class="border p-2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($karyawanList as $k): ?>
          <tr>
            <td class="border p-2"><?= $k['nip'] ?></td>
            <td class="border p-2"><?= $k['nama'] ?></td>
            <td class="border p-2"><?= ucfirst($k['status_pegawai']) ?></td>
            <td class="border p-2"><?= $k['tanggal_awal'] ?></td>
            <td class="border p-2"><?= $k['tanggal_akhir'] ?></td>
            <td class="border p-2"><?= $k['sisa_hari_spk'] ?> hari</td>
            <td class="border p-2"><?= ucfirst($k['status']) ?></td>
            <td class="border p-2">
              <a href="edit_karyawan.php?id=<?= $k['id'] ?>" class="text-yellow-600"><i class="fa fa-edit"></i></a>
              <a href="karyawan_list.php?delete=<?= $k['id'] ?>" onclick="return confirm('Yakin hapus?')" class="text-red-600 ml-2"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>
