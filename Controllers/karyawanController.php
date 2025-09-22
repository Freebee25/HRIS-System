<?php
class KaryawanController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Ambil semua data karyawan dengan join departemen & divisi
    public function getAll() {
        $sql = "SELECT k.*, d.nama_departemen, v.nama_divisi 
                FROM karyawan k
                LEFT JOIN departemen d ON k.departemen_id = d.id
                LEFT JOIN divisi v ON k.divisi_id = v.id
                ORDER BY k.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Simpan data karyawan baru
    public function store($data, $files) {
        // Jika tanggal kosong, set null biar tidak error
        $tglAwal  = !empty($data['tanggal_awal']) ? new DateTime($data['tanggal_awal']) : null;
        $tglAkhir = !empty($data['tanggal_akhir']) ? new DateTime($data['tanggal_akhir']) : null;
        $today    = new DateTime();
        $sisaHari = $tglAkhir ? $today->diff($tglAkhir)->days : null;

        // Insert ke database (sesuai tabel karyawan)
        $sql = "INSERT INTO karyawan 
                (no_spk, nama, nip, departemen_id, divisi_id, jabatan, status_pegawai, 
                 tanggal_awal, tanggal_akhir, sisa_hari_spk, nik, tempat_lahir, tanggal_lahir, 
                 alamat, agama, status_kawin, kontak, kontak_darurat, email, note, created_at) 
                VALUES 
                (:no_spk, :nama, :nip, :departemen_id, :divisi_id, :jabatan, :status_pegawai,
                 :tanggal_awal, :tanggal_akhir, :sisa_hari_spk, :nik, :tempat_lahir, :tanggal_lahir,
                 :alamat, :agama, :status_kawin, :kontak, :kontak_darurat, :email, :note, NOW())";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':no_spk'          => $data['no_spk'] ?? null,
            ':nama'            => $data['nama'] ?? null,
            ':nip'             => $data['nip'] ?? null,
            ':departemen_id'   => $data['departemen_id'] ?? null,
            ':divisi_id'       => $data['divisi_id'] ?? null,
            ':jabatan'         => $data['jabatan'] ?? null,
            ':status_pegawai'  => $data['status_pegawai'] ?? null,
            ':tanggal_awal'    => $data['tanggal_awal'] ?? null,
            ':tanggal_akhir'   => $data['tanggal_akhir'] ?? null,
            ':sisa_hari_spk'   => $sisaHari,
            ':nik'             => $data['nik'] ?? null,
            ':tempat_lahir'    => $data['tempat_lahir'] ?? null,
            ':tanggal_lahir'   => $data['tanggal_lahir'] ?? null,
            ':alamat'          => $data['alamat'] ?? null,
            ':agama'           => $data['agama'] ?? null,
            ':status_kawin'    => $data['status_kawin'] ?? null,
            ':kontak'          => $data['kontak'] ?? null,
            ':kontak_darurat'  => $data['kontak_darurat'] ?? null,
            ':email'           => $data['email'] ?? null,
            ':note'            => $data['note'] ?? null
        ]);

        $karyawanId = $this->conn->lastInsertId();

        // Upload file (maks 10)
        if (!empty($files['files']['name'][0])) {
            $uploadDir = __DIR__ . "/../uploads/";
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileCount = count($files['files']['name']);
            $fileCount = min($fileCount, 10); // max 10

            for ($i = 0; $i < $fileCount; $i++) {
                $fileName = time() . "_" . basename($files['files']['name'][$i]);
                $targetFile = $uploadDir . $fileName;

                if (move_uploaded_file($files['files']['tmp_name'][$i], $targetFile)) {
                    $sqlFile = "INSERT INTO karyawan_files (karyawan_id, file_path, uploaded_at) 
                                VALUES (:karyawan_id, :file_path, NOW())";
                    $stmtFile = $this->conn->prepare($sqlFile);
                    $stmtFile->execute([
                        ':karyawan_id' => $karyawanId,
                        ':file_path'   => $fileName
                    ]);
                }
            }
        }

        return true;
    }

    // Hapus karyawan + file
    public function delete($id) {
        $stmt = $this->conn->prepare("SELECT file_path FROM karyawan_files WHERE karyawan_id = :id");
        $stmt->execute([':id' => $id]);
        $files = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($files as $f) {
            $filePath = __DIR__ . "/../uploads/" . $f['file_path'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $this->conn->prepare("DELETE FROM karyawan_files WHERE karyawan_id = :id")->execute([':id' => $id]);
        $this->conn->prepare("DELETE FROM karyawan WHERE id = :id")->execute([':id' => $id]);

        return true;
    }

    // Ambil data by ID
    public function getById($id) {
        $sql = "SELECT * FROM karyawan WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update data karyawan
    public function update($id, $data) {
        $tglAwal  = !empty($data['tanggal_awal']) ? new DateTime($data['tanggal_awal']) : null;
        $tglAkhir = !empty($data['tanggal_akhir']) ? new DateTime($data['tanggal_akhir']) : null;
        $today    = new DateTime();
        $sisaHari = $tglAkhir ? $today->diff($tglAkhir)->days : null;

        $sql = "UPDATE karyawan SET 
                    no_spk = :no_spk,
                    nama = :nama,
                    nip = :nip,
                    departemen_id = :departemen_id,
                    divisi_id = :divisi_id,
                    jabatan = :jabatan,
                    status_pegawai = :status_pegawai,
                    tanggal_awal = :tanggal_awal,
                    tanggal_akhir = :tanggal_akhir,
                    sisa_hari_spk = :sisa_hari_spk,
                    nik = :nik,
                    tempat_lahir = :tempat_lahir,
                    tanggal_lahir = :tanggal_lahir,
                    alamat = :alamat,
                    agama = :agama,
                    status_kawin = :status_kawin,
                    kontak = :kontak,
                    kontak_darurat = :kontak_darurat,
                    email = :email,
                    note = :note
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':no_spk'          => $data['no_spk'] ?? null,
            ':nama'            => $data['nama'] ?? null,
            ':nip'             => $data['nip'] ?? null,
            ':departemen_id'   => $data['departemen_id'] ?? null,
            ':divisi_id'       => $data['divisi_id'] ?? null,
            ':jabatan'         => $data['jabatan'] ?? null,
            ':status_pegawai'  => $data['status_pegawai'] ?? null,
            ':tanggal_awal'    => $data['tanggal_awal'] ?? null,
            ':tanggal_akhir'   => $data['tanggal_akhir'] ?? null,
            ':sisa_hari_spk'   => $sisaHari,
            ':nik'             => $data['nik'] ?? null,
            ':tempat_lahir'    => $data['tempat_lahir'] ?? null,
            ':tanggal_lahir'   => $data['tanggal_lahir'] ?? null,
            ':alamat'          => $data['alamat'] ?? null,
            ':agama'           => $data['agama'] ?? null,
            ':status_kawin'    => $data['status_kawin'] ?? null,
            ':kontak'          => $data['kontak'] ?? null,
            ':kontak_darurat'  => $data['kontak_darurat'] ?? null,
            ':email'           => $data['email'] ?? null,
            ':note'            => $data['note'] ?? null,
            ':id'              => $id
        ]);

        return true;
    }
}
