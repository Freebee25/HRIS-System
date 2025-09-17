<?php
// Pastikan user sudah login
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../views/login.php");
    exit;
}
$username = $_SESSION['username'];
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<aside id="sidebar"
       class="fixed inset-y-0 left-0 w-72 bg-white border-r transform -translate-x-full 
              md:translate-x-0 transition-transform duration-200 ease-in-out z-40">
  <!-- Header Sidebar -->
  <div class="p-6 border-b flex justify-between items-center">
    <h3 class="text-xl font-semibold text-blue-700"><i class="fa-solid fa-users"></i> HRIS</h3>
    <!-- Tombol close (hanya mobile) -->
    <button onclick="toggleSidebar()" class="md:hidden text-slate-500 hover:text-slate-700">✖</button>
  </div>

  <!-- Menu -->
  <nav class="p-4 space-y-1 text-base">
    <a href="../views/dashboard.php" class="block p-2 rounded-lg hover:bg-slate-100">
      <i class="fa-solid fa-chart-line mr-2 text-blue-600"></i> Dashboard
    </a>
    <!-- Dropdown Data Karyawan -->
  <div x-data="{ open: false }" class="space-y-1">
    <button onclick="toggleDropdown('karyawanDropdown')" 
            class="flex justify-between items-center w-full p-2 rounded-lg hover:bg-slate-100">
      <span><i class="fa-solid fa-user mr-2 text-blue-600"></i> Data Karyawan</span>
      <i class="fa-solid fa-chevron-down text-sm"></i>
    </button>
    <div id="karyawanDropdown" class="hidden ml-6 space-y-1">
      <a href="../views/tambah_karyawan.php" class="block p-2 rounded-lg hover:bg-slate-100">
        <i class="fa-solid fa-user-plus mr-2 text-green-600"></i> Tambah Karyawan
      </a>
      <a href="../views/karyawan_list.php" class="block p-2 rounded-lg hover:bg-slate-100">
        <i class="fa-solid fa-list mr-2 text-blue-600"></i> Data Karyawan
      </a>
    </div>
</div>

    <a href="#" class="block p-2 rounded-lg hover:bg-slate-100">
      <i class="fa-solid fa-money-check-dollar mr-2 text-blue-600"></i> Payroll
    </a>
    <a href="#" class="block p-2 rounded-lg hover:bg-slate-100">
      <i class="fa-solid fa-gear mr-2 text-blue-600"></i> Pengaturan
    </a>
  </nav>

  <!-- Info User -->
  <div class="p-4 border-t text-sm">
    <div>Login sebagai</div>
    <div class="font-medium"><?= htmlspecialchars($username) ?></div>
    <div class="text-slate-500">admin@perusahaan.com</div>
  </div>
</aside>

<!-- Overlay untuk mobile -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 md:hidden" onclick="toggleSidebar()"></div>

<script>
  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
  }
  function toggleDropdown(id) {
    const el = document.getElementById(id);
    el.classList.toggle('hidden');
  }
</script>
