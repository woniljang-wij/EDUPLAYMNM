// ===== TOAST =====

if (window.toastData && window.toastData.message && window.toastData.type) {
  showToast(window.toastData.message, window.toastData.type);
}

// ===== DELETE POPUP =====

const popup = document.getElementById("deletePopup");

const confirmDeleteBtn = document.getElementById("confirmDelete");

const cancelDeleteBtn = document.getElementById("cancelDelete");

let deleteUrl = "";

if (popup && confirmDeleteBtn && cancelDeleteBtn) {
  document.querySelectorAll(".delete").forEach((button) => {
    button.addEventListener("click", function (e) {
      e.preventDefault();

      deleteUrl = this.dataset.url;

      popup.classList.add("active");
    });
  });

  cancelDeleteBtn.addEventListener("click", () => {
    popup.classList.remove("active");
  });

  confirmDeleteBtn.addEventListener("click", () => {
    if (deleteUrl) {
      window.location.href = deleteUrl;
    }
  });

  popup.addEventListener("click", function (e) {
    if (e.target === popup) {
      popup.classList.remove("active");
    }
  });

  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && popup.classList.contains("active")) {
      popup.classList.remove("active");
    }
  });
}

// ===== BACKGROUND MUSIC =====

const bgMusic = document.getElementById("bgMusic");

if (bgMusic) {
  bgMusic.volume = 0.25;

  document.addEventListener(
    "click",
    () => {
      bgMusic.play().catch(() => {});
    },
    { once: true },
  );
}

// ===== LOGOUT POPUP =====

const logoutBtn = document.getElementById("logoutBtn");

const logoutPopup = document.getElementById("logoutPopup");

const cancelLogout = document.getElementById("cancelLogout");

if (logoutBtn && logoutPopup && cancelLogout) {
  logoutBtn.addEventListener("click", function (e) {
    e.preventDefault();

    logoutPopup.classList.add("show");
  });

  cancelLogout.addEventListener("click", function () {
    logoutPopup.classList.remove("show");
  });

  logoutPopup.addEventListener("click", function (e) {
    if (e.target === logoutPopup) {
      logoutPopup.classList.remove("show");
    }
  });

  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && logoutPopup.classList.contains("show")) {
      logoutPopup.classList.remove("show");
    }
  });
}
