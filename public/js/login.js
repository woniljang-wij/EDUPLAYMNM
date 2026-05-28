const form = document.querySelector("form");

const btn = document.querySelector(".btn-auth");

const emailInput = document.querySelector('input[name="email"]');

const passwordInput = document.querySelector('input[name="password"]');

const togglePassword = document.getElementById("togglePassword");

// ================= VALIDATE =================

form.addEventListener("submit", (e) => {
  const email = emailInput.value.trim();

  const password = passwordInput.value.trim();

  // ===== EMAIL =====

  if (!email) {
    e.preventDefault();

    alert("Vui lòng nhập email!");

    emailInput.focus();

    return;
  }

  // ===== PASSWORD =====

  if (!password) {
    e.preventDefault();

    alert("Vui lòng nhập mật khẩu!");

    passwordInput.focus();

    return;
  }

  // ===== LOADING =====

  btn.disabled = true;

  btn.innerText = "Đang đăng nhập...";
});

// ================= TOGGLE PASSWORD =================

if (togglePassword) {
  togglePassword.addEventListener("click", () => {
    const icon = togglePassword.querySelector("i");

    // PASSWORD ĐANG ẨN

    if (passwordInput.type === "password") {
      passwordInput.type = "text";

      icon.classList.remove("bi-eye-slash");

      icon.classList.add("bi-eye");
    }

    // PASSWORD ĐANG HIỆN
    else {
      passwordInput.type = "password";

      icon.classList.remove("bi-eye");

      icon.classList.add("bi-eye-slash");
    }
  });
}

// ================= ENTER EFFECT =================

document.addEventListener("keydown", (e) => {
  if (e.key === "Enter") {
    form.requestSubmit();
  }
});

// ================= INPUT EFFECT =================

const inputs = document.querySelectorAll(".auth-input");

inputs.forEach((input) => {
  input.addEventListener("focus", () => {
    input.parentElement.classList.add("active");
  });

  input.addEventListener("blur", () => {
    input.parentElement.classList.remove("active");
  });
});

console.log("EduPlay Login System Ready");
