function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");
    const isOpen = sidebar.classList.contains("translate-x-0");
  
    if (isOpen) {
      sidebar.classList.remove("translate-x-0");
      sidebar.classList.add("-translate-x-full");
      overlay.classList.add("hidden");
    } else {
      sidebar.classList.remove("-translate-x-full");
      sidebar.classList.add("translate-x-0");
      overlay.classList.remove("hidden");
    }
  }