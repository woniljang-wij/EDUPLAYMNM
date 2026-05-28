<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <title>
        <?= htmlspecialchars($product["name"]) ?>
    </title>

    <link rel="stylesheet" href="/NguyenNhatTruong_2393/public/css/product-detail.css">

</head>

<body>

    <div class="container">

        <!-- TOP -->

        <div class="product-detail">

            <!-- IMAGE -->

            <div class="left">

                <img src="/NguyenNhatTruong_2393/public/images/<?= $product["image"] ?>"
                class="main-image">

            </div>

            <!-- INFO -->

            <div class="right">

                <div class="category">

                    <?= htmlspecialchars($product["category_name"]) ?>

                </div>

                <h1>

                    <?= htmlspecialchars($product["name"]) ?>

                </h1>

                <div class="price">

                    <?= number_format(
                        $product["price"],
                        0,
                        ",",
                        "."
                    ) ?>đ

                </div>

                <div class="stock">

                    Còn hàng
                </div>

                <div class="description">

                    <?= nl2br(
                        htmlspecialchars(
                            $product["description"]
                        )
                    ) ?>

                </div>

                <!-- BUTTONS -->

                <div class="buttons">

                    <a href="/NguyenNhatTruong_2393/Cart/add/<?= $product["id"] ?>"
                        class="cart-btn">

                        🛒 Thêm vào giỏ

                    </a>

                    <a href="/NguyenNhatTruong_2393/Cart/add/<?= $product["id"] ?>"
                        class="buy-btn">

                        Mua ngay

                    </a>

                </div>

            </div>

        </div>

        <!-- RELATED -->

        <div class="related-section">

            <h2>
                Sản phẩm liên quan
            </h2>

            <div class="related-grid">

                <?php foreach ($relatedProducts as $item): ?>

                    <div class="related-card">

                        <a href="/NguyenNhatTruong_2393/Product/detail/<?= $item["id"] ?>">

                            <img src="/NguyenNhatTruong_2393/public/images/<?= $item["image"] ?>">

                        </a>

                        <h3>

                            <?= htmlspecialchars($item["name"]) ?>

                        </h3>

                        <div class="related-price">

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

</body>

</html>