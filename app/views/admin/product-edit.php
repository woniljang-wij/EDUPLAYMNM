<div class="topbar">

    <h1>
        Chỉnh sửa sản phẩm
    </h1>

</div>

<div class="form-box">

    <form id="productForm" method="POST" enctype="multipart/form-data">

        <!-- NAME -->

        <div class="form-group">

            <label>
                Tên sản phẩm
            </label>

            <input type="text" id="name" name="name" value="<?= htmlspecialchars($product["name"]) ?>" required>

            <small id="nameMessage" class="form-message"></small>

        </div>

        <!-- DESCRIPTION -->

        <div class="form-group">

            <label>
                Mô tả
            </label>

            <textarea id="description" name="description"
                rows="5"><?= htmlspecialchars($product["description"]) ?></textarea>

            <small id="descriptionMessage" class="form-message"></small>

        </div>

        <!-- PRICE -->

        <div class="form-group">

            <label>
                Giá
            </label>

            <input type="text" id="price" name="price" value="<?= $product["price"] ?>" required>

            <small id="priceMessage" class="form-message"></small>

        </div>

        <!-- STOCK -->

        <div class="form-group">

            <label>
                Số lượng
            </label>

            <input type="text" id="stock" name="stock" value="<?= $product["stock"] ?>" required>

            <small id="stockMessage" class="form-message">
            </small>

        </div>

        <!-- CATEGORY -->

        <div class="form-group">

            <label>
                Danh mục
            </label>

            <select id="category_id" name="category_id" required>

                <?php foreach ($categories as $category): ?>

                    <option value="<?= $category["id"] ?>" <?= $category["id"] == $product["category_id"]
                          ? "selected"
                          : "" ?>>

                        <?= htmlspecialchars($category["name"]) ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>

        <!-- CURRENT IMAGE -->

        <div class="form-group">

            <label>
                Ảnh hiện tại
            </label>

            <img src="/NguyenNhatTruong_2393/public/images/<?= $product["image"] ?>" class="preview-img">

        </div>

        <!-- NEW IMAGE -->

        <div class="form-group">

            <label>
                Đổi ảnh
            </label>

            <input type="file" id="image" name="image" accept="image/*">

            <small id="imageMessage" class="form-message"></small>

        </div>

        <!-- BUTTON -->

        <button type="submit" class="save-btn">

            Cập nhật sản phẩm

        </button>

    </form>

</div>