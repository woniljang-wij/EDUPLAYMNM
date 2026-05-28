// ================= GLOBAL =================

const imageInput = document.getElementById("image");

// ================= TOAST =================

function showToastMessage(message, type = "success") {
  if (typeof showToast === "function") {
    showToast(message, type);
  }
}

// ================= HELPERS =================

function showError(input, messageId, message) {
  if (input) {
    input.style.borderColor = "#ef4444";
  }

  const msg = document.getElementById(messageId);

  if (msg) {
    msg.style.color = "#ef4444";

    msg.innerText = message;
  }
}

function showSuccess(input, messageId, message) {
  if (input) {
    input.style.borderColor = "#22c55e";
  }

  const msg = document.getElementById(messageId);

  if (msg) {
    msg.style.color = "#22c55e";

    msg.innerText = message;
  }
}

// ================= PRODUCT FORM =================

const productForm = document.getElementById("productForm");

if (productForm) {
  const nameInput = document.getElementById("name");

  const descriptionInput = document.getElementById("description");

  const priceInput = document.getElementById("price");

  const stockInput = document.getElementById("stock");

  // ================= NAME =================

  if (nameInput) {
    nameInput.addEventListener("input", () => {
      if (nameInput.value.trim().length < 3) {
        showError(
          nameInput,
          "nameMessage",
          "Tên sản phẩm phải từ 3 ký tự trở lên",
        );
      } else {
        showSuccess(nameInput, "nameMessage", "Tên sản phẩm hợp lệ");
      }
    });
  }

  // ================= DESCRIPTION =================

  if (descriptionInput) {
    descriptionInput.addEventListener("input", () => {
      if (descriptionInput.value.trim().length < 10) {
        showError(
          descriptionInput,
          "descriptionMessage",
          "Mô tả phải từ 10 ký tự trở lên",
        );
      } else {
        showSuccess(descriptionInput, "descriptionMessage", "Mô tả hợp lệ");
      }
    });
  }

  // ================= PRICE =================

  if (priceInput) {
    // CHẶN PASTE

    priceInput.addEventListener("paste", (e) => {
      e.preventDefault();

      showToastMessage("Không thể dán ký tự vào giá", "error");
    });

    // INPUT

    priceInput.addEventListener("input", () => {
      // CHỈ CHO SỐ

      priceInput.value = priceInput.value.replace(/\D/g, "");

      // VALIDATE

      if (priceInput.value === "" || Number(priceInput.value) <= 0) {
        showError(priceInput, "priceMessage", "Giá phải lớn hơn 0");
      } else {
        showSuccess(priceInput, "priceMessage", "Giá hợp lệ");
      }
    });
  }

  // ================= STOCK =================

  if (stockInput) {
    stockInput.addEventListener("input", () => {
      // CHỈ CHO NHẬP SỐ

      stockInput.value = stockInput.value.replace(/\D/g, "");

      // VALIDATE

      if (stockInput.value === "" || Number(stockInput.value) < 0) {
        showError(stockInput, "stockMessage", "Số lượng không hợp lệ");
      } else {
        showSuccess(stockInput, "stockMessage", "Số lượng hợp lệ");
      }
    });
  }

  // ================= SUBMIT =================

  productForm.addEventListener("submit", (e) => {
    // NAME

    if (nameInput.value.trim().length < 3) {
      e.preventDefault();

      showError(
        nameInput,
        "nameMessage",
        "Tên sản phẩm phải từ 3 ký tự trở lên",
      );

      nameInput.focus();

      return;
    }

    // DESCRIPTION

    if (descriptionInput.value.trim().length < 10) {
      e.preventDefault();

      showError(
        descriptionInput,
        "descriptionMessage",
        "Mô tả phải từ 10 ký tự trở lên",
      );

      descriptionInput.focus();

      return;
    }

    // PRICE

    if (priceInput.value === "" || Number(priceInput.value) <= 0) {
      e.preventDefault();

      showError(priceInput, "priceMessage", "Giá phải lớn hơn 0");

      priceInput.focus();

      return;
    }

    // STOCK

    if (stockInput.value === "" || Number(stockInput.value) < 0) {
      e.preventDefault();

      showError(stockInput, "stockMessage", "Số lượng không hợp lệ");

      stockInput.focus();

      return;
    }

    // IMAGE OPTIONAL WHEN EDIT

    if (imageInput && imageInput.files.length > 0) {
      const file = imageInput.files[0];

      const allowedTypes = ["image/jpeg", "image/png", "image/webp"];

      if (!allowedTypes.includes(file.type)) {
        e.preventDefault();

        showError(imageInput, "imageMessage", "Ảnh không hợp lệ");

        imageInput.focus();

        return;
      }
    }
  });
}

