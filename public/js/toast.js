// ===== STATE =====
let currentToast = null;

let toastTimer = null;

let undoCallback = null;

// ===== MAIN TOAST =====
function showToast(message, type = "success", duration = 2500) {
  const container =
    document.getElementById("toast-container") || createContainer();

  if (currentToast) {
    clearTimeout(toastTimer);

    removeToast(currentToast);
  }

  const toast = document.createElement("div");

  toast.className = `toast toast-${type}`;

  toast.innerHTML = `
        <div class="toast-message">
            ${message}
        </div>

        <div class="toast-close">
            &times;
        </div>
    `;

  container.appendChild(toast);

  currentToast = toast;

  createFirework(toast, type);

  toastTimer = setTimeout(() => {
    removeToast(toast);
  }, duration);

  toast.querySelector(".toast-close").onclick = () => {
    removeToast(toast);
  };
}

// ===== REMOVE =====
function removeToast(el) {
  if (!el) return;

  el.classList.add("hide");

  setTimeout(() => {
    el.querySelectorAll(".toast-firework").forEach((p) => {
      p.remove();
    });

    el.remove();

    if (currentToast === el) {
      currentToast = null;
    }
  }, 250);
}

// ===== CONTAINER =====
function createContainer() {
  const container = document.createElement("div");

  container.id = "toast-container";

  document.body.appendChild(container);

  return container;
}

// ===== FIREWORK =====
function createFirework(toast, type) {
  const colors = {
    success: ["#22c55e", "#4ade80", "#bbf7d0"],

    error: ["#ef4444", "#f87171", "#fecaca"],
  };

  const particleColors = colors[type] || colors.success;

  const total = 10;

  for (let i = 0; i < total; i++) {
    const p = document.createElement("span");

    p.className = "toast-firework";

    const angle = (i / total) * Math.PI * 2;

    const distance = 70 + Math.random() * 40;

    const dx = Math.cos(angle) * distance;

    const dy = Math.sin(angle) * distance;

    p.style.setProperty("--dx", dx + "px");

    p.style.setProperty("--dy", dy + "px");

    p.style.background =
      particleColors[Math.floor(Math.random() * particleColors.length)];

    toast.appendChild(p);

    setTimeout(() => {
      p.remove();
    }, 700);
  }
}

// ===== AUTO TOAST =====
window.addEventListener("DOMContentLoaded", () => {
  if (!window.toastData) return;

  // chỉ hiện 1 lần duy nhất
  if (window.history.state?.toastShown) {
    return;
  }

  const { message, type } = window.toastData;

  if (!message || !type) return;

  showToast(message, type);

  history.replaceState(
    {
      toastShown: true,
    },
    "",
  );
});
