<?php

/** @var array[] $products */ ?>

<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>EduPlay Shop</title>

    <link rel="stylesheet" href="/NguyenNhatTruong_2393/public/css/toast.css">

    <link rel="stylesheet" href="/NguyenNhatTruong_2393/public/css/list.css?v=1000">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

</head>

<body>

    <!-- ================= BACKGROUND VIDEO ================= -->

    <video autoplay muted loop playsinline class="bg-video">

        <source src="/NguyenNhatTruong_2393/public/videos/bg-sakura.mp4" type="video/mp4">

    </video>

    <!-- ================= OVERLAY ================= -->

    <div class="overlay"></div>

    <!-- ================= NAVBAR ================= -->

    <div class="navbar">

        <div class="navbar-left">

            <a href="/NguyenNhatTruong_2393/Product/list" class="logo">

                EduPlay Shop

            </a>

        </div>

        <div class="navbar-center">

            <form method="GET" action="/NguyenNhatTruong_2393/Product/list" class="search-form">

                <!-- SEARCH -->

                <input type="text" name="keyword" placeholder="Bạn tìm gì hôm nay?" class="search-box"
                    value="<?= $_GET['keyword'] ?? '' ?>">

                <!-- CATEGORY -->

                <select name="category" class="filter-select">

                    <option value="">
                        Tất cả danh mục
                    </option>

                    <?php foreach ($categories as $cat): ?>

                        <option value="<?= $cat['id'] ?>" <?= (
                              ($_GET['category'] ?? '')
                              == $cat['id']
                          ) ? 'selected' : '' ?>>

                            <?= $cat['name'] ?>

                        </option>

                    <?php endforeach; ?>

                </select>

                <!-- SORT -->

                <select name="sort" class="filter-select">

                    <option value="">
                        Sắp xếp
                    </option>

                    <option value="price_asc" <?= (
                        ($_GET['sort'] ?? '')
                        == 'price_asc'
                    ) ? 'selected' : '' ?>>

                        Giá tăng dần

                    </option>

                    <option value="price_desc" <?= (
                        ($_GET['sort'] ?? '')
                        == 'price_desc'
                    ) ? 'selected' : '' ?>>

                        Giá giảm dần

                    </option>

                </select>

                <button type="submit" class="search-btn">

                    Tìm

                </button>

            </form>

        </div>

        <div class="navbar-right">

            <a href="/NguyenNhatTruong_2393/Cart/index" class="nav-btn">

                🛒 Giỏ hàng

            </a>

            <?php if (isset($_SESSION["user"])): ?>

                <?php if ($_SESSION["user"]["role"] === "admin"): ?>

                    <a href="/NguyenNhatTruong_2393/Admin/dashboard" class="admin-btn">

                        Admin

                    </a>

                <?php endif; ?>

                <a href="/NguyenNhatTruong_2393/Profile/index" class="nav-btn">

                    👤 <?= $_SESSION["user"]["username"] ?>

                </a>

                <a href="#" class="logout-btn" id="logoutBtn">

                    Đăng xuất

                </a>

            <?php else: ?>

                <a href="/NguyenNhatTruong_2393/Auth/login" class="login-btn">

                    Đăng nhập

                </a>

                <a href="/NguyenNhatTruong_2393/Auth/register" class="nav-btn">

                    Đăng ký

                </a>

            <?php endif; ?>

        </div>

    </div>

    <!-- ================= PRODUCT SECTION ================= -->

    <div class="section-title" id="productSection">

        Sản phẩm nổi bật

    </div>

    <div class="grid">

        <?php foreach ($products as $product): ?>

            <div class="card">

                <div class="discount-badge">

                    -20%

                </div>

                <div class="category-name">

                    <?= htmlspecialchars($product['category_name']); ?>

                </div>

                <a href="/NguyenNhatTruong_2393/Product/detail/<?= $product['id']; ?>">

                    <img src="/NguyenNhatTruong_2393/public/images/<?= $product['image']; ?>" alt="" class="product-image">

                </a>

                <h2>

                    <a href="/NguyenNhatTruong_2393/Product/detail/<?= $product['id']; ?>" class="product-link">

                        <?= htmlspecialchars(
                            $product['name'],
                            ENT_QUOTES,
                            'UTF-8'
                        ); ?>

                    </a>

                </h2>

                <div class="desc">

                    <?= htmlspecialchars(
                        $product['description'],
                        ENT_QUOTES,
                        'UTF-8'
                    ); ?>

                </div>

                <div class="price-box">

                    <div class="new-price">

                        <?= number_format(
                            $product['price'],
                            0,
                            ',',
                            '.'
                        ); ?>đ

                    </div>

                    <div class="old-price">

                        <?= number_format(
                            $product['price'] * 1.2,
                            0,
                            ',',
                            '.'
                        ); ?>đ

                    </div>

                </div>

                <div class="stock">

                    Còn hàng

                </div>

                <div class="buttons">

                    <a href="/NguyenNhatTruong_2393/Cart/add/<?= $product['id']; ?>" class="cart-btn">

                       Thêm giỏ hàng

                    </a>

                    <a href="/NguyenNhatTruong_2393/Cart/add/<?= $product['id']; ?>" class="buy-btn">

                        Mua ngay

                    </a>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

    <!-- ================= FOOTER ================= -->

    <footer class="footer">

        <div class="footer-content">

            <div class="footer-logo">

                EduPlay Shop

            </div>

            <p>

                Hệ thống bán lẻ công nghệ, gaming gear và phụ kiện chính hãng.

            </p>

            <div class="footer-links">

                <a href="#">
                    Chính sách bảo hành
                </a>

                <a href="#">
                    Chính sách đổi trả
                </a>

                <a href="#">
                    Liên hệ
                </a>

            </div>

            <div class="copyright">

                © 2026 EduPlay Shop. All rights reserved.

            </div>

        </div>

    </footer>

    <!-- ================= TOAST ================= -->

    <script>

        window.toastData = {

            message: <?= json_encode($_SESSION['toast']['message'] ?? '') ?>,

            type: <?= json_encode($_SESSION['toast']['type'] ?? '') ?>

        };

    </script>

    <?php unset($_SESSION['toast']); ?>

    <!-- LOGOUT POPUP -->

    <div class="popup-overlay" id="logoutPopup">

        <div class="popup-box">

            <h3>
                Đăng xuất?
            </h3>

            <p>
                Bạn có chắc muốn đăng xuất khỏi hệ thống?
            </p>

            <div class="popup-buttons">

                <button class="cancel-btn" id="cancelLogout">

                    Hủy

                </button>

                <a href="/NguyenNhatTruong_2393/Auth/logout" class="confirm-btn">

                    Đăng xuất

                </a>

            </div>

        </div>

    </div>

    <script src="/NguyenNhatTruong_2393/public/js/toast.js"></script>

    <script src="/NguyenNhatTruong_2393/public/js/list.js?v=9999"></script>

</body>

</html>