<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Giỏ hàng</title>

    <link rel="stylesheet" href="/NguyenNhatTruong_2393/public/css/cart.css">

</head>

<body>

    <div class="cart-page">

        <div class="cart-header">

            <h1>
                Giỏ hàng của bạn
            </h1>

            <a href="/NguyenNhatTruong_2393/Product/list" class="back-btn">

                ← Tiếp tục mua sắm

            </a>

        </div>

        <?php if (empty($cart)): ?>

            <div class="empty-cart">

                <h2>
                    Giỏ hàng đang trống
                </h2>

                <p>
                    Hãy thêm sản phẩm vào giỏ hàng.
                </p>

            </div>

        <?php else: ?>

            <?php

            $total = 0;

            foreach ($cart as $item):

                $subtotal =
                    $item["price"] * $item["quantity"];

                $total += $subtotal;

                ?>

                <div class="cart-item">

                    <img src="/NguyenNhatTruong_2393/public/images/<?= $item["image"] ?>" alt="">

                    <div class="cart-info">

                        <h2>

                            <?= htmlspecialchars($item["name"]) ?>

                        </h2>

                        <div class="price">

                            <?= number_format(
                                $item["price"],
                                0,
                                ',',
                                '.'
                            ) ?>đ

                        </div>

                    </div>

                    <form method="POST" action="/NguyenNhatTruong_2393/Cart/update" class="quantity-form">

                        <input type="hidden" name="id" value="<?= $item["id"] ?>">

                        <input type="number" min="1" name="quantity" value="<?= $item["quantity"] ?>" class="qty-input"
                            onchange="this.form.submit()">

                    </form>

                    <div class="subtotal">

                        <?= number_format(
                            $subtotal,
                            0,
                            ',',
                            '.'
                        ) ?>đ

                    </div>

                    <a href="/NguyenNhatTruong_2393/Cart/remove/<?= $item["id"] ?>" class="remove-btn">

                        Xóa

                    </a>

                </div>

            <?php endforeach; ?>

            <div class="cart-summary">

                <div class="total">

                    Tổng cộng:
                    <span>

                        <?= number_format(
                            $total,
                            0,
                            ',',
                            '.'
                        ) ?>đ

                    </span>

                </div>

                <div class="summary-buttons">

                    <a href="/NguyenNhatTruong_2393/Cart/clear" class="clear-btn">

                        Xóa toàn bộ

                    </a>

                    <a href="/NguyenNhatTruong_2393/Checkout/index" class="checkout-btn">

                        Thanh toán

                    </a>

                </div>

            </div>

        <?php endif; ?>

    </div>

</body>

</html>