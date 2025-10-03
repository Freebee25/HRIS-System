<?php
include __DIR__ . "/../../database/db.php";
include __DIR__ . "/../../controllers/KaryawanController.php";

$controller = new KaryawanController($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileId = $_POST['file_id'] ?? null;
    $karyawanId = $_POST['karyawan_id'] ?? null;

    if ($fileId && $karyawanId) {
        $controller->deleteFile($fileId);
    }

    // Kembali ke halaman edit karyawan
    header("Location: edit_karyawan.php?id=" . $karyawanId);
    exit;
}
