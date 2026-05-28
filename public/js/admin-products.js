const deleteButtons = document.querySelectorAll(".delete-btn");

deleteButtons.forEach((button) => {
  button.addEventListener("click", (e) => {
    const confirmDelete = confirm("Bạn có chắc muốn xóa sản phẩm này?");

    if (!confirmDelete) {
      e.preventDefault();
    }
  });
});

const imageInput = document.querySelector('input[name="image"]');

if (imageInput) {
  imageInput.addEventListener("change", (e) => {
    const file = e.target.files[0];

    if (!file) return;

    const reader = new FileReader();

    reader.onload = (event) => {
      let preview = document.querySelector(".preview-img");

      if (!preview) {
        preview = document.createElement("img");

        preview.className = "preview-img";

        imageInput.parentElement.appendChild(preview);
      }

      preview.src = event.target.result;
    };

    reader.readAsDataURL(file);
  });
}
