const deleteButtons =
  document.querySelectorAll(".delete-btn");

deleteButtons.forEach((button) => {

  button.addEventListener("click", (e) => {

    const confirmDelete =
      confirm(
        "Bạn có chắc muốn xóa user này?"
      );

    if (!confirmDelete) {

      e.preventDefault();
    }
  });
});