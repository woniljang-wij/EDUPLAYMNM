<?php

require_once "./app/config/database.php";

class CartController
{
    // ================= CART PAGE =================

    public function index()
    {
        $cart = $_SESSION["cart"] ?? [];

        require "./app/views/cart/index.php";
    }

    // ================= ADD =================

    public function add($id)
    {
        $database = new Database();

        $db = $database->connect();

        $query = "
            SELECT *
            FROM products
            WHERE id = :id
        ";

        $stmt = $db->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {

            header(
                "Location: /NguyenNhatTruong_2393/Product/list"
            );

            exit;
        }

        // ===== CREATE CART =====

        if (!isset($_SESSION["cart"])) {

            $_SESSION["cart"] = [];
        }

        // ===== EXISTS =====

        if (isset($_SESSION["cart"][$id])) {

            $_SESSION["cart"][$id]["quantity"]++;

        } else {

            $_SESSION["cart"][$id] = [

                "id" => $product["id"],

                "name" => $product["name"],

                "price" => $product["price"],

                "image" => $product["image"],

                "quantity" => 1
            ];
        }

        $_SESSION["toast"] = [
            "message" => "Đã thêm vào giỏ hàng",
            "type" => "success"
        ];

        header(
            "Location: /NguyenNhatTruong_2393/Cart/index"
        );

        exit;
    }

    // ================= UPDATE =================

    public function update()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $id = $_POST["id"];

            $quantity = (int) $_POST["quantity"];

            if (
                isset($_SESSION["cart"][$id])
            ) {

                if ($quantity <= 0) {

                    unset($_SESSION["cart"][$id]);

                } else {

                    $_SESSION["cart"][$id]["quantity"]
                        = $quantity;
                }
            }
        }

        header(
            "Location: /NguyenNhatTruong_2393/Cart/index"
        );

        exit;
    }

    // ================= REMOVE =================

    public function remove($id)
    {
        if (
            isset($_SESSION["cart"][$id])
        ) {

            unset($_SESSION["cart"][$id]);
        }

        header(
            "Location: /NguyenNhatTruong_2393/Cart/index"
        );

        exit;
    }

    // ================= CLEAR =================

    public function clear()
    {
        unset($_SESSION["cart"]);

        header(
            "Location: /NguyenNhatTruong_2393/Cart/index"
        );

        exit;
    }
}
?>