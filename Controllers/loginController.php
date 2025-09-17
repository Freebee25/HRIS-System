<?php
session_start();
include __DIR__ . '/../database/db.php'; // koneksi database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $user['password'] === md5($password)) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: ../resource/views/dashboard.php");
        exit;
    } else {
        header("Location: ../resource/views/login.php?error=Username atau password salah!");
        exit;
    }
} else {
    header("Location: ../resource/views/login.php");
    exit;
}
