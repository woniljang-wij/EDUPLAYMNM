<div class="topbar">

    <h1>
        Thêm sản phẩm
    </h1>

</div>

<div class="form-box">

    <form id="productForm" method="POST" enctype="multipart/form-data">

        <!-- NAME -->

        <div class="form-group">

            <label>
                Tên sản phẩm
            </label>

            <input type="text" id="name" name="name">

            <small id="nameMessage" class="form-message">
            </small>

        </div>

        <!-- DESCRIPTION -->

        <div class="form-group">

            <label>
                Mô tả
            </label>

            <textarea id="description" name="description" rows="5"></textarea>

            <small id="descriptionMessage" class="form-message">
            </small>

        </div>

        <!-- PRICE -->

        <div class="form-group">

            <label>
                Giá
            </label>

            <input type="text" id="price" name="price" autocomplete="off">

            <small id="priceMessage" class="form-message">
            </small>

        </div>

        <!-- STOCK -->

        <div class="form-group">

            <label>
                Số lượng
            </label>

            <input type="number" id="stock" name="stock" min="0" required>

            <small id="stockMessage" class="form-message">
            </small>

        </div>

        <!-- CATEGORY -->

        <div class="form-group">

            <label>
                Danh mục
            </label>

            <select id="category_id" name="category_id">

                <option value="">
                    -- Chọn danh mục --
                </option>

                <?php foreach ($categories as $category): ?>

                    <option value="<?= $category["id"] ?>">

                        <?= htmlspecialchars(
                            $category["name"]
                        ) ?>

                    </option>

                <?php endforeach; ?>

            </select>

            <small id="categoryMessage" class="form-message">
            </small>

        </div>

        <!-- IMAGE -->

        <div class="form-group">

            <label>
                Ảnh sản phẩm
            </label>

            <!-- FILE INPUT -->

            <input type="file" id="image" name="image" accept="image/*">

            <!-- PREVIEW -->

            <div id="imagePreviewBox" class="image-preview-box" style="display: none;">

                <button type="button" id="removeImageBtn" class="remove-image-btn">

                    ×

                </button>

                <img id="previewImage" class="preview-image" src="" alt="Preview">

            </div>

            <small id="imageMessage" class="form-message">
            </small>

        </div>

        <!-- SUBMIT -->

        <button type="submit" class="save-btn">

            Thêm sản phẩm

        </button>

    </form>

</div>