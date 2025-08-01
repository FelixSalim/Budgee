document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("sidebarToggle");
    const backdrop = document.getElementById("sidebarBackdrop");

    toggleBtn.addEventListener("click", function () {
        sidebar.classList.add("show");
        backdrop.style.display = "block";
    });

    backdrop.addEventListener("click", function () {
        sidebar.classList.remove("show");
        backdrop.style.display = "none";
    });
});
