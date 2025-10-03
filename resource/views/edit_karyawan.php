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

// Ambil file lama
$files = $controller->getFilesByKaryawan($id);

// Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->update($id, $_POST, $_FILES);
    header("Location: detail_karyawan.php?id=" . $id);
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

  <!-- Form utama update -->
  <form method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow space-y-4">
    
    <!-- No SPK -->
    <div>
      <label class="block font-medium mb-1">No SPK:</label>
      <input type="text" name="no_spk" value="<?= htmlspecialchars($karyawan['no_spk']) ?>" class="w-full border p-2 rounded">
    </div>

    <!-- NIP -->
    <div>
      <label class="block font-medium mb-1">NIP:</label>
      <input type="text" name="nip" value="<?= htmlspecialchars($karyawan['nip']) ?>" required class="w-full border p-2 rounded">
    </div>

    <!-- Nama -->
    <div>
      <label class="block font-medium mb-1">Nama Pegawai:</label>
      <input type="text" name="nama" value="<?= htmlspecialchars($karyawan['nama']) ?>" required class="w-full border p-2 rounded">
    </div>

    <!-- Jabatan -->
    <div>
      <label class="block font-medium mb-1">Jabatan:</label>
      <select name="jabatan" required class="w-full border p-2 rounded">
        <option value="">-- Pilih Jabatan --</option>
        <?php
          $jabatanList = ["Direksi", "Team Leader", "Senior Staff", "Staff", "Junior Staff"];
          foreach ($jabatanList as $j) {
              $selected = ($karyawan['jabatan'] == $j) ? "selected" : "";
              echo "<option value='$j' $selected>$j</option>";
          }
        ?>
      </select>
    </div>

    <!-- Status Pegawai -->
    <div>
      <label class="block font-medium mb-1">Status Pegawai:</label>
      <select name="status_pegawai" required class="w-full border p-2 rounded">
        <option value="">-- Pilih Status Pegawai --</option>
        <?php
          $statusList = ["Tetap" => "Pegawai Tetap", "Kontrak" => "Kontrak", "Probation" => "Probation", "Freelance" => "Freelance", "Resign" => "Resign"];
          foreach ($statusList as $val => $label) {
              $selected = ($karyawan['status_pegawai'] == $val) ? "selected" : "";
              echo "<option value='$val' $selected>$label</option>";
          }
        ?>
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
              $selected = ($karyawan['departemen_id'] == $row['id']) ? "selected" : "";
              echo "<option value='{$row['id']}' $selected>{$row['nama_departemen']}</option>";
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
      <input type="date" name="tanggal_awal" value="<?= $karyawan['tanggal_awal'] ?>" class="w-full border p-2 rounded">
    </div>

    <!-- Tanggal Akhir -->
    <div>
      <label class="block font-medium mb-1">Tanggal Akhir Kontrak:</label>
      <input type="date" name="tanggal_akhir" value="<?= $karyawan['tanggal_akhir'] ?>" class="w-full border p-2 rounded">
    </div>

    <!-- NIK -->
    <div>
      <label class="block font-medium mb-1">NIK:</label>
      <input type="text" name="nik" value="<?= htmlspecialchars($karyawan['nik']) ?>" class="w-full border p-2 rounded">
    </div>

    <!-- Tempat Lahir -->
    <div>
      <label class="block font-medium mb-1">Tempat Lahir:</label>
      <input type="text" name="tempat_lahir" value="<?= htmlspecialchars($karyawan['tempat_lahir']) ?>" class="w-full border p-2 rounded">
    </div>

    <!-- Tanggal Lahir -->
    <div>
      <label class="block font-medium mb-1">Tanggal Lahir:</label>
      <input type="date" name="tanggal_lahir" value="<?= $karyawan['tanggal_lahir'] ?>" class="w-full border p-2 rounded">
    </div>

    <!-- Alamat -->
    <div>
      <label class="block font-medium mb-1">Alamat:</label>
      <textarea name="alamat" rows="2" class="w-full border p-2 rounded"><?= htmlspecialchars($karyawan['alamat']) ?></textarea>
    </div>

    <!-- Agama -->
    <div>
      <label class="block font-medium mb-1">Agama:</label>
      <select name="agama" class="w-full border p-2 rounded">
        <option value="">-- Pilih Agama --</option>
        <?php
          $agamaList = ["Islam", "Kristen", "Katolik", "Hindu", "Budha", "Konghuchu", "Lainnya"];
          foreach ($agamaList as $a) {
              $selected = ($karyawan['agama'] == $a) ? "selected" : "";
              echo "<option value='$a' $selected>$a</option>";
          }
        ?>
      </select>
    </div>

    <!-- Status Pernikahan -->
    <div>
      <label class="block font-medium mb-1">Status Pernikahan:</label>
      <select name="status_kawin" class="w-full border p-2 rounded">
        <option value="">-- Pilih Status --</option>
        <option value="Menikah" <?= ($karyawan['status_kawin'] == "Menikah") ? "selected" : "" ?>>Menikah</option>
        <option value="Belum Menikah" <?= ($karyawan['status_kawin'] == "Belum Menikah") ? "selected" : "" ?>>Belum Menikah</option>
      </select>
    </div>

    <!-- Kontak -->
    <div>
      <label class="block font-medium mb-1">Kontak:</label>
      <input type="text" name="kontak" value="<?= htmlspecialchars($karyawan['kontak']) ?>" class="w-full border p-2 rounded">
    </div>

    <!-- Kontak Darurat -->
    <div>
      <label class="block font-medium mb-1">Kontak Darurat:</label>
      <input type="text" name="kontak_darurat" value="<?= htmlspecialchars($karyawan['kontak_darurat']) ?>" class="w-full border p-2 rounded">
    </div>

    <!-- Email -->
    <div>
      <label class="block font-medium mb-1">Email:</label>
      <input type="email" name="email" value="<?= htmlspecialchars($karyawan['email']) ?>" class="w-full border p-2 rounded">
    </div>

    <!-- Upload File Baru -->
    <div>
      <label class="block font-medium mb-1">Upload Dokumen Baru (Opsional):</label>
      <input type="file" name="files[]" multiple accept=".pdf,.jpg,.png" class="w-full border p-2 rounded">
      <p class="text-sm text-gray-500">File baru akan ditambahkan, file lama tetap tersimpan.</p>
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
              <button type="button" onclick="hapusFile(<?= $f['id'] ?>, <?= $id ?>)" class="text-red-600 hover:text-red-800">
                <i class="fa fa-trash"></i> Hapus
              </button>
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
      <textarea name="note" rows="3" class="w-full border p-2 rounded"><?= htmlspecialchars($karyawan['note']) ?></textarea>
    </div>

    <!-- Tombol -->
    <div class="pt-2 flex gap-3">
      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        <i class="fa fa-save"></i> Update
      </button>
      <a href="karyawan_list.php" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
        <i class="fa fa-arrow-left"></i> Batal
      </a>
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
                    let selected = (d.id == "<?= $karyawan['divisi_id'] ?>") ? "selected" : "";
                    divisiSelect.innerHTML += `<option value="${d.id}" ${selected}>${d.nama_divisi}</option>`;
                });
            });
    } else {
        divisiSelect.innerHTML = "<option value=''>-- Pilih Divisi --</option>";
    }
});

// load divisi saat pertama kali
window.addEventListener("load", function() {
    document.getElementById('department').dispatchEvent(new Event('change'));
});

// fungsi hapus file
function hapusFile(fileId, karyawanId) {
    if (confirm("Yakin ingin menghapus file ini?")) {
        let form = document.createElement("form");
        form.method = "POST";
        form.action = "delete_file.php";

        let inputFile = document.createElement("input");
        inputFile.type = "hidden";
        inputFile.name = "file_id";
        inputFile.value = fileId;
        form.appendChild(inputFile);

        let inputKar = document.createElement("input");
        inputKar.type = "hidden";
        inputKar.name = "karyawan_id";
        inputKar.value = karyawanId;
        form.appendChild(inputKar);

        document.body.appendChild(form);
        form.submit();
    }
}
</script>

</body>
</html>
