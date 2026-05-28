<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Đăng nhập | EduPlay</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    <link rel="stylesheet" href="/NguyenNhatTruong_2393/public/css/auth.css">

</head>

<body>

    <div class="center-glow"></div>

    <!-- BACK -->

    <a href="/NguyenNhatTruong_2393/Product/list" class="back-home-btn fixed top-6 left-6 z-50 group">

        <div
            class="flex items-center gap-2 px-5 py-2.5 bg-white/20 backdrop-blur-md border border-white/30 rounded-2xl text-white font-bold shadow-xl transition-all group-hover:bg-white/40 group-hover:-translate-x-1">

            ← Trang chủ

        </div>

    </a>

    <!-- BG -->

    <div class="auth-bg-decoration top-[-10%] left-[-10%]"></div>

    <div class="auth-bg-decoration bottom-[-10%] right-[-10%]" style="animation-delay: -4s"></div>

    <!-- CARD -->

    <div
        class="auth-card max-w-[450px] w-full mx-4 rounded-[2.5rem] overflow-hidden bg-white/90 px-6 py-10 md:px-8 md:py-10">

        <!-- HEADER -->

        <div class="text-center mb-6">

            <div
                class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-tr from-indigo-500 to-purple-600 rounded-3xl shadow-lg shadow-indigo-200 mb-6 rotate-3">

                <span class="text-4xl">
                    🎓
                </span>

            </div>

            <h2 class="text-3xl font-black text-slate-800 tracking-tight">

                Chào mừng quay lại!

            </h2>

            <p class="text-slate-500 mt-2 font-medium">

                Đăng nhập để tiếp tục mua sắm công nghệ tại EduPlay Shop

            </p>

        </div>

        <!-- ERROR -->

        <?php if (isset($_SESSION["login_error"])): ?>

            <div class="mb-5 rounded-2xl bg-red-100 text-red-700 px-5 py-4">

                <?= $_SESSION["login_error"]; ?>

            </div>

            <?php unset($_SESSION["login_error"]); ?>

        <?php endif; ?>

        <!-- FORM -->

        <form method="POST" id="loginForm" class="space-y-4">

            <!-- EMAIL -->

            <div class="space-y-1">

                <label class="text-xs font-bold text-slate-500 ml-1 uppercase">

                    Email

                </label>

                <div class="relative">

                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">

                        👤

                    </span>

                    <input type="email" name="email" class="auth-input pl-12" placeholder="Nhập email..."
                        autocomplete="off" required>

                </div>

            </div>

            <!-- PASSWORD -->

            <div class="space-y-1">

                <div class="flex justify-between items-center px-1">

                    <label class="text-xs font-bold text-slate-500 uppercase">

                        Mật khẩu

                    </label>

                </div>

                <div class="relative">

                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">

                        🔒

                    </span>

                    <input type="password" name="password" id="password" class="auth-input pl-12 pr-14"
                        placeholder="Nhập mật khẩu..." required>

                    <button type="button" id="togglePassword"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-indigo-600 transition text-[22px]">

                        <i class="bi bi-eye-slash"></i>

                    </button>

                </div>

            </div>

            <!-- BUTTON -->

            <div class="pt-4">

                <button type="submit" class="btn-auth w-full text-lg shadow-xl">

                    Đăng nhập ngay

                </button>

            </div>

        </form>

        <!-- FOOTER -->

        <div class="mt-6 text-center border-t border-slate-100 pt-5">

            <p class="text-slate-600">

                Bạn là thành viên mới?

                <a href="/NguyenNhatTruong_2393/Auth/register" class="text-indigo-600 font-bold hover:underline">

                    Tạo tài khoản

                </a>

            </p>

        </div>

    </div>

    <script src="/NguyenNhatTruong_2393/public/js/login.js?v=999999"></script>

</body>

</html>