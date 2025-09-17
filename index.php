<?php
session_start();
if (isset($_SESSION['username'])) {
    // Kalau sudah login → langsung dashboard
    header("Location: resource/views/dashboard.php");
    exit;
} else {
    // Kalau belum login → ke login
    header("Location: resource/views/login.php");
    exit;
}
