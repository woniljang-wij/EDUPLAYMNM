<div class="topbar">

    <div>

        <h1>
            Dashboard quản trị
        </h1>

        <div class="admin-user">

            👑 <?= $_SESSION["user"]["username"] ?>

        </div>

    </div>

</div>

<!-- STATS -->

<div class="stats-grid">

    <div class="stat-card">

        <span>
            Tổng sản phẩm
        </span>

        <h2>
            <?= $totalProducts ?>
        </h2>

    </div>

    <div class="stat-card">

        <span>
            Tổng người dùng
        </span>

        <h2>
            <?= $totalUsers ?>
        </h2>

    </div>

    <div class="stat-card">

        <span>
            Tổng đơn hàng
        </span>

        <h2>
            <?= $totalOrders ?>
        </h2>

    </div>

    <div class="stat-card revenue">

        <span>
            Doanh thu
        </span>

        <h2>

            <?= number_format(
                $totalRevenue,
                0,
                ',',
                '.'
            ) ?>đ

        </h2>

    </div>

</div>

<!-- RECENT ORDERS -->

<div class="table-box">

    <div class="table-header">

        <h2>
            Đơn hàng gần đây
        </h2>

    </div>

    <table>

        <thead>

            <tr>

                <th>ID</th>

                <th>Khách hàng</th>

                <th>Tổng tiền</th>

                <th>Trạng thái</th>

                <th>Ngày tạo</th>

            </tr>

        </thead>

        <tbody>

            <?php foreach ($recentOrders as $order): ?>

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

                        <?= number_format(
                            $order["total_price"],
                            0,
                            ',',
                            '.'
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

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</div>