// ================= DELETE PRODUCT =================

const deleteButtons = document.querySelectorAll(".delete-product-btn");

deleteButtons.forEach((button) => {
  button.addEventListener("click", () => {
    showToastMessage("Đang xóa sản phẩm...", "warning");
  });
});

// ================= CATEGORY FORM =================

const categoryForm = document.getElementById("categoryForm");

if (categoryForm) {
  const categoryName = document.getElementById("categoryName");

  const categoryMessage = document.getElementById("categoryMessage");

  categoryName.addEventListener("input", () => {
    if (categoryName.value.trim().length < 2) {
      categoryName.style.borderColor = "#ef4444";

      categoryMessage.style.color = "#ef4444";

      categoryMessage.innerText = "Tên danh mục phải từ 2 ký tự trở lên";
    } else {
      categoryName.style.borderColor = "#22c55e";

      categoryMessage.style.color = "#22c55e";

      categoryMessage.innerText = "Tên danh mục hợp lệ";
    }
  });

  categoryForm.addEventListener("submit", (e) => {
    if (categoryName.value.trim().length < 2) {
      e.preventDefault();

      showToastMessage("Vui lòng nhập tên danh mục hợp lệ!", "error");
    }
  });
}

// ================= EDIT CATEGORY FORM =================

const editCategoryForm = document.getElementById("editCategoryForm");

if (editCategoryForm) {
  const editCategoryName = document.getElementById("editCategoryName");

  const editCategoryMessage = document.getElementById("editCategoryMessage");

  editCategoryName.addEventListener("input", () => {
    if (editCategoryName.value.trim().length < 2) {
      editCategoryName.style.borderColor = "#ef4444";

      editCategoryMessage.style.color = "#ef4444";

      editCategoryMessage.innerText = "Tên danh mục phải từ 2 ký tự trở lên";
    } else {
      editCategoryName.style.borderColor = "#22c55e";

      editCategoryMessage.style.color = "#22c55e";

      editCategoryMessage.innerText = "Tên danh mục hợp lệ";
    }
  });

  editCategoryForm.addEventListener("submit", (e) => {
    if (editCategoryName.value.trim().length < 2) {
      e.preventDefault();

      showToastMessage("Vui lòng nhập tên danh mục hợp lệ!", "error");
    }
  });
}

// ================= IMAGE PREVIEW =================

const chooseImageBtn = document.getElementById("chooseImageBtn");

const imagePreviewBox = document.getElementById("imagePreviewBox");

const previewImage = document.getElementById("previewImage");

const removeImageBtn = document.getElementById("removeImageBtn");

// OPEN FILE

if (chooseImageBtn && imageInput) {
  chooseImageBtn.addEventListener("click", () => {
    imageInput.click();
  });
}

// CHANGE IMAGE

if (imageInput) {
  imageInput.addEventListener("change", () => {
    const file = imageInput.files[0];

    if (!file) return;

    const imageUrl = URL.createObjectURL(file);

    if (previewImage) {
      previewImage.src = imageUrl;
    }

    if (imagePreviewBox) {
      imagePreviewBox.style.display = "block";
    }

    showSuccess(imageInput, "imageMessage", "Ảnh đã được chọn");

    showToastMessage("Preview ảnh thành công", "success");
  });
}

// REMOVE IMAGE

if (removeImageBtn && imageInput) {
  removeImageBtn.addEventListener("click", () => {
    imageInput.value = "";

    if (previewImage) {
      previewImage.src = "";
    }

    if (imagePreviewBox) {
      imagePreviewBox.style.display = "none";
    }

    const imageMessage = document.getElementById("imageMessage");

    if (imageMessage) {
      imageMessage.innerText = "";
    }

    showToastMessage("Đã xóa ảnh đã chọn", "warning");
  });
}
