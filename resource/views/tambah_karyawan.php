<?php 
include __DIR__ . "/../../database/db.php";
include __DIR__ . "/../../controllers/KaryawanController.php";

$controller = new KaryawanController($conn);

// proses tambah data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store($_POST, $_FILES);
    header("Location: karyawan_list.php");
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

  <form method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow space-y-4">
    
    <!-- No SPK -->
    <div>
      <label class="block font-medium mb-1">No SPK:</label>
      <input type="text" name="no_spk" class="w-full border p-2 rounded">
    </div>

    <!-- NIP -->
    <div>
      <label class="block font-medium mb-1">NIP:</label>
      <input type="text" name="nip" required class="w-full border p-2 rounded">
    </div>

    <!-- Nama -->
    <div>
      <label class="block font-medium mb-1">Nama Pegawai:</label>
      <input type="text" name="nama" required class="w-full border p-2 rounded">
    </div>

    <!-- Jabatan -->
    <div>
      <label class="block font-medium mb-1">Jabatan:</label>
      <select name="jabatan" required class="w-full border p-2 rounded">
        <option value="">-- Pilih Jabatan --</option>
        <option value="Direksi">Direksi</option>
        <option value="Team Leader">Team Leader</option>
        <option value="Senior Staff">Senior Staff</option>
        <option value="Staff">Staff</option>
        <option value="Junior Staff">Junior Staff</option>
      </select>
    </div>

    <!-- Status Pegawai -->
    <div>
      <label class="block font-medium mb-1">Status Pegawai:</label>
      <select name="status_pegawai" required class="w-full border p-2 rounded">
        <option value="">-- Pilih Status Pegawai --</option>
        <option value="Tetap">Pegawai Tetap</option>
        <option value="Kontrak">Kontrak</option>
        <option value="Probation">Probation</option>
        <option value="Freelance">Freelance</option>
        <option value="Resign">Resign</option>
      </select>
    </div>

    <!-- Departemen -->
    <div>
      <label class="block font-medium mb-1">Departemen:</label>
      <select name="departemen_id" id="department" required class="w-full border p-2 rounded">
        <option value="">-- Pilih Departemen --</option>
        <?php
          $stmt = $conn->query("SELECT id, nama_departemen FROM departemen ORDER BY nama_departemen ASC");
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo "<option value='{$row['id']}'>{$row['nama_departemen']}</option>";
          }
        ?>
      </select>
    </div>

    <!-- Divisi -->
    <div>
      <label class="block font-medium mb-1">Divisi:</label>
      <select name="divisi_id" id="divisi" class="w-full border p-2 rounded">
        <option value="">-- Pilih Divisi --</option>
      </select>
    </div>

    <!-- Tanggal Awal -->
    <div>
      <label class="block font-medium mb-1">Tanggal Awal Kontrak:</label>
      <input type="date" name="tanggal_awal" class="w-full border p-2 rounded">
    </div>

    <!-- Tanggal Akhir -->
    <div>
      <label class="block font-medium mb-1">Tanggal Akhir Kontrak:</label>
      <input type="date" name="tanggal_akhir" class="w-full border p-2 rounded">
    </div>

    <!-- NIK -->
    <div>
      <label class="block font-medium mb-1">NIK:</label>
      <input type="text" name="nik" class="w-full border p-2 rounded">
    </div>

    <!-- Tempat Lahir -->
    <div>
      <label class="block font-medium mb-1">Tempat Lahir:</label>
      <input type="text" name="tempat_lahir" class="w-full border p-2 rounded">
    </div>

    <!-- Tanggal Lahir -->
    <div>
      <label class="block font-medium mb-1">Tanggal Lahir:</label>
      <input type="date" name="tanggal_lahir" class="w-full border p-2 rounded">
    </div>

    <!-- Alamat -->
    <div>
      <label class="block font-medium mb-1">Alamat:</label>
      <textarea name="alamat" rows="2" class="w-full border p-2 rounded"></textarea>
    </div>

    <!-- Agama -->
    <div>
      <label class="block font-medium mb-1">Agama:</label>
      <select name="agama" class="w-full border p-2 rounded">
        <option value="">-- Pilih Agama --</option>
        <option>Islam</option>
        <option>Kristen</option>
        <option>Katolik</option>
        <option>Hindu</option>
        <option>Budha</option>
        <option>Konghuchu</option>
        <option>Lainnya</option>
      </select>
    </div>

    <!-- Status Pernikahan -->
    <div>
      <label class="block font-medium mb-1">Status Pernikahan:</label>
      <select name="status_kawin" class="w-full border p-2 rounded">
        <option value="">-- Pilih Status --</option>
        <option value="Menikah">Menikah</option>
        <option value="Belum Menikah">Belum Menikah</option>
      </select>
    </div>

    <!-- Kontak -->
    <div>
      <label class="block font-medium mb-1">Kontak:</label>
      <input type="text" name="kontak" class="w-full border p-2 rounded">
    </div>

    <!-- Kontak Darurat -->
    <div>
      <label class="block font-medium mb-1">Kontak Darurat:</label>
      <input type="text" name="kontak_darurat" class="w-full border p-2 rounded">
    </div>

    <!-- Email -->
    <div>
      <label class="block font-medium mb-1">Email:</label>
      <input type="email" name="email" class="w-full border p-2 rounded">
    </div>

    <!-- Upload File -->
    <div>
      <label class="block font-medium mb-1">Upload Dokumen :</label>
      <input type="file" name="files[]" multiple accept=".pdf,.jpg,.png" class="w-full border p-2 rounded">
    </div>

    <!-- Catatan -->
    <div>
      <label class="block font-medium mb-1">Catatan:</label>
      <textarea name="note" rows="3" class="w-full border p-2 rounded"></textarea>
    </div>

    <!-- Tombol -->
    <div class="pt-2">
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        <i class="fa fa-save"></i> Simpan
      </button>
      <a href="karyawan_list.php" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </div>
  </form>
</div>
</div>

<script>
document.getElementById('department').addEventListener('change', function() {
    let departmentId = this.value;
    let divisiSelect = document.getElementById('divisi');
    divisiSelect.innerHTML = "<option value=''>Loading...</option>";

    if (departmentId) {
        fetch("../../api/get_division.php?departemen_id=" + departmentId)
            .then(res => res.json())
            .then(data => {
                divisiSelect.innerHTML = "<option value=''>-- Pilih Divisi --</option>";
                data.forEach(d => {
                    divisiSelect.innerHTML += `<option value="${d.id}">${d.nama_divisi}</option>`;
                });
            });
    } else {
        divisiSelect.innerHTML = "<option value=''>-- Pilih Divisi --</option>";
    }
});
</script>

</body>
</html>
