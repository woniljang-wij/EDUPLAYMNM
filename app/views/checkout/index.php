<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <title>Thanh toán</title>

    <link rel="stylesheet" href="/NguyenNhatTruong_2393/public/css/checkout.css">

</head>

<body>

    <div class="checkout-page">

        <div class="checkout-box">

            <h1>
                Thông tin đặt hàng
            </h1>

            <form method="POST" action="/NguyenNhatTruong_2393/Checkout/placeOrder">

                <div class="form-group">

                    <label>
                        Họ tên
                    </label>

                    <input type="text" name="fullname" required>

                </div>

                <div class="form-group">

                    <label>
                        Số điện thoại
                    </label>

                    <input type="text" name="phone" required>

                </div>

                <div class="form-group">

                    <label>
                        Địa chỉ
                    </label>

                    <textarea name="address" required></textarea>

                </div>

                <button class="checkout-btn">

                    Đặt hàng

                </button>

            </form>

        </div>

    </div>

</body>

</html>