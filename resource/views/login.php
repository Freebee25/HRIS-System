<?php
session_start();
if (isset($_SESSION['username'])) {
    // Kalau sudah login, jangan bisa balik ke login
    header("Location: dashboard.php");
    exit;
}

$error = isset($_GET['error']) ? $_GET['error'] : "";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login HRIS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
  <div class="bg-white shadow-lg rounded-lg p-8 w-96">
    <h2 class="text-2xl font-bold text-center mb-6 text-blue-700">
      <i class="fa-solid fa-users"></i> HRIS Login
    </h2>
    <?php if ($error): ?>
      <p class="bg-red-100 text-red-600 p-2 rounded mb-4 text-sm"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST" action="../../controllers/loginController.php">
      <div class="mb-4">
        <label class="block text-gray-600 mb-1">Username</label>
        <input type="text" name="username" required
               class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      <div class="mb-4">
        <label class="block text-gray-600 mb-1">Password</label>
        <input type="password" name="password" required
               class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      <button type="submit"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded">
        <i class="fa-solid fa-right-to-bracket"></i> Login
      </button>
    </form>
  </div>
</body>
</html>
