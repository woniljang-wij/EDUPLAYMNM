<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Admin Dashboard
    </title>

    <link rel="stylesheet" href="/NguyenNhatTruong_2393/public/css/toast.css?v=999">

    <link rel="stylesheet" href="/NguyenNhatTruong_2393/public/css/admin-dashboard.css?v=999">

</head>

<body>

    <div class="admin-layout">

        <!-- SIDEBAR -->

        <aside class="sidebar">

            <!-- LOGO -->

            <div class="logo">

                <span>🎓</span>

                <div>
                    EduPlay Admin
                </div>

            </div>

            <!-- MENU -->

            <nav class="menu">

                <a href="/NguyenNhatTruong_2393/Admin/dashboard?page=dashboard"
                    class="<?= ($_GET['page'] ?? 'dashboard') === 'dashboard' ? 'active' : '' ?>">

                    📊 <span>Tổng quan</span>

                </a>

                <a href="/NguyenNhatTruong_2393/Admin/dashboard?page=products"
                    class="<?= ($_GET['page'] ?? '') === 'products' ? 'active' : '' ?>">

                    📦 <span>Sản phẩm</span>

                </a>

                <a href="/NguyenNhatTruong_2393/Admin/dashboard?page=categories"
                    class="<?= ($_GET['page'] ?? '') === 'categories' ? 'active' : '' ?>">

                    📂 <span>Danh mục</span>

                </a>

                <a href="/NguyenNhatTruong_2393/Admin/dashboard?page=orders"
                    class="<?= ($_GET['page'] ?? '') === 'orders' ? 'active' : '' ?>">

                    🧾 <span>Đơn hàng</span>

                </a>

                <a href="/NguyenNhatTruong_2393/Admin/dashboard?page=users"
                    class="<?= ($_GET['page'] ?? '') === 'users' ? 'active' : '' ?>">

                    👥 <span>Người dùng</span>

                </a>

                <a href="/NguyenNhatTruong_2393/Product/list">

                    🛍 <span>Về trang shop</span>

                </a>

            </nav>

            <!-- FOOTER -->

            <div class="sidebar-footer">

                <a href="/NguyenNhatTruong_2393/Auth/logout" class="logout-btn">

                    🚪 Đăng xuất

                </a>

            </div>

        </aside>

        <!-- MAIN -->

        <main class="main-content">

            <?php require $contentView; ?>

        </main>

    </div>

    <?php if (isset($_SESSION["toast"])): ?>

        <script>

            window.toastData = {
                type: "<?= $_SESSION["toast"]["type"] ?>",
                message: "<?= $_SESSION["toast"]["message"] ?>"
            };

        </script>

        <?php unset($_SESSION["toast"]); ?>

    <?php endif; ?>

    <script src="/NguyenNhatTruong_2393/public/js/toast.js?v=999"></script>

    <script src="/NguyenNhatTruong_2393/public/js/admin-dashboard.js?v=999"></script>
</body>

</html>