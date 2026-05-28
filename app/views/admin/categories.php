<div class="topbar">

    <h1>
        Quản lý danh mục
    </h1>

    <a class="add-btn" href="/NguyenNhatTruong_2393/Admin/dashboard?page=category-add">

        + Thêm danh mục

    </a>

</div>

<table>

    <thead>

        <tr>

            <th>ID</th>

            <th>Tên danh mục</th>

            <th>Hành động</th>

        </tr>

    </thead>

    <tbody>

        <?php if (!empty($categories)): ?>

            <?php foreach ($categories as $category): ?>

                <tr>

                    <td>

                        <?= $category["id"] ?>

                    </td>

                    <td>

                        <?= htmlspecialchars($category["name"]) ?>

                    </td>

                    <td>

                        <div class="action-buttons">

                            <!-- EDIT -->

                            <a class="edit-btn"
                                href="/NguyenNhatTruong_2393/Admin/dashboard?page=category-edit&id=<?= $category["id"] ?>">

                                Sửa

                            </a>

                            <!-- DELETE -->

                            <a class="delete-btn delete-category-btn"
                                href="/NguyenNhatTruong_2393/Admin/deleteCategory/<?= $category["id"] ?>">

                                Xóa

                            </a>

                        </div>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>

                <td colspan="3" class="empty-data">

                    Chưa có danh mục nào

                </td>

            </tr>

        <?php endif; ?>

    </tbody>

</table>