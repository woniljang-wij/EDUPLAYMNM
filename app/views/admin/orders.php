<div class="topbar">

    <h1>
        Quản lý đơn hàng
    </h1>

</div>

<table>

    <thead>

        <tr>

            <th>ID</th>

            <th>Khách hàng</th>

            <th>SĐT</th>

            <th>Tổng tiền</th>

            <th>Trạng thái</th>

            <th>Ngày tạo</th>

            <th>Chi tiết</th>

            <th>Xóa</th>

        </tr>

    </thead>

    <tbody>

        <?php foreach ($orders as $order): ?>

            <tr>

                <td>

                    #<?= $order["id"] ?>

                </td>

                <td>

                    <?= htmlspecialchars(
                        $order["fullname"]
                    ) ?>

                </td>

                <td>

                    <?= htmlspecialchars(
                        $order["phone"]
                    ) ?>

                </td>

                <td>

                    <?= number_format(
                        $order["total_price"],
                        0,
                        ",",
                        "."
                    ) ?>đ

                </td>

                <td>

                    <span class="status <?= $order["status"] ?>">

                        <?= $order["status"] ?>

                    </span>

                </td>

                <td>

                    <?= $order["created_at"] ?>

                </td>

                <!-- DETAIL -->

                <td>

                    <a class="detail-btn"
                        href="/NguyenNhatTruong_2393/Admin/dashboard?page=order-detail&id=<?= $order["id"] ?>">

                        Chi tiết

                    </a>

                </td>

                <!-- DELETE -->

                <td>

                    <a class="delete-btn" href="/NguyenNhatTruong_2393/Admin/deleteOrder/<?= $order["id"] ?>"
                        onclick="return confirm('Xóa đơn hàng này?')">

                        Xóa

                    </a>

                </td>

            </tr>

        <?php endforeach; ?>

    </tbody>

</table>