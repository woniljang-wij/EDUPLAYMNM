<?php

require_once 'app/models/ProductModel.php';

require_once 'app/config/database.php';

class ProductController
{
    private $conn;

    public function __construct()
    {

        $database = new Database();

        $this->conn = $database->connect();
    }

    public function index()
    {
        $this->list();
    }

    // ===== LIST =====
    public function list()
    {
        // ================= SEARCH =================

        $keyword =
            $_GET["keyword"] ?? "";

        $category =
            $_GET["category"] ?? "";

        $sort =
            $_GET["sort"] ?? "";

        // ================= QUERY =================

        $query = "
        SELECT
            products.*,
            categories.name AS category_name
        FROM products

        LEFT JOIN categories
        ON products.category_id = categories.id

        WHERE 1
    ";

        // ===== SEARCH =====

        if (!empty($keyword)) {

            $query .= "
            AND products.name
            LIKE :keyword
        ";
        }

        // ===== CATEGORY =====

        if (!empty($category)) {

            $query .= "
            AND products.category_id = :category
        ";
        }

        // ===== SORT =====

        if ($sort === "price_asc") {

            $query .= "
            ORDER BY products.price ASC
        ";

        } elseif ($sort === "price_desc") {

            $query .= "
            ORDER BY products.price DESC
        ";

        } else {

            $query .= "
            ORDER BY products.id DESC
        ";
        }

        $stmt = $this->conn->prepare($query);

        // ===== BIND =====

        if (!empty($keyword)) {

            $searchKeyword =
                "%" . $keyword . "%";

            $stmt->bindParam(
                ":keyword",
                $searchKeyword
            );
        }

        if (!empty($category)) {

            $stmt->bindParam(
                ":category",
                $category
            );
        }

        $stmt->execute();

        $products =
            $stmt->fetchAll(PDO::FETCH_ASSOC);

        // ===== GET CATEGORIES =====

        $categoryQuery = "
        SELECT *
        FROM categories
        ORDER BY name ASC
    ";

        $categoryStmt =
            $this->conn->prepare($categoryQuery);

        $categoryStmt->execute();

        $categories =
            $categoryStmt->fetchAll(PDO::FETCH_ASSOC);

        include 'app/views/product/list.php';
    }

    // ===== ADD =====
    public function add()
    {
        $errors = [];

        // ===== GET CATEGORIES =====
        $categoryQuery = "
            SELECT *
            FROM categories
            ORDER BY name ASC
        ";

        $categoryStmt = $this->conn->prepare($categoryQuery);

        $categoryStmt->execute();

        $categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $name = trim($_POST['name']);

            $description = trim($_POST['description']);

            $price = trim($_POST['price']);

            $category_id = $_POST['category_id'];

            // ===== VALIDATE =====

            if (empty($name)) {

                $errors[] = 'Tên sản phẩm là bắt buộc.';
            } elseif (strlen($name) < 3 || strlen($name) > 100) {

                $errors[] = 'Tên sản phẩm phải từ 3 đến 100 ký tự.';
            }

            if (empty($description)) {

                $errors[] = 'Mô tả sản phẩm là bắt buộc.';
            }

            if (!is_numeric($price) || $price <= 0) {

                $errors[] = 'Giá phải lớn hơn 0.';
            }

            if (empty($category_id)) {

                $errors[] = 'Vui lòng chọn danh mục.';
            }

            // ===== INSERT =====

            if (empty($errors)) {

                $image = '';

                // ===== IMAGE =====

                if (
                    isset($_FILES['image']) &&
                    $_FILES['image']['error'] == 0
                ) {

                    $ext = pathinfo(
                        $_FILES['image']['name'],
                        PATHINFO_EXTENSION
                    );

                    $image = uniqid() . '.' . $ext;

                    move_uploaded_file(
                        $_FILES['image']['tmp_name'],
                        'public/images/' . $image
                    );
                }

                $query = "
                    INSERT INTO products
                    (
                        name,
                        description,
                        price,
                        image,
                        category_id
                    )
                    VALUES
                    (
                        :name,
                        :description,
                        :price,
                        :image,
                        :category_id
                    )
                ";

                $stmt = $this->conn->prepare($query);

                $stmt->bindParam(':name', $name);

                $stmt->bindParam(':description', $description);

                $stmt->bindParam(':price', $price);

                $stmt->bindParam(':image', $image);

                $stmt->bindParam(':category_id', $category_id);

                $stmt->execute();

                $_SESSION['toast'] = [
                    'message' => 'Khởi tạo sản phẩm thành công!',
                    'type' => 'success'
                ];

                header('Location: /NguyenNhatTruong_2393/Product/list');

                exit();
            }
        }

