<?php

require_once "./app/config/database.php";

class CheckoutController
{
    // ================= CHECKOUT PAGE =================

    public function index()
    {
        $cart = $_SESSION["cart"] ?? [];

        if (empty($cart)) {

            header(
                "Location: /NguyenNhatTruong_2393/Cart/index"
            );

            exit;
        }

        require "./app/views/checkout/index.php";
    }

    // ================= PLACE ORDER =================

    public function placeOrder()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {

            header(
                "Location: /NguyenNhatTruong_2393/Cart/index"
            );

            exit;
        }

        $cart = $_SESSION["cart"] ?? [];

        if (empty($cart)) {

            header(
                "Location: /NguyenNhatTruong_2393/Cart/index"
            );

            exit;
        }

        $fullname = trim($_POST["fullname"]);

        $phone = trim($_POST["phone"]);

        $address = trim($_POST["address"]);

        // ===== TOTAL =====

        $total = 0;

        foreach ($cart as $item) {

            $total +=
                $item["price"] * $item["quantity"];
        }

        // ===== DB =====

        $database = new Database();

        $db = $database->connect();

        // ===== INSERT ORDER =====

        $query = "
    INSERT INTO orders
    (
        user_id,
        fullname,
        phone,
        address,
        total_price
    )
    VALUES
    (
        :user_id,
        :fullname,
        :phone,
        :address,
        :total_price
    )
";

        $stmt = $db->prepare($query);

        if (!isset($_SESSION["user"])) {

            header(
                "Location: /NguyenNhatTruong_2393/Auth/login"
            );

            exit;
        }

        $userId = $_SESSION["user"]["id"];

        $stmt->execute([

            ":user_id" => $userId,

            ":fullname" => $fullname,

            ":phone" => $phone,

            ":address" => $address,

            ":total_price" => $total
        ]);

        $orderId = $db->lastInsertId();

        // ===== INSERT ORDER ITEMS =====

        foreach ($cart as $item) {

            // ===== INSERT ORDER ITEM =====

            $query = "
        INSERT INTO order_items
        (
            order_id,
            product_id,
            quantity,
            price
        )
        VALUES
        (
            :order_id,
            :product_id,
            :quantity,
            :price
        )
    ";

            $stmt = $db->prepare($query);

            $stmt->execute([

                ":order_id" => $orderId,

                ":product_id" => $item["id"],

                ":quantity" => $item["quantity"],

                ":price" => $item["price"]
            ]);

            // ===== UPDATE STOCK =====

            $updateStock = $db->prepare(
                "
        UPDATE products
        SET stock = stock - ?
        WHERE id = ?
        "
            );

            $updateStock->execute([

                $item["quantity"],
                $item["id"]

            ]);
        }

        // ===== CLEAR CART =====

        unset($_SESSION["cart"]);

        // ===== SUCCESS =====

        header(
            "Location: /NguyenNhatTruong_2393/Checkout/success"
        );

        exit;
    }

    // ================= SUCCESS =================

    public function success()
    {
        require "./app/views/checkout/success.php";
    }
}
?>