<?php

require_once "./app/models/CategoryModel.php";

class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function list()
    {
        $categories = $this->categoryModel->getAll();

        require "./app/views/category/list.php";
    }

    public function add()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $name = trim($_POST["name"]);

            $this->categoryModel->create($name);

            $_SESSION["toast"] = [
                "message" => "Thêm danh mục thành công",
                "type" => "success"
            ];

            header("Location: /NguyenNhatTruong_2393/Category/list");

            exit;
        }

        require "./app/views/category/add.php";
    }

    public function edit($id)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $name = trim($_POST["name"]);

            $this->categoryModel->updateCategory($id, $name);

            $_SESSION["toast"] = [
                "message" => "Cập nhật danh mục thành công",
                "type" => "success"
            ];

            header("Location: /NguyenNhatTruong_2393/Category/list");

            exit;
        }

        $category = $this->categoryModel->find($id);

        require "./app/views/category/edit.php";
    }

    public function delete($id)
    {
        try {

            if ($this->categoryModel->hasProducts($id)) {

                $_SESSION["toast"] = [
                    "message" => "Danh mục đang có sản phẩm nên không thể xóa",
                    "type" => "error"
                ];

            } else {

                $this->categoryModel->deleteCategory($id);

                $_SESSION["toast"] = [
                    "message" => "Xóa danh mục thành công",
                    "type" => "success"
                ];
            }

        } catch (PDOException $e) {

            $_SESSION["toast"] = [
                "message" => "Không thể xóa danh mục này",
                "type" => "error"
            ];
        }

        header("Location: /NguyenNhatTruong_2393/Category/list");

        exit;
    }
}