<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>HRIS - Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .bar { height: 12px; border-radius: 999px; }
  </style>
</head>
<body class="bg-slate-50 text-slate-800">

<div class="flex min-h-screen">
  <!-- Sidebar -->
  <?php include __DIR__ . '/../template/sidebar.php'; ?>

  <!-- Overlay for mobile -->
  <div id="overlay" class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 md:hidden" onclick="toggleSidebar()"></div>

  <!-- Main -->
  <main class="flex-1 p-6 w-full md:ml-72">
    <!-- Topbar -->
    <div class="flex justify-between items-center mb-6">
      <div class="flex items-center gap-3">
        <!-- Hamburger btn (mobile only) -->
        <button onclick="toggleSidebar()" class="md:hidden text-slate-600 hover:text-slate-800">☰</button>
        <h1 class="text-2xl font-semibold">Halo, <?= $_SESSION['username'] ?> 👋</h1>
      </div>
      <a href="logout.php" class="rounded-lg border px-3 py-2 text-sm">Logout</a>
    </div>

    <!-- KPI CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-6">
      <div class="bg-white p-4 rounded-xl shadow-sm">
        <div class="text-xs md:text-sm text-slate-500">Karyawan Aktif</div>
        <div class="mt-2 text-xl md:text-2xl font-semibold">128</div>
        <div class="mt-3 text-xs text-slate-400">Bertambah 3 dibanding kemarin</div>
      </div>

      <div class="bg-white p-4 rounded-xl shadow-sm">
        <div class="text-xs md:text-sm text-slate-500">Pengajuan Cuti</div>
        <div class="mt-2 text-xl md:text-2xl font-semibold">7</div>
        <div class="mt-3 text-xs text-slate-400">3 menunggu approval</div>
      </div>

      <div class="bg-white p-4 rounded-xl shadow-sm">
        <div class="text-xs md:text-sm text-slate-500">Payroll Bulan Ini</div>
        <div class="mt-2 text-xl md:text-2xl font-semibold">Rp 120.000.000</div>
        <div class="mt-3 text-xs text-slate-400">Dalam proses</div>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
      <!-- Attendance chart placeholder -->
      <div class="lg:col-span-2 bg-white p-4 rounded-xl shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
          <div>
            <h3 class="font-semibold">Rekap Kehadiran Mingguan</h3>
            <p class="text-xs md:text-sm text-slate-500">Sen - Ming</p>
          </div>
          <div class="text-xs md:text-sm text-slate-500 mt-2 sm:mt-0">Total hadir: <span class="font-medium">780</span></div>
        </div>

        <div class="mt-4 space-y-3 text-xs md:text-sm">
          <div class="flex items-center justify-between gap-2">
            <div class="w-20">Senin</div>
            <div class="flex-1">
              <div class="bg-slate-100 rounded-full overflow-hidden">
                <div class="bar bg-indigo-400" style="width:82%"></div>
              </div>
            </div>
            <div class="w-12 text-right text-slate-600">120</div>
          </div>

          <div class="flex items-center justify-between gap-2">
            <div class="w-20">Selasa</div>
            <div class="flex-1">
              <div class="bg-slate-100 rounded-full overflow-hidden">
                <div class="bar bg-indigo-400" style="width:88%"></div>
              </div>
            </div>
            <div class="w-12 text-right text-slate-600">130</div>
          </div>

          <div class="flex items-center justify-between gap-2">
            <div class="w-20">Rabu</div>
            <div class="flex-1">
              <div class="bg-slate-100 rounded-full overflow-hidden">
                <div class="bar bg-indigo-400" style="width:90%"></div>
              </div>
            </div>
            <div class="w-12 text-right text-slate-600">135</div>
          </div>
        </div>
      </div>

      <!-- Employee table preview -->
      <div class="bg-white p-4 rounded-xl shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
          <h3 class="font-semibold text-sm md:text-base">Daftar Karyawan (Preview)</h3>
          <div class="text-xs md:text-sm text-slate-500 mt-1 sm:mt-0">Total: 128</div>
        </div>
        
        <div class="overflow-x-auto">
          <table class="w-full text-xs md:text-sm">
            <thead class="text-slate-500 text-left border-b">
              <tr>
                <th class="py-2">ID</th>
                <th class="py-2">Nama</th>
                <th class="py-2">Departemen</th>
                <th class="py-2">Posisi</th>
                <th class="py-2">Status</th>
              </tr>
            </thead>
            <tbody class="divide-y">
              <tr>
                <td class="py-2">00123</td>
                <td class="py-2 font-medium">Karyawan 1</td>
                <td class="py-2">Operasional</td>
                <td class="py-2">Staff</td>
                <td class="py-2 text-green-600">Aktif</td>
              </tr>
              <tr>
                <td class="py-2">00145</td>
                <td class="py-2 font-medium">Karyawan 2</td>
                <td class="py-2">HR</td>
                <td class="py-2">HR Officer</td>
                <td class="py-2 text-green-600">Aktif</td>
              </tr>
              <tr>
                <td class="py-2">00178</td>
                <td class="py-2 font-medium">Karyawan 3</td>
                <td class="py-2">Keuangan</td>
                <td class="py-2">Accountant</td>
                <td class="py-2 text-yellow-600">Cuti</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="mt-4 text-right">
          <button class="rounded-lg border px-3 py-2 text-xs md:text-sm">Lihat semua</button>
        </div>
      </div>
    </div>

    <!-- Reminder Section -->
    <div class="bg-white p-4 rounded-xl shadow-sm mb-6">
      <h3 class="font-semibold mb-3">📌 Reminder</h3>
      <ul class="space-y-2 text-sm">
        <li class="p-2 border rounded-lg hover:bg-slate-50">
          🎂 Ulang tahun <span class="font-medium">Karyawan 2</span> hari ini
        </li>
        <li class="p-2 border rounded-lg hover:bg-slate-50">
          📝 Deadline Payroll tanggal <span class="font-medium">25 Sept</span>
        </li>
        <li class="p-2 border rounded-lg hover:bg-slate-50">
          📅 Rapat Manajemen besok jam <span class="font-medium">10:00</span>
        </li>
      </ul>
    </div>

  </main>
</div>

<script src="js/script.js"></script>
</body>
</html>
