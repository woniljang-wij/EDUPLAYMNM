<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Đăng ký | EduPlay</title>

    <script src="https://cdn.tailwindcss.com"></script>

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

    <div class="auth-card flex flex-col md:flex-row max-w-5xl w-full mx-4 rounded-[2.5rem] overflow-hidden">

        <!-- LEFT -->

        <div
            class="hidden md:flex md:w-5/12 bg-gradient-to-br from-indigo-600 to-purple-700 p-12 text-white flex-col justify-between">

            <div>

                <h1 class="text-3xl font-extrabold mb-4">
                    🎓 EduPlay
                </h1>

                <p class="text-indigo-100">

                    Khám phá laptop, gaming gear và phụ kiện công nghệ chính hãng với giá tốt nhất.

                </p>

            </div>

        </div>

        <!-- RIGHT -->

        <div class="w-full md:w-7/12 p-8 md:p-16 bg-white/90">

            <div class="mb-10">

                <h2 class="text-3xl font-extrabold text-slate-800">

                    Tạo tài khoản

                </h2>

            </div>

            <!-- ERROR -->

            <?php if (!empty($errors)): ?>

                <div class="mb-5 rounded-2xl bg-red-100 text-red-700 px-5 py-4">

                    <?php foreach ($errors as $error): ?>

                        <div>
                            <?= $error ?>
                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

            <!-- FORM -->

            <form method="POST" class="space-y-4">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <input type="text" name="username" class="auth-input" placeholder="Tên người dùng" required>

                    <input type="email" name="email" class="auth-input" placeholder="Email" required>

                </div>

                <input type="password" name="password" class="auth-input" placeholder="Mật khẩu" required>

                <button type="submit" class="btn-auth w-full text-lg">

                    Đăng ký tham gia

                </button>

            </form>

            <!-- FOOTER -->

            <div class="mt-10 text-center">

                <p class="text-slate-600">

                    Bạn đã có tài khoản?

                    <a href="/NguyenNhatTruong_2393/Auth/login" class="text-indigo-600 font-bold">

                        Đăng nhập

                    </a>

                </p>

            </div>

        </div>

    </div>

    <script src="/NguyenNhatTruong_2393/public/js/register.js?v=999"></script>

</body>

</html>