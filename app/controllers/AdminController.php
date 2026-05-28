<?php

require_once "./app/config/database.php";

class AdminController
{
    private $db;

    public function __construct()
    {
        if (
            !isset($_SESSION["user"]) ||
            $_SESSION["user"]["role"] !== "admin"
        ) {

            header(
                "Location: /NguyenNhatTruong_2393/Auth/login"
            );

            exit;
        }

        $database = new Database();

        $this->db = $database->connect();
    }

    // ================= DASHBOARD =================

    public function dashboard()
    {
        $page = $_GET["page"] ?? "dashboard";

        $allowedPages = [

            "dashboard",

            "products",
            "product-add",
            "product-edit",

            "categories",
            "category-add",
            "category-edit",

            "orders",
            "order-detail",

            "users"
        ];

        if (!in_array($page, $allowedPages)) {

            $page = "dashboard";
        }

        // ================= DASHBOARD =================

        if ($page == "dashboard") {

            $stmt = $this->db->query(
                "SELECT COUNT(*) FROM products"
            );

            $totalProducts =
                $stmt->fetchColumn();

            $stmt = $this->db->query(
                "SELECT COUNT(*) FROM users"
            );

            $totalUsers =
                $stmt->fetchColumn();

            $stmt = $this->db->query(
                "SELECT COUNT(*) FROM orders"
            );

            $totalOrders =
                $stmt->fetchColumn();

            $stmt = $this->db->query(
                "
                SELECT SUM(total_price)
                FROM orders
                WHERE status = 'completed'
                "
            );

            $totalRevenue =
                $stmt->fetchColumn() ?? 0;

            $stmt = $this->db->query(
                "
                SELECT *
                FROM orders
                ORDER BY created_at DESC
                LIMIT 5
                "
            );

            $recentOrders =
                $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // ================= PRODUCTS =================

        if ($page == "products") {

            $stmt = $this->db->query(
                "
                SELECT products.*,
                       categories.name AS category_name
                FROM products
                LEFT JOIN categories
                ON products.category_id = categories.id
                ORDER BY products.id DESC
                "
            );

            $products =
                $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // ================= PRODUCT ADD =================

        if ($page == "product-add") {

            // ===== LOAD CATEGORY =====

            $stmt = $this->db->query(
                "SELECT * FROM categories"
            );

            $categories =
                $stmt->fetchAll(PDO::FETCH_ASSOC);

            // ===== SUBMIT FORM =====

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $name = $_POST["name"];

                $description = $_POST["description"];

                $price = $_POST["price"];

                $stock = $_POST["stock"];

                $category_id = $_POST["category_id"];

                // ===== IMAGE =====

                $image = "";

                if (!empty($_FILES["image"]["name"])) {

                    $image =
                        time() . "_" .
                        $_FILES["image"]["name"];

                    move_uploaded_file(
                        $_FILES["image"]["tmp_name"],
                        "./public/images/" . $image
                    );
                }

                // ===== INSERT =====

                $stmt = $this->db->prepare(
                    "
INSERT INTO products
(
    name,
    description,
    price,
    stock,
    image,
    category_id
)
VALUES (?, ?, ?, ?, ?, ?)
            "
                );

                $stmt->execute([
                    $name,
                    $description,
                    $price,
                    $stock,
                    $image,
                    $category_id
                ]);
                $_SESSION["toast"] = [
                    "type" => "success",
                    "message" => "Thêm sản phẩm thành công!"
                ];

                header(
                    "Location: /NguyenNhatTruong_2393/Admin/dashboard?page=products"
                );

                exit;
            }
        }

        // ================= PRODUCT EDIT =================

        if ($page == "product-edit") {

            $id = $_GET["id"];

            // ===== GET PRODUCT =====

            $stmt = $this->db->prepare(
                "SELECT * FROM products WHERE id = ?"
            );

            $stmt->execute([$id]);

            $product =
                $stmt->fetch(PDO::FETCH_ASSOC);

            // ===== LOAD CATEGORY =====

            $stmt = $this->db->query(
                "SELECT * FROM categories"
            );

            $categories =
                $stmt->fetchAll(PDO::FETCH_ASSOC);

            // ===== UPDATE =====

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $name = $_POST["name"];

                $description = $_POST["description"];

                $price = $_POST["price"];

                $stock = $_POST["stock"];

                $category_id = $_POST["category_id"];

                // ===== IMAGE =====

                $image = $product["image"];

                if (!empty($_FILES["image"]["name"])) {

                    $image =
                        time() . "_" .
                        $_FILES["image"]["name"];

                    move_uploaded_file(
                        $_FILES["image"]["tmp_name"],
                        "./public/images/" . $image
                    );
                }

                // ===== UPDATE DB =====

                $stmt = $this->db->prepare(
                    "
            UPDATE products
            SET
                name = ?,
                description = ?,
                price = ?,
                stock = ?,
                image = ?,
                category_id = ?
            WHERE id = ?
            "
                );

                $stmt->execute([
                    $name,
                    $description,
                    $price,
                    $stock,
                    $image,
                    $category_id,
                    $id
                ]);

                $_SESSION["toast"] = [
                    "type" => "success",
                    "message" => "Cập nhật sản phẩm thành công!"
                ];

                header(
                    "Location: /NguyenNhatTruong_2393/Admin/dashboard?page=products"
                );

                exit;
            }
        }

        // ================= USERS =================

        if ($page == "users") {

            $stmt = $this->db->query(
                "SELECT * FROM users"
            );

            $users =
                $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // ================= ORDERS =================

        if ($page == "orders") {

            $stmt = $this->db->query(
                "
                SELECT *
                FROM orders
                ORDER BY created_at DESC
                "
            );

            $orders =
                $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // ================= ORDER DETAIL =================

        if ($page == "order-detail") {

            $id = $_GET["id"];

            $stmt = $this->db->prepare(
                "SELECT * FROM orders WHERE id = ?"
            );

            $stmt->execute([$id]);

            $order =
                $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = $this->db->prepare(
                "
                SELECT order_items.*,
                       products.name,
                       products.image
                FROM order_items
                LEFT JOIN products
                ON order_items.product_id = products.id
                WHERE order_id = ?
                "
            );

            $stmt->execute([$id]);

            $items =
                $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // ================= CATEGORIES =================

        if ($page == "categories") {

            $stmt = $this->db->query(
                "SELECT * FROM categories"
            );

            $categories =
                $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // ================= CATEGORY EDIT =================

        if ($page == "category-edit") {

            $id = $_GET["id"];

            $stmt = $this->db->prepare(
                "SELECT * FROM categories WHERE id = ?"
            );

            $stmt->execute([$id]);

            $category =
                $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // ================= LOAD VIEW =================

        $contentView =
            "./app/views/admin/$page.php";

        require "./app/views/layouts/admin.php";
    }

    // ================= DELETE PRODUCT =================

    public function deleteProduct($id)
    {
        $stmt = $this->db->prepare(
            "DELETE FROM products WHERE id = ?"
        );

        $stmt->execute([$id]);

        $_SESSION["toast"] = [
            "type" => "success",
            "message" => "Xóa sản phẩm thành công!"
        ];

        header(
            "Location: /NguyenNhatTruong_2393/Admin/dashboard?page=products"
        );

        exit;
    }

    // ================= ADD CATEGORY =================

    public function addCategory()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $name = trim($_POST["name"]);

            if (!empty($name)) {

                $stmt = $this->db->prepare(
                    "
                INSERT INTO categories(name)
                VALUES(?)
                "
                );

                $stmt->execute([$name]);

                $_SESSION["toast"] = [
                    "type" => "success",
                    "message" => "Thêm danh mục thành công!"
                ];

                header(
                    "Location: /NguyenNhatTruong_2393/Admin/dashboard?page=categories"
                );

                exit;
            }
        }
    }

    // ================= UPDATE CATEGORY =================

    public function updateCategory($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $name = trim($_POST["name"]);

            if (!empty($name)) {

                $stmt = $this->db->prepare(
                    "
                UPDATE categories
                SET name = ?
                WHERE id = ?
                "
                );

                $stmt->execute([$name, $id]);

                $_SESSION["toast"] = [
                    "type" => "success",
                    "message" => "Cập nhật danh mục thành công!"
                ];

                header(
                    "Location: /NguyenNhatTruong_2393/Admin/dashboard?page=categories"
                );

                exit;
            }
        }
    }

    // ================= DELETE CATEGORY =================

    public function deleteCategory($id)
    {
        // KIỂM TRA CÒN PRODUCT KHÔNG

        $check = $this->db->prepare(
            "
        SELECT COUNT(*)
        FROM products
        WHERE category_id = ?
        "
        );

        $check->execute([$id]);

        $totalProducts = $check->fetchColumn();

        // NẾU CÒN SẢN PHẨM

        if ($totalProducts > 0) {

            $_SESSION["toast"] = [
                "type" => "error",
                "message" => "Không thể xóa danh mục vì còn sản phẩm!"
            ];

            header(
                "Location: /NguyenNhatTruong_2393/Admin/dashboard?page=categories"
            );

            exit;
        }

        // XÓA CATEGORY

        $stmt = $this->db->prepare(
            "
        DELETE FROM categories
        WHERE id = ?
        "
        );

        $stmt->execute([$id]);

        $_SESSION["toast"] = [
            "type" => "success",
            "message" => "Xóa danh mục thành công!"
        ];

        header(
            "Location: /NguyenNhatTruong_2393/Admin/dashboard?page=categories"
        );

        exit;
    }

    // ================= UPDATE ORDER STATUS =================

    public function updateStatus($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $status = $_POST["status"];

            $stmt = $this->db->prepare(
                "
            UPDATE orders
            SET status = ?
            WHERE id = ?
            "
            );

            $stmt->execute([
                $status,
                $id
            ]);

            $_SESSION["toast"] = [
                "type" => "success",
                "message" => "Cập nhật trạng thái thành công!"
            ];

            header(
                "Location: /NguyenNhatTruong_2393/Admin/dashboard?page=order-detail&id=$id"
            );

            exit;
        }
    }

    // ================= DELETE ORDER =================

    public function deleteOrder($id)
    {
        // xóa order items trước

        $stmt = $this->db->prepare(
            "
        DELETE FROM order_items
        WHERE order_id = ?
        "
        );

        $stmt->execute([$id]);

        // xóa order

        $stmt = $this->db->prepare(
            "
        DELETE FROM orders
        WHERE id = ?
        "
        );

        $stmt->execute([$id]);

        $_SESSION["toast"] = [
            "type" => "success",
            "message" => "Xóa đơn hàng thành công!"
        ];

        header(
            "Location: /NguyenNhatTruong_2393/Admin/dashboard?page=orders"
        );

        exit;
    }
}

?>