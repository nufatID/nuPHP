document.addEventListener("DOMContentLoaded", function () {
  const sidenav = document.getElementById("sidenav-main");
  const toggleBtn = document.getElementById("navbar-toggle-btn");
  const mainContent = document.querySelector(".main-content");

  // Cek apakah ada status terakhir yang tersimpan di localStorage
  const lastToggleStatus = localStorage.getItem("navbarToggleStatus");
  if (lastToggleStatus === "hide") {
    sidenav.classList.add("hide");
    mainContent.classList.add("full-width");
  }

  toggleBtn.addEventListener("click", function () {
    // Ubah status toggle navbar dan simpan ke localStorage
    if (sidenav.classList.contains("hide")) {
      sidenav.classList.remove("hide");
      mainContent.classList.remove("full-width");
      localStorage.setItem("navbarToggleStatus", "show");
    } else {
      sidenav.classList.add("hide");
      mainContent.classList.add("full-width");
      localStorage.setItem("navbarToggleStatus", "hide");
    }
  });
});
