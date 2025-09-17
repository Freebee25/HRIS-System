<?php
class KaryawanController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Ambil semua data karyawan
    public function getAll() {
        $sql = "SELECT * FROM karyawan ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Simpan data karyawan baru
    public function store($data, $files) {
        // Hitung sisa hari kontrak
        $tglAwal  = new DateTime($data['tgl_awal_kontrak']);
        $tglAkhir = new DateTime($data['tgl_akhir_kontrak']);
        $today    = new DateTime();
        $sisaHari = $today->diff($tglAkhir)->days;

        // Insert ke database
        $sql = "INSERT INTO karyawan 
                (nip, nama, status_pegawai, tgl_awal_kontrak, tgl_akhir_kontrak, sisa_hari_spk, status, note, created_at) 
                VALUES 
                (:nip, :nama, :status_pegawai, :tgl_awal_kontrak, :tgl_akhir_kontrak, :sisa_hari_spk, :status, :note, NOW())";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':nip'              => $data['nip'],
            ':nama'             => $data['nama'],
            ':status_pegawai'   => $data['status_pegawai'],
            ':tgl_awal_kontrak' => $data['tgl_awal_kontrak'],
            ':tgl_akhir_kontrak'=> $data['tgl_akhir_kontrak'],
            ':sisa_hari_spk'    => $sisaHari,
            ':status'           => $data['status'],
            ':note'             => $data['note'] ?? null
        ]);

        return true;
    }

    // Hapus karyawan
    public function delete($id) {
        $sql = "DELETE FROM karyawan WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return true;
    }

    // Ambil data by ID (untuk edit)
    public function getById($id) {
        $sql = "SELECT * FROM karyawan WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update data karyawan
    public function update($id, $data) {
        $tglAwal  = new DateTime($data['tgl_awal_kontrak']);
        $tglAkhir = new DateTime($data['tgl_akhir_kontrak']);
        $today    = new DateTime();
        $sisaHari = $today->diff($tglAkhir)->days;

        $sql = "UPDATE karyawan SET 
                    nip = :nip,
                    nama = :nama,
                    status_pegawai = :status_pegawai,
                    tgl_awal_kontrak = :tgl_awal_kontrak,
                    tgl_akhir_kontrak = :tgl_akhir_kontrak,
                    sisa_hari_spk = :sisa_hari_spk,
                    status = :status,
                    note = :note
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':nip'              => $data['nip'],
            ':nama'             => $data['nama'],
            ':status_pegawai'   => $data['status_pegawai'],
            ':tgl_awal_kontrak' => $data['tgl_awal_kontrak'],
            ':tgl_akhir_kontrak'=> $data['tgl_akhir_kontrak'],
            ':sisa_hari_spk'    => $sisaHari,
            ':status'           => $data['status'],
            ':note'             => $data['note'] ?? null,
            ':id'               => $id
        ]);

        return true;
    }
}
