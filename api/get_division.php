<?php
include __DIR__ . "/../database/db.php";

if (isset($_GET['departemen_id'])) {
    $departemen_id = (int) $_GET['departemen_id'];

    $stmt = $conn->prepare("SELECT id, nama_divisi FROM divisi WHERE departemen_id = ?");
    $stmt->execute([$departemen_id]);

    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}
?>
