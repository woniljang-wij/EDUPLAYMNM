<div class="topbar">

    <h1>
        Chỉnh sửa danh mục
    </h1>

</div>

<div class="form-box">

    <form id="editCategoryForm" method="POST"
        action="/NguyenNhatTruong_2393/Admin/updateCategory/<?= $category["id"] ?>">

        <!-- CATEGORY NAME -->

        <div class="form-group">

            <label>
                Tên danh mục
            </label>

            <input type="text" id="editCategoryName" name="name" value="<?= htmlspecialchars($category["name"]) ?>"
                placeholder="Nhập tên danh mục..." required>

            <small id="editCategoryMessage" class="form-message"></small>

        </div>

        <!-- BUTTON -->

        <button type="submit" class="save-btn">

            Cập nhật danh mục

        </button>

    </form>

</div>