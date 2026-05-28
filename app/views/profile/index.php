<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <title>Tài khoản</title>

    <link rel="stylesheet" href="/NguyenNhatTruong_2393/public/css/profile.css">

</head>

<body>

    <div class="profile-page">

        <aside class="sidebar">

            <div class="avatar">

                👤

            </div>

            <h2>
                <?= $_SESSION["user"]["username"] ?>
            </h2>

            <p>
                <?= $_SESSION["user"]["email"] ?>
            </p>

            <a href="/NguyenNhatTruong_2393/">
                Trang chủ
            </a>

            <a href="/NguyenNhatTruong_2393/Cart/index">
                Giỏ hàng
            </a>

            <a href="/NguyenNhatTruong_2393/Auth/logout" class="logout-btn">
                Đăng xuất
            </a>

        </aside>

        <main class="content">

            <h1>
                Đơn hàng của bạn
            </h1>

            <?php if (empty($orders)): ?>

                <div class="empty">

                    Chưa có đơn hàng nào

                </div>

            <?php endif; ?>

            <div class="orders">

                <?php foreach ($orders as $order): ?>

                    <div class="order-card">

                        <div class="top">

                            <div>

                                <h3>
                                    Đơn #<?= $order["id"] ?>
                                </h3>

                                <p>
                                    <?= $order["created_at"] ?>
                                </p>

                            </div>

                            <span class="status <?= $order["status"] ?>">

                                <?= $order["status"] ?>

                            </span>

                        </div>

                        <div class="bottom">

                            <div class="price">

                                <?= number_format(
                                    $order["total_price"],
                                    0,
                                    ",",
                                    "."
                                ) ?>đ

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        </main>

    </div>

</body>

</html>