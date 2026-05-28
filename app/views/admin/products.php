<div class="topbar">

    <h1>
        Quản lý sản phẩm
    </h1>

    <a
        class="add-btn"
        href="/NguyenNhatTruong_2393/Admin/dashboard?page=product-add">

        + Thêm sản phẩm

    </a>

</div>

<table>

    <thead>

        <tr>

            <th>ID</th>

            <th>Ảnh</th>

            <th>Tên</th>

            <th>Danh mục</th>

            <th>Giá</th>

            <th>Tồn kho</th>

            <th>Hành động</th>

        </tr>

    </thead>

    <tbody>

        <?php foreach ($products as $product): ?>

            <tr>

                <!-- ID -->

                <td>

                    <?= $product["id"] ?>

                </td>

                <!-- IMAGE -->

                <td>

                    <img
                        src="/NguyenNhatTruong_2393/public/images/<?= $product["image"] ?>"
                        class="product-img">

                </td>

                <!-- NAME -->

                <td>

                    <?= htmlspecialchars(
                        $product["name"]
                    ) ?>

                </td>

                <!-- CATEGORY -->

                <td>

                    <?= htmlspecialchars(
                        $product["category_name"]
                    ) ?>

                </td>

                <!-- PRICE -->

                <td>

                    <?= number_format(
                        $product["price"],
                        0,
                        ',',
                        '.'
                    ) ?>đ

                </td>

                <!-- STOCK -->

                <td>

                    <?php if ($product["stock"] > 0): ?>

                        <span class="stock-badge in-stock">

                            <?= $product["stock"] ?> sản phẩm

                        </span>

                    <?php else: ?>

                        <span class="stock-badge out-stock">

                            Hết hàng

                        </span>

                    <?php endif; ?>

                </td>

                <!-- ACTION -->

                <td>

                    <div class="action-buttons">

                        <a
                            href="/NguyenNhatTruong_2393/Admin/dashboard?page=product-edit&id=<?= $product['id'] ?>"
                            class="edit-btn">

                            Sửa

                        </a>

                        <a
                            href="/NguyenNhatTruong_2393/Admin/deleteProduct/<?= $product['id'] ?>"
                            class="delete-btn delete-product-btn">

                            Xóa

                        </a>

                    </div>

                </td>

            </tr>

        <?php endforeach; ?>

    </tbody>

</table>
