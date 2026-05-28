<div class="topbar">

    <div>

        <h1 class="page-title">
            Đơn hàng #<?= $order["id"] ?>
        </h1>

        <p class="page-subtitle">
            Chi tiết đơn hàng và trạng thái xử lý
        </p>

    </div>

    <a class="back-btn" href="/NguyenNhatTruong_2393/Admin/dashboard?page=orders">

        ← Quay lại

    </a>

</div>

<!-- GRID -->

<div class="order-detail-grid">

    <!-- LEFT -->

    <div class="left-column">

        <!-- CUSTOMER -->

        <div class="detail-card">

            <h2>
                Thông tin khách hàng
            </h2>

            <div class="customer-info">

                <div class="info-row">

                    <span>Họ tên</span>

                    <strong>
                        <?= htmlspecialchars($order["fullname"]) ?>
                    </strong>

                </div>

                <div class="info-row">

                    <span>Số điện thoại</span>

                    <strong>
                        <?= htmlspecialchars($order["phone"]) ?>
                    </strong>

                </div>

                <div class="info-row">

                    <span>Địa chỉ</span>

                    <strong>
                        <?= htmlspecialchars($order["address"]) ?>
                    </strong>

                </div>

            </div>

        </div>

        <!-- PRODUCTS -->

        <div class="detail-card">

            <h2>
                Sản phẩm đã đặt
            </h2>

            <div class="product-list">

                <?php foreach ($items as $item): ?>

                    <div class="product-row">

                        <img src="/NguyenNhatTruong_2393/public/images/<?= $item["image"] ?>" class="product-thumb">

                        <div class="product-content">

                            <h3>

                                <?= htmlspecialchars($item["name"]) ?>

                            </h3>

                            <p>

                                Số lượng:
                                <?= $item["quantity"] ?>

                            </p>

                        </div>

                        <div class="product-price">

                            <?= number_format(
                                $item["price"],
                                0,
                                ",",
                                "."
                            ) ?>đ

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

    <!-- RIGHT -->

    <div class="right-column">

        <!-- STATUS -->

        <div class="detail-card">

            <h2>
                Trạng thái đơn hàng
            </h2>

            <form class="status-form" method="POST"
                action="/NguyenNhatTruong_2393/index.php?url=Admin/updateStatus/<?= $order["id"] ?>">

                <select name="status" class="status-select">

                    <option value="pending" <?= $order["status"] == "pending" ? "selected" : "" ?>>

                        Chờ xử lý

                    </option>

                    <option value="shipping" <?= $order["status"] == "shipping" ? "selected" : "" ?>>

                        Đang giao

                    </option>

                    <option value="completed" <?= $order["status"] == "completed" ? "selected" : "" ?>>

                        Hoàn thành

                    </option>

                    <option value="cancelled" <?= $order["status"] == "cancelled" ? "selected" : "" ?>>

                        Đã hủy

                    </option>

                </select>

                <button type="submit" class="save-btn">

                    Cập nhật

                </button>

            </form>

        </div>

        <!-- TOTAL -->

        <div class="detail-card total-card">

            <span>
                Tổng tiền
            </span>

            <h1>

                <?= number_format(
                    $order["total_price"],
                    0,
                    ",",
                    "."
                ) ?>đ

            </h1>

        </div>

    </div>

</div>