        include 'app/views/product/add.php';
    }

    // ===== EDIT =====
    public function edit($id)
    {
        // ===== GET CATEGORIES =====

        $categoryQuery = "
            SELECT *
            FROM categories
            ORDER BY name ASC
        ";

        $categoryStmt = $this->conn->prepare($categoryQuery);

        $categoryStmt->execute();

        $categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);

        // ===== UPDATE =====

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $name = trim($_POST['name']);

            $description = trim($_POST['description']);

            $price = trim($_POST['price']);

            $category_id = $_POST['category_id'];

            $errors = [];

            // ===== VALIDATE =====

            if (empty($name)) {

                $errors[] = 'Tên sản phẩm là bắt buộc.';
            }

            if (empty($description)) {

                $errors[] = 'Mô tả sản phẩm là bắt buộc.';
            }

            if (!is_numeric($price) || $price <= 0) {

                $errors[] = 'Giá phải lớn hơn 0.';
            }

            if (empty($category_id)) {

                $errors[] = 'Vui lòng chọn danh mục.';
            }

            if (empty($errors)) {

                // ===== IMAGE =====

                $queryImage = "";

                if (
                    isset($_FILES['image']) &&
                    $_FILES['image']['error'] == 0
                ) {

                    $ext = pathinfo(
                        $_FILES['image']['name'],
                        PATHINFO_EXTENSION
                    );

                    $image = uniqid() . '.' . $ext;

                    move_uploaded_file(
                        $_FILES['image']['tmp_name'],
                        'public/images/' . $image
                    );

                    $queryImage = ", image = :image";
                }

                $query = "
                    UPDATE products
                    SET
                        name = :name,
                        description = :description,
                        price = :price,
                        category_id = :category_id
                        $queryImage
                    WHERE id = :id
                ";

                $stmt = $this->conn->prepare($query);

                $stmt->bindParam(':name', $name);

                $stmt->bindParam(':description', $description);

                $stmt->bindParam(':price', $price);

                $stmt->bindParam(':category_id', $category_id);

                $stmt->bindParam(':id', $id);

                if (!empty($queryImage)) {

                    $stmt->bindParam(':image', $image);
                }

                $stmt->execute();

                $_SESSION['toast'] = [
                    'message' => 'Nâng cấp sản phẩm thành công!',
                    'type' => 'success'
                ];

                header('Location: /NguyenNhatTruong_2393/Product/list');

                exit();
            }
        }

        // ===== GET PRODUCT =====

        $query = "
            SELECT *
            FROM products
            WHERE id = :id
        ";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {

            die('Product not found');
        }

        include 'app/views/product/edit.php';
    }

    // ================= DETAIL =================

    public function detail($id)
    {
        // ===== PRODUCT =====

        $query = "
        SELECT
            products.*,
            categories.name AS category_name
        FROM products

        LEFT JOIN categories
        ON products.category_id = categories.id

        WHERE products.id = :id
    ";

        $stmt = $this->conn->prepare($query);

        $stmt->execute([
            ":id" => $id
        ]);

        $product =
            $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {

            die("Sản phẩm không tồn tại");
        }

        // ===== RELATED PRODUCTS =====

        $relatedQuery = "
        SELECT *
        FROM products

        WHERE category_id = :category_id
        AND id != :id

        ORDER BY RAND()
        LIMIT 4
    ";

        $relatedStmt =
            $this->conn->prepare($relatedQuery);

        $relatedStmt->execute([
            ":category_id" => $product["category_id"],
            ":id" => $id
        ]);

        $relatedProducts =
            $relatedStmt->fetchAll(PDO::FETCH_ASSOC);

        require "./app/views/product/detail.php";
    }

    // ===== DELETE =====
    public function delete($id)
    {
        // ===== GET IMAGE =====

        $query = "
            SELECT image
            FROM products
            WHERE id = :id
        ";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {

            $image = $product['image'];

            if (
                !empty($image) &&
                file_exists('public/images/' . $image)
            ) {

                unlink('public/images/' . $image);
            }
        }

        // ===== DELETE PRODUCT =====

        $query = "
            DELETE FROM products
            WHERE id = :id
        ";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $_SESSION['toast'] = [
            'message' => 'Xóa sản phẩm thành công!',
            'type' => 'success'
        ];

        header('Location: /NguyenNhatTruong_2393/Product/list');

        exit();
    }
}